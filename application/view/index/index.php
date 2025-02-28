<div class="container">
    <h1>Tickify</h1>
    <div class="box" style="max-width: 1000px; margin: 0 auto; text-align: center; border: none">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>Tickify AI</h3>

        <form method="post" style="margin: 20px 0;">
            <label for="prompt" style="font-size: 16px; font-weight: bold;">How can I help you today?</label><br>
            <textarea id="prompt" name="prompt" rows="10" cols="100" required style="width: 90%; margin: 10px auto; padding: 10px;"></textarea><br><br>
            <input type="submit" value="Send Question" style="padding: 8px 15px; cursor: pointer; background-color: #007bff; color: white; border: none; border-radius: 4px;">
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
                    echo "<div style='text-align: left; margin: 20px auto; padding: 10px; border-left: 4px solid #dc3545; background-color: #f8d7da;'>";
                    echo "<p><strong>Error:</strong> " . htmlspecialchars(curl_error($ch)) . "</p>";
                    echo "</div>";
                } else {
                    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    if ($statusCode === 200) {
                        $responseData = json_decode($response, true);

                        if (isset($responseData['message']['content'])) {
                            $_SESSION['history'][] = ["role" => "assistant", "content" => $responseData['message']['content']];

                            echo "<div style='text-align: left; margin: 20px auto; padding: 15px; border: 1px solid #dee2e6; border-radius: 5px; background-color: #f8f9fa;'>";
                            echo "<h2 style='color: #007bff;'>Question:</h2>";
                            echo "<p style='margin-bottom: 20px;'>" . htmlspecialchars($prompt) . "</p>";

                            echo "<h2 style='color: #28a745;'>Response:</h2>";
                            echo "<p style='white-space: pre-wrap;'>" . nl2br(htmlspecialchars($responseData['message']['content'])) . "</p>";
                            echo "</div>";

                            echo "<div style='margin-top: 20px;'>";
                            echo "<h3>Was your question solved?</h3>";
                            echo "<div style='display: flex; justify-content: center; gap: 10px;'>";
                            echo "<form action='" . Config::get('URL') . "createTicket/index' method='get' style='display: inline-block;'>";
                            echo "<button type='submit' style='padding: 8px 15px; cursor: pointer; background-color: #dc3545; color: white; border: none; border-radius: 4px;'>No, Create New Ticket</button>";
                            echo "</form>";
                            echo "<form action='" . Config::get('URL') . "index/index' method='get' style='display: inline-block;'>";
                            echo "<button type='submit' style='padding: 8px 15px; cursor: pointer; background-color: #28a745; color: white; border: none; border-radius: 4px;'>Yes, my question was solved</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";

                            unset($_SESSION['history']);

                        } else {
                            echo "<div style='text-align: left; margin: 20px auto; padding: 10px; border-left: 4px solid #dc3545; background-color: #f8d7da;'>";
                            echo "<p><strong>Error:</strong> Invalid response format.</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div style='text-align: left; margin: 20px auto; padding: 10px; border-left: 4px solid #dc3545; background-color: #f8d7da;'>";
                        echo "<p><strong>Error:</strong> HTTP Status $statusCode - " . htmlspecialchars($response) . "</p>";
                        echo "</div>";
                    }
                }

                curl_close($ch);
            } else {
                echo "<div style='text-align: left; margin: 20px auto; padding: 10px; border-left: 4px solid #dc3545; background-color: #f8d7da;'>";
                echo "<p><strong>Error:</strong> Please enter a question.</p>";
                echo "</div>";
            }
        }
        ?>

        <?php if ($this->tickets): ?>
            <table class="ticket-table display" style="width: 100%; margin: 20px 0;">
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
            paging: false,
            searching: false,
            order: [[0, 'asc']],
        });
    });

    const textarea = document.getElementById('prompt');
    const form = textarea.closest('form');

    textarea.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            form.submit();
        }
    });
</script>
