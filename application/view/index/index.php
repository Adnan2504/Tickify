<div class="container">
    <h1>Tickify</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>Tickify AI</h3>

        <form method="post">
            <label for="prompt">How can I help you today?:</label><br>
            <textarea id="prompt" name="prompt" rows="4" cols="50" required></textarea><br><br>
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

                            echo "<div style='margin-top: 20px;'>";
                            echo "<h3>Was your question solved?</h3>";
                            echo "<form action='" . Config::get('URL') . "createTicket/index' method='get' style='display: inline-block; margin-right: 10px;'>";
                            echo "<button type='submit'>No, Create New Ticket</button>";
                            echo "</form>";
                            echo "<form action='" . Config::get('URL') . "index/index' method='get' style='display: inline-block; margin-right: 10px;'>";
                            echo "<button type='submit'>Yes, my question was solved</button>";
                            echo "</form>";
                            echo "</div>";

                            unset($_SESSION['history']);

                        } else {
                            echo "<p><strong>Error:</strong> Invalid response format.</p>";
                        }
                    } else {
                        echo "<p><strong>Error:</strong> HTTP Status $statusCode - " . htmlspecialchars($response) . "</p>";
                    }
                }

                curl_close($ch);
            } else {
                echo "<p><strong>Error:</strong> Please enter a question.</p>";
            }
        }
        ?>

        <?php if ($this->tickets): ?>
            <table class="ticket-table display">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->tickets as $ticket): ?>
                    <tr>
                        <td><?= $ticket->id; ?></td>
                        <td data-search="<?= htmlentities($ticket->subject); ?>"><?= htmlentities($ticket->subject); ?></td>
                        <td data-search="<?= htmlentities($ticket->description); ?>"><?= htmlentities($ticket->description); ?></td>
                        <td data-search="<?= ucfirst($ticket->priority); ?>"><?= ucfirst($ticket->priority); ?></td>
                        <td data-search="<?= htmlentities($ticket->category); ?>"><?= htmlentities($ticket->category); ?></td>
                        <td data-search="<?= ucfirst($ticket->status); ?>"><?= ucfirst($ticket->status); ?></td>
                        <td data-search="<?= $ticket->created_at; ?>"><?= $ticket->created_at; ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>">Edit</a> |
                            <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>" onclick="return confirm('Are you sure you want to delete this ticket?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div>No tickets found. Create some!</div>
        <?php endif; ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/jquery.dataTables.min.css" />

<script>
    $(document).ready(function () {
        $('.ticket-table').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            order: [[0, 'asc']],
        });
    });
</script>
