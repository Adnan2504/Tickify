<?php
class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::checkAuthentication();
    }

    public function index()
    {
        $current_page = 'index';

        // Initialize or reset chat history
        if (!isset($_SESSION['temp_index_history']) ||
            ($_SERVER['REQUEST_METHOD'] !== 'POST' &&
                (!isset($_SESSION['last_page']) || $_SESSION['last_page'] !== $current_page))) {
            $_SESSION['temp_index_history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
        }

        $_SESSION['last_page'] = $current_page;

        // Handle session reset
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_session'])) {
            unset($_SESSION['temp_index_history']);
            $_SESSION['temp_index_history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
            Redirect::to('index/index');
            exit();
        }

        // handle continue to chat
        if (isset($_POST['continue_in_chat'])) {
            if (!isset($_SESSION['history'])) {
                $_SESSION['history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
            }

            if (isset($_SESSION['temp_index_history']) && count($_SESSION['temp_index_history']) > 1) {
                foreach ($_SESSION['temp_index_history'] as $message) {
                    if (!in_array($message, $_SESSION['history'])) {
                        $_SESSION['history'][] = $message;
                    }
                }
            }
            Redirect::to('aiChat/index');
            exit();
        }

        // Handle chat prompts
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prompt'])) {
            AIChatModel::sendPrompt($_POST['prompt'], $_SESSION['temp_index_history']);
        }

        // handle user message input with POST-Redirect-GET pattern
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_text'])) {
            $userMessage = trim($_POST['user_text']);

            if (!empty($userMessage)) {
                $_SESSION['temp_index_history'][] = ["role" => "user", "content" => $userMessage];
                header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
                header('Cache-Control: post-check=0, pre-check=0', false);
                header('Pragma: no-cache');
                Redirect::to('index/index');
                exit();
            }
        }

        // reset message tracking flag on normal page reload
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            unset($_SESSION['last_message']);
        }

        // handle "Continue in AI Chat" and move chat history
        if (isset($_POST['continue_in_chat'])) {
            if (!isset($_SESSION['history'])) {
                $_SESSION['history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
            }

            if (!empty($_SESSION['temp_index_history']) && count($_SESSION['temp_index_history']) > 1) {
                // Initialize history if not exists
                if (!isset($_SESSION['history'])) {
                    $_SESSION['history'] = [["role" => "system", "content" => "You are a helpful assistant.", "timestamp" => time()]];
                }

                // Add messages from temp_index_history while checking for duplicates
                foreach ($_SESSION['temp_index_history'] as $message) {
                    $timestamp = isset($message['timestamp']) ? $message['timestamp'] : time();
                    $enrichedMessage = array_merge($message, ['timestamp' => $timestamp]);

                    // Only check for exact duplicates with same timestamp
                    $isDuplicate = false;
                    foreach ($_SESSION['history'] as $existingMessage) {
                        if ($message['role'] === $existingMessage['role'] &&
                            $message['content'] === $existingMessage['content'] &&
                            $message['timestamp'] === $existingMessage['timestamp']) {
                            $isDuplicate = true;
                            break;
                        }
                    }
                    if (!$isDuplicate) {
                        $_SESSION['history'][] = $enrichedMessage;
                    }
                }
            }

            Redirect::to('aiChat/index');
            exit();
        }

        // fetch latest tickets (only last 3)
        $allTickets = TicketModel::getAllTickets();
        $latestTickets = array_slice($allTickets, -3, 3);

        // render the index page with ticket data
        $this->View->render('index/index', [
            'tickets' => $latestTickets
        ]);
    }
}