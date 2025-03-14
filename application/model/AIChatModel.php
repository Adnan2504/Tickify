<?php
class AIChatModel {
    private static $apiUrl = "http://localhost:11434/api/chat";

    public static function handleRequest($useTempHistory = false) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $sessionKey = $useTempHistory ? 'temp_index_history' : 'history';

        if (!isset($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = [["role" => "system", "content" => "You are a helpful assistant."]];
        }

        $prompt = trim($_POST['prompt'] ?? '');

        if (empty($prompt)) {
            $_SESSION['feedback_negative'][] = "Error: Please enter a question.";
            return;
        }

        $_SESSION[$sessionKey][] = ["role" => "user", "content" => $prompt];

        $headers = ["Content-Type: application/json"];
        $data = [
            "model" => "llama3.1:latest",
            "messages" => $_SESSION[$sessionKey],
            "stream" => false
        ];

        // Initialize cURL session for API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$apiUrl); // Set API URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Set HTTP method to POST
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Attach headers
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send data as JSON

        // Execute API request
        $response = curl_exec($ch);
        $error = curl_errno($ch) ? curl_error($ch) : null; // Capture any errors
        curl_close($ch); // Close cURL session

        if ($error) {
            $_SESSION['feedback_negative'][] = "Error: " . $error;
            return;
        }

        // Process response
        $responseData = json_decode($response, true);
        if (isset($responseData['message']['content'])) {
            $_SESSION[$sessionKey][] = ["role" => "assistant", "content" => $responseData['message']['content']];
        } else {
            $_SESSION['feedback_negative'][] = "Error: Invalid response format.";
        }
    }
}
