<div class="container">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

<h1>Ollama Model Test</h1>
<form method="post">
    <label for="prompt"><h2>Question:</h2></label>
    <textarea id="prompt" name="prompt" rows="10" cols="100" required></textarea><br><br>
    <input type="submit" value="Send Question">
</form>

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
            echo "<p><strong>Error:</strong> " . htmlspecialchars(curl_error($ch)) . "</p>";
        } else {
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($statusCode === 200) {
                $responseData = json_decode($response, true);

                if (isset($responseData['message']['content'])) {
                    $_SESSION['history'][] = ["role" => "assistant", "content" => $responseData['message']['content']];

                    echo "<h2>Question: $prompt</h2>";

                    echo "<h2>Response:</h2>";
                    echo "<p>" . nl2br(htmlspecialchars($responseData['message']['content'])) . "</p>";
                } else {
                    echo "<p><strong>Error:</strong> Invalid response format.</p>";
                }
            } else {
                echo "<p><strong>Error:</strong> HTTP Status $statusCode - " . htmlspecialchars($response) . "</p>";
            }
        }

        curl_close($ch);
    } else {
        echo "<p><strong>Error:</strong> Questions:.</p>";
    }
}
?>

</div>