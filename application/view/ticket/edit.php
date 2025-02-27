<?php
// Connect to database
require_once __DIR__ . "/../config/config.development.php"; // Adjust this based on your setup

// Get the ticket ID from URL
$ticket_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch ticket data from the database
$query = $pdo->prepare("SELECT * FROM support_tickets WHERE id = ?");
$query->execute([$ticket_id]);
$ticket = $query->fetch(PDO::FETCH_ASSOC);

// If ticket not found, show error
if (!$ticket) {
    die("Ticket not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <form class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg" action="update_ticket.php" method="POST">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Support Ticket</h2>

            <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket['id']) ?>">

            <!-- Subject -->
            <div class="mb-4">
                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($ticket['subject']) ?>" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($ticket['description']) ?></textarea>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                <select id="status" name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php
                    $statuses = ['new', 'open', 'on_hold', 'solved', 'closed'];
                    foreach ($statuses as $status) {
                        $selected = ($ticket['status'] == $status) ? 'selected' : '';
                        echo "<option value=\"$status\" $selected>" . ucfirst(str_replace('_', ' ', $status)) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Priority Dropdown -->
            <div class="mb-4">
                <label for="priority" class="block text-gray-700 font-medium mb-2">Priority</label>
                <select id="priority" name="priority"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php
                    $priorities = ['low', 'medium', 'high'];
                    foreach ($priorities as $priority) {
                        $selected = ($ticket['priority'] == $priority) ? 'selected' : '';
                        echo "<option value=\"$priority\" $selected>" . ucfirst($priority) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Category Dropdown -->
            <div class="mb-6">
                <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                <select id="category" name="category"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php
                    $categories = ['billing' => 'Billing & Returns', 'technical' => 'Technical Support', 'general' => 'General Inquiry'];
                    foreach ($categories as $value => $label) {
                        $selected = ($ticket['category'] == $value) ? 'selected' : '';
                        echo "<option value=\"$value\" $selected>$label</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Ticket
                </button>
            </div>
        </form>
    </div>
</body>
</html>
