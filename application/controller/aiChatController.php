<?php

require_once Config::get('PATH_MODEL') . 'AIChatModel.php';

class aiChatController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->View->render('aiChat/index');
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['prompt'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Invalid request']);
            exit;
        }

        $prompt = trim($_POST['prompt']);

        if (empty($prompt)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Empty prompt']);
            exit;
        }

        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
        }

        try {
            $result = AIChatModel::sendPrompt($prompt, $_SESSION['history']);
            header('Content-Type: application/json');
            if (!isset($result['error'])) {
                echo json_encode(['success' => true, 'message' => $result['response']]);
            } else {
                echo json_encode(['success' => false, 'error' => $result['error']]);
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }
}