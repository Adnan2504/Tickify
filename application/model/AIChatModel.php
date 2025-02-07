<?php
class AIChatModel {

    public function __construct() {
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [
                ["role" => "system", "content" => "You are a helpful assistant."]
            ];
        }
    }

    public function addMessage($role, $content) {
        $_SESSION['history'][] = ["role" => $role, "content" => $content];
    }

    public function getHistory() {
        return $_SESSION['history'];
    }

    public function sendRequest($prompt) {
        $url = "http://localhost:11434/api/chat";
        $headers = ["Content-Type: application/json"];

        $data = [
            "model" => "deepseek-r1:8b",
            "messages" => $this->getHistory(),
            "stream" => false
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (curl_errno($ch)) {
            throw new Exception("Curl Error: " . curl_error($ch));
        }

        return ['status' => $statusCode, 'response' => $response];
    }
}
