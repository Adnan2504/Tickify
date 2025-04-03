<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new aiChatController();
    $controller->handleRequest();
    return;
}

// Ensure history is initialized
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
}
?>

<div class="fixed inset-0 pt-20 pb-6 bg-gradient-to-br from-blue-50 to-indigo-50 overflow-hidden">
    <div class="h-full w-full mx-auto text-left px-4 flex flex-col">
        <h2 class="text-2xl font-bold text-blue-600 mb-3 inline-flex items-center justify-center flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            Tickify AI Chat
        </h2>

        <div class="flex-1 flex flex-col w-full max-w-4xl mx-auto rounded-2xl overflow-hidden bg-white shadow-sm">
            <div id="chat-history" class="flex-1 overflow-y-auto p-5 space-y-4 scrollbar-hide">
                <?php
                if (isset($_SESSION['history']) && count($_SESSION['history']) > 1) {
                    for ($i = 1; $i < count($_SESSION['history']); $i++) {
                        $message = $_SESSION['history'][$i];
                        if ($message['role'] === 'user') {
                            echo '<div class="flex justify-end mb-3">';
                            echo '<div class="bg-blue-500 text-white rounded-lg py-2 px-4 max-w-[70%] break-words">';
                            echo htmlspecialchars($message['content']);
                            echo '</div>';
                            echo '</div>';
                        } else if ($message['role'] === 'assistant') {
                            echo '<div class="flex justify-start mb-3">';
                            echo '<div class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 max-w-[70%] break-words">';
                            echo nl2br(htmlspecialchars($message['content']));
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                } else {
                    echo '<div class="text-center text-gray-500 p-10">';
                    echo '<p>Welcome to Tickify AI Chat! How can I assist you today?</p>';
                    echo '</div>';
                }
                ?>
            </div>

            <div id="loading-indicator" class="hidden bg-gray-50 border-t border-gray-200 p-2">
                <div class="flex items-center justify-center">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        <span class="ml-3 text-gray-600">AI is thinking...</span>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-200">
                <form method="post" class="flex gap-2" id="chat-form" onsubmit="handleSubmit(event)">
                    <textarea id="prompt" name="prompt" rows="1"
                              placeholder="Type your message here... (Press Enter to send message)"
                              required
                              class="flex-1 rounded-full px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none min-h-[40px] max-h-[72px] scrollbar-hide overflow-y-auto"></textarea>
                    <button type="submit" id="send-button"
                            class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let isSubmitting = false;

    document.addEventListener('DOMContentLoaded', function() {
        const chatHistory = document.getElementById('chat-history');
        const textarea = document.getElementById('prompt');
        const form = document.getElementById('chat-form');

        if (chatHistory) chatHistory.scrollTop = chatHistory.scrollHeight;

        if (textarea) {
            textarea.addEventListener('keydown', function(event) {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault();
                    if (!isSubmitting) {
                        handleSubmit(event);
                    }
                }
            });

            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                const maxHeight = 96;
                const newHeight = Math.min(this.scrollHeight, maxHeight);
                this.style.height = newHeight + 'px';
            });
        }
    });

    function handleSubmit(event) {
        event.preventDefault();
        if (isSubmitting) return;

        const form = event.target.closest('form');
        if (!form) return;

        const textarea = form.querySelector('textarea');
        const button = form.querySelector('button');
        const loadingIndicator = document.getElementById('loading-indicator');
        const message = textarea?.value?.trim();

        if (!message) return;

        isSubmitting = true;
        textarea.disabled = true;
        button.disabled = true;
        textarea.value = '';
        textarea.style.height = '40px';
        if (loadingIndicator) loadingIndicator.classList.remove('hidden');

        appendMessage(message, true);

        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'prompt': message
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    appendMessage(data.message, false);
                } else {
                    throw new Error(data.error || 'An error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                appendMessage(`Error: ${error.message || 'Could not connect to AI service. Please try again.'}`, false);
                // Refresh only chat content after error
                refreshChat();
            })
            .finally(() => {
                isSubmitting = false;
                if (textarea) {
                    textarea.disabled = false;
                    textarea.value = '';
                    textarea.style.height = '40px'; // Reset height to minimum
                    textarea.focus();
                }
                if (button) button.disabled = false;
                if (loadingIndicator) loadingIndicator.classList.add('hidden');
            });
    }

    function refreshChat() {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newChatHistory = doc.getElementById('chat-history');
                if (newChatHistory) {
                    document.getElementById('chat-history').innerHTML = newChatHistory.innerHTML;
                }
            });
    }

    function appendMessage(content, isUser) {
        const chatHistory = document.getElementById('chat-history');
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex justify-${isUser ? 'end' : 'start'} mb-3`;
        messageDiv.innerHTML = `
            <div class="bg-${isUser ? 'blue-500 text-white' : 'gray-200 text-gray-800'} rounded-lg py-2 px-4 max-w-[70%] break-words">
                ${content}
            </div>
        `;
        chatHistory.appendChild(messageDiv);
        setTimeout(() => {
            chatHistory.scrollTo({
                top: chatHistory.scrollHeight,
                behavior: 'smooth'
            });
        }, 100);
    }
</script>