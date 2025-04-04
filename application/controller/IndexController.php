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
        $this->initializeChatHistory($current_page);
        $this->handlePostRequests();

        // fetch latest tickets (only last 3)
        $allTickets = TicketModel::getAllTickets();
        $latestTickets = array_slice($allTickets, -3, 3);

        // render the index page with ticket data and chat status
        $this->View->render('index/index', [
            'tickets' => $latestTickets,
            'showPostChatOptions' => isset($_SESSION['temp_index_history']) &&
                count($_SESSION['temp_index_history']) > 1 &&
                end($_SESSION['temp_index_history'])['role'] === 'assistant'
        ]);
    }

    private function initializeChatHistory($current_page)
    {
        if (!isset($_SESSION['temp_index_history']) ||
            ($_SERVER['REQUEST_METHOD'] !== 'POST' &&
                (!isset($_SESSION['last_page']) || $_SESSION['last_page'] !== $current_page))) {
            $_SESSION['temp_index_history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
        }
        $_SESSION['last_page'] = $current_page;
    }

    private function handlePostRequests()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['reset_session'])) {
                $this->handleResetSession();
            } elseif (isset($_POST['continue_in_chat'])) {
                $this->handleContinueInChat();
            } elseif (isset($_POST['prompt'])) {
                $this->handleChatPrompt();
            } elseif (isset($_POST['user_text'])) {
                $this->handleUserText();
            }
        }
    }

    private function handleResetSession()
    {
        unset($_SESSION['temp_index_history']);
        $_SESSION['temp_index_history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
        Redirect::to('index/index');
        exit();
    }

    private function handleContinueInChat()
    {
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
        }

        if (isset($_SESSION['temp_index_history']) && count($_SESSION['temp_index_history']) > 1) {
            foreach ($_SESSION['temp_index_history'] as $message) {
                $timestamp = isset($message['timestamp']) ? $message['timestamp'] : time();
                $enrichedMessage = array_merge($message, ['timestamp' => $timestamp]);

                if (!$this->isDuplicateMessage($enrichedMessage)) {
                    $_SESSION['history'][] = $enrichedMessage;
                }
            }
        }
        Redirect::to('aiChat/index');
        exit();
    }

    private function handleChatPrompt()
    {
        if (isset($_POST['prompt'])) {
            AIChatModel::sendPrompt($_POST['prompt'], $_SESSION['temp_index_history']);
        }
    }

    private function handleUserText()
    {
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

    private function isDuplicateMessage($newMessage)
    {
        if (!isset($_SESSION['history'])) {
            return false;
        }

        foreach ($_SESSION['history'] as $existingMessage) {
            if ($newMessage['role'] === $existingMessage['role'] &&
                $newMessage['content'] === $existingMessage['content'] &&
                isset($newMessage['timestamp']) &&
                isset($existingMessage['timestamp']) &&
                $newMessage['timestamp'] === $existingMessage['timestamp']) {
                return true;
            }
        }
        return false;
    }
}