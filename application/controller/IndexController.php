<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
        Auth::checkAuthentication();
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index()
    {
        // Process form submission for AI chat
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['reset_session'])) {
                // Reset the chat session
                if (isset($_SESSION['temp_index_history'])) {
                    unset($_SESSION['temp_index_history']);
                }
            } else if (isset($_POST['continue_in_chat'])) {
                // Transfer index chat history to full chat page
                if (isset($_SESSION['temp_index_history'])) {
                    $_SESSION['history'] = $_SESSION['temp_index_history'];
                    unset($_SESSION['temp_index_history']);
                }
                header('Location: ' . Config::get('URL') . 'aiChat/index');
                exit();
            } else if (isset($_POST['prompt'])) {
                $this->processAiChatPrompt($_POST['prompt']);
            }
        }

        // Get the latest 3 tickets
        $allTickets = TicketModel::getAllTickets();
        $latestTickets = array_slice($allTickets, -3, 3);

        $this->View->render('index/index', array(
            'tickets' => $latestTickets
        ));
    }

    /**
     * Process the AI chat prompt from the index page
     *
     * @param string $prompt The user's prompt text
     */
    private function processAiChatPrompt($prompt)
    {
        $prompt = trim($prompt);

        if (!empty($prompt)) {
            // Initialize the chat history if it doesn't exist
            if (!isset($_SESSION['temp_index_history'])) {
                $_SESSION['temp_index_history'] = [
                    ["role" => "system", "content" => "You are a helpful assistant."]
                ];
            }

            $_SESSION['temp_index_history'][] = ["role" => "user", "content" => $prompt];

            // Call the Ollama API
            $url = "http://localhost:11434/api/chat";
            $headers = ["Content-Type: application/json"];

            $data = [
                "model" => "llama3.1:latest",
                "messages" => $_SESSION['temp_index_history'],
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
                $_SESSION['api_error'] = "Error: " . curl_error($ch);
            } else {
                $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($statusCode === 200) {
                    $responseData = json_decode($response, true);

                    if (isset($responseData['message']['content'])) {
                        $_SESSION['temp_index_history'][] = ["role" => "assistant", "content" => $responseData['message']['content']];
                    } else {
                        $_SESSION['api_error'] = "Error: Invalid response format.";
                    }
                } else {
                    $_SESSION['api_error'] = "Error: HTTP Status $statusCode - " . $response;
                }
            }

            curl_close($ch);
        }
    }
}