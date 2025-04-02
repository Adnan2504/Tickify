<?php
?>
<!-- SVG Icons -->
<svg xmlns="http://www.w3.org/2000/svg" class="hidden">
    <symbol id="edit" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
    </symbol>
    <symbol id="chat" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
    </symbol>
    <symbol id="trash" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
    </symbol>
</svg>

<!-- Outer container with gradient background -->
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8 overflow-hidden scrollbar-hide">
    <div class="w-full mx-auto text-center px-4">
        <!-- Render system feedback messages -->
        <?php $this->renderFeedbackMessages(); ?>

        <h2 class="text-2xl font-bold text-blue-600 mb-3 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            Tickify AI
        </h2>

        <!-- Chat container with white background -->
        <div class="flex flex-col h-auto min-h-[400px] max-h-[500px] w-full max-w-7xl mx-auto rounded-2xl overflow-hidden bg-white shadow-sm scrollbar-hide">
            <!-- Chat History -->
            <div id="chat-history" class="flex-1 overflow-y-auto p-5 space-y-4 scrollbar-hide">
                <?php
                if (isset($_SESSION['temp_index_history']) && count($_SESSION['temp_index_history']) > 1) {
                    for ($i = 1; $i < count($_SESSION['temp_index_history']); $i++) {
                        $message = $_SESSION['temp_index_history'][$i];
                        if ($message['role'] === 'user') {
                            echo '<div class="flex justify-end mb-3">';
                            echo '<div class="bg-blue-500 text-white rounded-lg py-2 px-4 max-w-[70%] break-words">';
                            echo htmlspecialchars($message['content']);
                            echo '</div>';
                            echo '</div>';
                        } else if ($message['role'] === 'assistant') {
                            echo '<div class="flex justify-start mb-3">';
                            echo '<div class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 max-w-[70%] break-words">';
                            echo nl2br(htmlspecialchars($message['content']));
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
                if (isset($_SESSION['api_error'])) {
                    echo '<div class="flex justify-start mb-3">';
                    echo '<div class="bg-red-100 text-red-800 rounded-lg py-2 px-4 max-w-[70%]">';
                    echo '<strong>Error:</strong> ' . htmlspecialchars($_SESSION['api_error']);
                    echo '</div>';
                    echo '</div>';
                    unset($_SESSION['api_error']);
                }
                ?>
                <?php if (isset($_SESSION['temp_index_history']) && count($_SESSION['temp_index_history']) > 1 && end($_SESSION['temp_index_history'])['role'] === 'assistant'): ?>
                    <div class="mt-4 border-t pt-4">
                        <h3 class="text-center font-bold mb-3">Was your question solved?</h3>
                        <div class="flex justify-center gap-4 flex-wrap">
                            <form action="<?= Config::get('URL') ?>createTicket/index" method="get">
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    No, Create New Ticket
                                </button>
                            </form>
                            <form action="<?= Config::get('URL') ?>index/index" method="post">
                                <input type="hidden" name="reset_session" value="1">
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                    Yes, my question was solved
                                </button>
                            </form>
                            <form action="<?= Config::get('URL') ?>index/index" method="post">
                                <input type="hidden" name="continue_in_chat" value="1">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Continue in AI Chat
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Chat Input -->
            <div class="p-4 bg-gray-50 border-t border-gray-200">
                <form method="post" class="flex gap-2" id="chat-form" onsubmit="this.submitted=true;">
                    <input type="hidden" name="form_submitted" value="1">
                    <textarea id="prompt" name="prompt" rows="1" placeholder="Type your message here... (Press Enter to send message)"
                              required
                              class="flex-1 rounded-full px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none min-h-[40px] max-h-[72px] scrollbar-hide overflow-y-auto"></textarea>
                    <button type="submit"
                            class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <?php if ($this->tickets): ?>
            <?php
            // Reverse the tickets once so newest is on top
            $reversedTickets = array_reverse($this->tickets);
            ?>
            <div class="w-full max-w-7xl mx-auto mt-8">
                <!-- Desktop View: Larger table layout, columns centered -->
                <div class="hidden lg:block">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <table class="w-full text-center divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                            <tr>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">Subject</th>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">Description</th>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">Priority</th>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">Category</th>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">Created At</th>
                                <th class="px-8 py-3 text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                            <?php foreach ($reversedTickets as $ticket): ?>
                                <tr class="ticket-row hover:bg-gray-50 transition duration-150 ease-in-out cursor-pointer"
                                    data-id="<?= $ticket->id; ?>">
                                    <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= $ticket->id; ?>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= htmlentities($ticket->subject); ?>
                                    </td>
                                    <!-- Remove hidden newlines from description to keep row height consistent -->
                                    <td class="px-8 py-4 truncate max-w-[250px] text-sm text-gray-500">
                                        <?= htmlentities(str_replace("\n", "", $ticket->description)); ?>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php
                                        if ($ticket->priority === 'high') {
                                            echo 'bg-red-100 text-red-800';
                                        } elseif ($ticket->priority === 'medium' || strtolower($ticket->priority) === 'mid') {
                                            echo 'bg-yellow-100 text-yellow-800';
                                        } else {
                                            echo 'bg-green-100 text-green-800';
                                        }
                                        ?>">
                                            <?= ucfirst($ticket->priority); ?>
                                        </span>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= htmlentities($ticket->category); ?>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php
                                        if ($ticket->status === 'waiting') {
                                            echo 'bg-blue-100 text-blue-800';
                                        } elseif ($ticket->status === 'open') {
                                            echo 'bg-purple-100 text-purple-800';
                                        } elseif ($ticket->status === 'resolved') {
                                            echo 'bg-green-100 text-green-800';
                                        } else {
                                            echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                            <?= ucfirst($ticket->status); ?>
                                        </span>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= $ticket->created_at; ?>
                                    </td>
                                    <td class="px-8 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-center space-x-2">
                                            <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-blue-100 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 transition-all duration-200">
                                                Edit
                                            </a>
                                            <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>"
                                               onclick="return confirm('Are you sure you want to delete this ticket?');"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-red-100 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 transition-all duration-200">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile View: Card Layout with matching button styles -->
                <div class="lg:hidden">
                    <div id="mobileTicketContainer" class="grid grid-cols-1 gap-4 px-2 sm:px-4 py-3">
                        <?php if (empty($reversedTickets)): ?>
                            <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-gray-500 text-lg">No tickets found. Create some!</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($reversedTickets as $ticket): ?>
                                <div class="ticket-card bg-white rounded-lg shadow-sm p-4 border border-gray-100 hover:shadow-md transition duration-200 cursor-pointer"
                                     data-id="<?= $ticket->id; ?>"
                                     onclick="if (!event.target.closest('a')) window.location.href='<?= Config::get('URL'); ?>ticketHandler/index/<?= $ticket->id; ?>'">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="text-sm font-semibold text-gray-700">ID: <?= $ticket->id; ?></span>
                                        <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-full <?php
                                        if ($ticket->status === 'waiting') {
                                            echo 'bg-blue-100 text-blue-800';
                                        } elseif ($ticket->status === 'open') {
                                            echo 'bg-purple-100 text-purple-800';
                                        } elseif ($ticket->status === 'resolved') {
                                            echo 'bg-green-100 text-green-800';
                                        } else {
                                            echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                            <?= ucfirst($ticket->status); ?>
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        <h3 class="font-medium text-gray-900"><?= htmlentities($ticket->subject); ?></h3>
                                        <p class="text-sm text-gray-500"><?= htmlentities($ticket->description); ?></p>
                                    </div>
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php
                                        if ($ticket->priority === 'high') {
                                            echo 'bg-red-100 text-red-800';
                                        } elseif ($ticket->priority === 'medium' || strtolower($ticket->priority) === 'mid') {
                                            echo 'bg-yellow-100 text-yellow-800';
                                        } else {
                                            echo 'bg-green-100 text-green-800';
                                        }
                                        ?>">
                                            <?= ucfirst($ticket->priority); ?>
                                        </span>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                            <?= htmlentities($ticket->category); ?>
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500"><?= $ticket->created_at; ?></span>
                                        <div class="flex gap-2">
                                            <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-blue-100 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 transition-all duration-200">
                                                Edit
                                            </a>
                                            <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>"
                                               onclick="return confirm('Are you sure you want to delete this ticket?');"
                                               class="inline-flex items-center px-2.5 py-1.5 border border-red-100 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 transition-all duration-200">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200 mt-8">
                <p class="text-gray-500 text-lg">No tickets found. Create some!</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Enter key to send message
            $('#prompt').on('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    $('#chat-form').submit();
                }
            });
            // Auto-expand textarea
            $('#prompt').on('input', function() {
                this.style.height = 'auto';
                const maxHeight = 96; // ~4 rows
                const newHeight = Math.min(this.scrollHeight, maxHeight);
                this.style.height = newHeight + 'px';
            });
            // Desktop table row click
            $('.ticket-row').on('click', function () {
                window.location.href = '<?= Config::get("URL"); ?>ticketHandler/index/' + $(this).data('id');
            });
            $('.ticket-row a').on('click', function (e) {
                e.stopPropagation();
            });
            // Mobile card click
            $('.ticket-card a').on('click', function (e) {
                e.stopPropagation();
            });
            // Scroll chat to bottom
            const chatHistory = document.getElementById('chat-history');
            if (chatHistory) chatHistory.scrollTop = chatHistory.scrollHeight;
        });
    </script>
</div>