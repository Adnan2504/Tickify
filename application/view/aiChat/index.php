<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = [
            ["role" => "system", "content" => "You are a helpful assistant."]
        ];
    }

    $prompt = trim($_POST['prompt']);

    if (!empty($prompt)) {
        $_SESSION['history'][] = ["role" => "user", "content" => $prompt];

        // /api/generate geht auch aber da gibt es keine history :/
        $url = "http://localhost:11434/api/chat";
        $headers = ["Content-Type: application/json"];

        $data = [
            "model" => "llama3.1:latest",
            "messages" => $_SESSION['history'],
            "stream" => false
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $_SESSION['feedback_negative'][] = "Error: " . curl_error($ch);
        } else {
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($statusCode === 200) {
                $responseData = json_decode($response, true);

                if (isset($responseData['message']['content'])) {
                    $_SESSION['history'][] = ["role" => "assistant", "content" => $responseData['message']['content']];

                    // Redirect to refresh the page
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                } else {
                    $_SESSION['feedback_negative'][] = "Error: Invalid response format.";
                }
            } else {
                $_SESSION['feedback_negative'][] = "Error: HTTP Status $statusCode - " . $response;
            }
        }

        curl_close($ch);
    } else {
        $_SESSION['feedback_negative'][] = "Error: Please enter a question.";
    }
}
?>

<div class="container mx-auto px-4 py-6">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-[80vh]">
        <h1 class="text-center py-4 bg-gray-50 border-b border-gray-200 text-xl font-semibold text-gray-800">Tickify AI Chat</h1>

        <div id="chat-history" class="flex-1 overflow-y-auto p-4 space-y-4">
            <!-- messages will appear here -->
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

            // display any api errors
            if (isset($_SESSION['feedback_negative'])) {
                foreach ($_SESSION['feedback_negative'] as $error) {
                    echo '<div class="flex justify-start mb-3">';
                    echo '<div class="bg-red-100 text-red-800 rounded-lg py-2 px-4 max-w-[70%]">';
                    echo '<strong>error:</strong> ' . htmlspecialchars($error);
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-200">
            <form method="post" class="flex gap-2" id="chat-form">
                <textarea id="prompt" name="prompt" rows="1" placeholder="Type your message here..." required class="flex-1 rounded-full px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none overflow-hidden"></textarea>
                <button type="submit" class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // scroll
        const chatHistory = document.getElementById('chat-history');
        if (chatHistory) {
            chatHistory.scrollTop = chatHistory.scrollHeight;
        }

        // enable enter key to send messaghe
        const textarea = document.getElementById('prompt');
        const form = document.getElementById('chat-form');

        textarea.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                form.submit();
            }
        });

        // auto resize textarea
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            const maxHeight = 100;
            const newHeight = Math.min(this.scrollHeight, maxHeight);
            this.style.height = newHeight + 'px';
        });
    });
</script>