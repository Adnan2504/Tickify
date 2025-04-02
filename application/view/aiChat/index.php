<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AIChatModel::handleRequest(false);
}
?>

<!-- Outer background and padding -->
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-6 overflow-hidden scrollbar-hide">
    <div class="w-full mx-auto text-center px-4">

        <?php $this->renderFeedbackMessages(); ?>

        <h2 class="text-2xl font-bold text-blue-600 mb-3 inline-flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            Tickify AI Chat
        </h2>

        <div class="flex flex-col w-full max-w-4xl mx-auto rounded-2xl overflow-hidden bg-white shadow-sm scrollbar-hide
            h-[85vh] sm:h-[88vh] md:h-[80vh] lg:h-[75vh] xl:h-[70vh]">
        <!-- Chat History -->
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

                if (isset($_SESSION['feedback_negative'])) {
                    foreach ($_SESSION['feedback_negative'] as $error) {
                        echo '<div class="flex justify-start mb-3">';
                        echo '<div class="bg-red-100 text-red-800 rounded-lg py-2 px-4 max-w-[70%]">';
                        echo '<strong>Error:</strong> ' . htmlspecialchars($error);
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

            <!-- Chat Input -->
            <div class="p-4 bg-gray-50 border-t border-gray-200">
                <form method="post" class="flex gap-2" id="chat-form">
                    <textarea id="prompt" name="prompt" rows="1"
                              placeholder="Type your message here... (Press Enter to send message)"
                              required
                              class="flex-1 rounded-full px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none min-h-[40px] max-h-[72px] scrollbar-hide overflow-y-auto"></textarea>
                    <button type="submit"
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

<!-- JavaScript: Chat UX -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatHistory = document.getElementById('chat-history');
        if (chatHistory) chatHistory.scrollTop = chatHistory.scrollHeight;

        const textarea = document.getElementById('prompt');
        const form = document.getElementById('chat-form');

        textarea.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                form.submit();
            }
        });

        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            const maxHeight = 96;
            const newHeight = Math.min(this.scrollHeight, maxHeight);
            this.style.height = newHeight + 'px';
        });
    });
</script>
