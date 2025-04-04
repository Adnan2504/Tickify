<?php
class AIChatModel {
    public static function sendPrompt($prompt, &$history) {
        if (empty($prompt)) {
            return ["error" => "Prompt cannot be empty."];
        }

        $history[] = ["role" => "user", "content" => $prompt, "timestamp" => time()];

        $url = "http://localhost:11434/api/chat";
        $headers = ["Content-Type: application/json"];
        $data = [
            "model" => "deepseek-r1:8b",
            "messages" => $history,
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

        if ($statusCode === 200) {
            $responseData = json_decode($response, true);
            if (isset($responseData['message']['content'])) {
                $history[] = ["role" => "assistant", "content" => $responseData['message']['content'], "timestamp" => time()];
                return ["response" => $responseData['message']['content']];
            } else {
                return ["error" => "Invalid response format."];
            }
        } else {
            return ["error" => "HTTP Status $statusCode - $response"];
        }
    }
}