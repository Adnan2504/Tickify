<?php


require_once Config::get('PATH_MODEL') . 'AIChatModel.php';

class aiChatController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new AIChatModel();
    }

    public function index()
    {
        $this->View->render('aiChat/index');
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prompt = trim($_POST['prompt']);

            if (!empty($prompt)) {
                // Prevent duplicate message processing
                if (!isset($_SESSION['last_prompt']) || $_SESSION['last_prompt'] !== $prompt) {
                    $_SESSION['last_prompt'] = $prompt; // Store last message to prevent duplicates

                    $this->model->addMessage('user', $prompt);

                    try {
                        $result = $this->model->sendRequest($prompt);

                        if ($result['status'] === 200) {
                            $responseData = json_decode($result['response'], true);

                            if (isset($responseData['message']['content'])) {
                                $this->model->addMessage('assistant', $responseData['message']['content']);
                                return ['prompt' => $prompt, 'response' => $responseData['message']['content']];
                            } else {
                                throw new Exception("Invalid response format.");
                            }
                        } else {
                            throw new Exception("HTTP Status " . $result['status'] . " - " . htmlspecialchars($result['response']));
                        }
                    } catch (Exception $e) {
                        return ['error' => $e->getMessage()];
                    }
                } else {
                    return ['error' => "Message already processed."]; // Avoid resending on refresh
                }
            } else {
                return ['error' => "Question cannot be empty."];
            }
        }

        // Clear session storage on normal page load (GET request)
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            unset($_SESSION['last_prompt']);
        }

        return [];
    }
}

