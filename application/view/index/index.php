<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AIChatModel::handleRequest(true);
}
?>
    <div class="w-full px-4">
        <div class="w-full mx-auto text-center">
            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>

            <h2 class="text-2xl font-bold text-blue-600 mb-3 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                Tickify AI
            </h2>

            <div class="flex flex-col h-auto min-h-[300px] max-h-[500px] w-full max-w-7xl mx-auto rounded-2xl overflow-hidden bg-white shadow-sm">
                <!-- chat History -->
                <div id="chat-history" class="flex-1 overflow-y-auto p-5 space-y-4">
                    <!-- messages will appear here -->
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

                    // display any API errors
                    if (isset($_SESSION['api_error'])) {
                        echo '<div class="flex justify-start mb-3">';
                        echo '<div class="bg-red-100 text-red-800 rounded-lg py-2 px-4 max-w-[70%]">';
                        echo '<strong>Error:</strong> ' . htmlspecialchars($_SESSION['api_error']);
                        echo '</div>';
                        echo '</div>';

                        // clear the error after displaying it
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

                <!-- chat input -->
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <form method="post" class="flex gap-2" id="chat-form">
                        <textarea id="prompt" name="prompt" rows="1" placeholder="Type your message here..." required class="flex-1 rounded-full px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none overflow-hidden"></textarea>
                        <button type="submit" class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </form>
                </div>
            </div>

            <?php if ($this->tickets): ?>
                <div class="w-full max-w-7xl mx-auto mt-8">
                    <!-- Desktop view: table - only show on larger screens (lg and above) -->
                    <div class="hidden lg:block rounded-xl shadow-sm w-full max-w-[1000px] mx-auto">
                        <table id="ticketsTable" class="w-full bg-white table-fixed">
                            <thead>
                            <tr class="bg-gradient-to-r from-blue-50 to-blue-100">
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Subject</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Priority</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Created At</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($this->tickets as $ticket): ?>
                                <tr class="ticket-row hover:bg-gray-50 transition duration-150 ease-in-out" data-id="<?= $ticket->id; ?>">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $ticket->id; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= htmlentities($ticket->subject); ?></td>
                                    <td class="px-6 py-4 truncate max-w-[200px] text-sm text-gray-500"><?= htmlentities($ticket->description); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php
                                        if ($ticket->priority === 'high') {
                                            echo 'bg-red-100 text-red-800';
                                        } elseif ($ticket->priority === 'medium') {
                                            echo 'bg-yellow-100 text-yellow-800';
                                        } else {
                                            echo 'bg-green-100 text-green-800';
                                        }
                                        ?>">
                                            <?= ucfirst($ticket->priority); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= htmlentities($ticket->category); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php
                                        if ($ticket->status === 'new') {
                                            echo 'bg-blue-100 text-blue-800';
                                        } elseif ($ticket->status === 'open') {
                                            echo 'bg-purple-100 text-purple-800';
                                        } elseif ($ticket->status === 'on_hold') {
                                            echo 'bg-orange-100 text-orange-800';
                                        } elseif ($ticket->status === 'solved') {
                                            echo 'bg-green-100 text-green-800';
                                        } else {
                                            echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                            <?= ucfirst(str_replace('_', ' ', $ticket->status)); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= $ticket->created_at; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>"
                                               class="inline-flex items-center px-2 py-1 border border-blue-100 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 w-[50px] justify-center">
                                                <heroicon-pencil class="h-3.5 w-3.5 mr-1"/>
                                                Edit
                                            </a>
                                            <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>"
                                               onclick="return confirm('Are you sure you want to delete this ticket?');"
                                               class="inline-flex items-center px-3 py-1.5 border border-red-100 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 min-w-fit justify-center">
                                                <heroicon-trash class="h-3.5 w-3.5 mr-0.5" />Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile view: card layout - show on all mobile and tablet devices (below lg) -->
                    <div class="lg:hidden w-full max-w-full">
                        <div class="grid grid-cols-1 gap-4 px-2 sm:px-4 py-3">
                            <?php foreach ($this->tickets as $ticket): ?>
                                <div class="ticket-card bg-white rounded-lg shadow-sm p-3 sm:p-4 border border-gray-100 hover:shadow-md transition duration-200" data-id="<?= $ticket->id; ?>">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="text-sm font-semibold text-gray-700">ID: <?= $ticket->id; ?></span>
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap
                                        <?php
                                        if ($ticket->status === 'new') {
                                            echo 'bg-blue-100 text-blue-800';
                                        } elseif ($ticket->status === 'open') {
                                            echo 'bg-purple-100 text-purple-800';
                                        } elseif ($ticket->status === 'on_hold') {
                                            echo 'bg-orange-100 text-orange-800';
                                        } elseif ($ticket->status === 'solved') {
                                            echo 'bg-green-100 text-green-800';
                                        } else {
                                            echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                            <?= ucfirst(str_replace('_', ' ', $ticket->status)); ?>
                                        </span>
                                    </div>

                                    <h3 class="font-medium text-gray-900 mb-1"><?= htmlentities($ticket->subject); ?></h3>
                                    <p class="text-xs text-gray-600 mb-3 line-clamp-2"><?= htmlentities($ticket->description); ?></p>

                                    <div class="grid grid-cols-2 gap-2 mb-3 text-xs">
                                        <div>
                                            <span class="text-gray-500">Priority:</span>
                                            <span class="ml-1 px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full
                                            <?php
                                            if ($ticket->priority === 'high') {
                                                echo 'bg-red-100 text-red-800';
                                            } elseif ($ticket->priority === 'medium') {
                                                echo 'bg-yellow-100 text-yellow-800';
                                            } else {
                                                echo 'bg-green-100 text-green-800';
                                            }
                                            ?>">
                                                <?= ucfirst($ticket->priority); ?>
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Category:</span>
                                            <span class="ml-1 text-gray-700"><?= htmlentities($ticket->category); ?></span>
                                        </div>
                                    </div>

                                    <div class="text-xs text-gray-500 mb-3">Created: <?= $ticket->created_at; ?></div>

                                    <div class="flex space-x-2">
                                        <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>"
                                           class="inline-flex items-center px-2.5 py-1.5 border border-blue-100 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 whitespace-nowrap">
                                            <heroicon-pencil class="h-3.5 w-3.5 mr-1" />
                                            Edit
                                        </a>
                                        <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>"
                                           onclick="return confirm('Are you sure you want to delete this ticket?');"
                                           class="inline-flex items-center px-3 py-1.5 border border-red-100 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 min-w-fit justify-center">
                                            <heroicon-trash class="h-3.5 w-3.5" />
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200 mt-8">
                    <p class="text-gray-500 text-lg">No tickets found. Create some!</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/jquery.dataTables.min.css" />

    <style>
        @media (max-width: 768px) {
            /* Mobile view adjustments */
            .w-3/5 {
            width: 95% !important;
        }

            /* Make chat history scrollable */
            #chat-history {
                max-height: 400px;
            }

            /* Line clamp for description */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Make chat history scrollable */
            #chat-history {
                max-height: 400px;
            }

            /* Adjust DataTables filter and search on mobile */
            .dataTables_wrapper .dataTables_filter {
                width: 100%;
                margin-bottom: 10px;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin-left: 0;
            }

            /* Fix card layout in mobile view */
            .ticket-card {
                width: 100% !important;
                box-sizing: border-box;
            }

            .lg\:hidden > div {
                width: 100% !important;
            }
        }
    </style>

    <script>
        $(document).ready(function () {
            // init tickets table with basic config for desktop view
            $('#ticketsTable').DataTable({
                paging: false,
                order: [[0, 'asc']],
                autoWidth: false,
                responsive: true,
                info: false,
                scrollX: false,
                columnDefs: [
                    { width: '5%', targets: 0, responsivePriority: 1 },
                    { width: '15%', targets: 1, responsivePriority: 2 },
                    { width: '30%', targets: 2, responsivePriority: 3 },
                    { width: '8%', targets: 3, responsivePriority: 4 },
                    { width: '10%', targets: 4, responsivePriority: 6 },
                    { width: '8%', targets: 5, responsivePriority: 5 },
                    { width: '12%', targets: 6, responsivePriority: 7 },
                    { width: '12%', targets: 7, responsivePriority: 1 }
                ],
                "drawCallback": function() {
                    attachClickHandlers();

                    // style buttons on redraw
                    $('.paginate_button').addClass('px-3 py-1.5 mx-1 rounded-full text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-300');
                    $('.paginate_button.current').addClass('bg-blue-500 text-white hover:bg-blue-600');
                    $('.paginate_button.disabled').addClass('text-gray-400 cursor-not-allowed');
                },
                language: {
                    lengthMenu: "_MENU_ per page",
                    info: "_START_-_END_ of _TOTAL_ tickets",
                    infoEmpty: "No tickets found"
                },
                dom: '<"flex flex-wrap gap-4 items-center justify-between py-4"<"flex items-center"l>>rt<"flex flex-wrap gap-4 items-center justify-between py-4"<"flex items-center"i><"flex items-center"p>>'
            });

            function attachClickHandlers() {
                // Desktop view: table rows
                $('.ticket-row').off('click').on('click', function () {
                    window.location.href = '<?= Config::get("URL"); ?>ticketHandler/index/' + $(this).data('id');
                });
                $('.ticket-row a').off('click').on('click', function (e) { e.stopPropagation(); });

                // Mobile view: card items
                $('.ticket-card').off('click').on('click', function () {
                    window.location.href = '<?= Config::get("URL"); ?>ticketHandler/index/' + $(this).data('id');
                });
                $('.ticket-card a').off('click').on('click', function (e) { e.stopPropagation(); });
            }
            attachClickHandlers();

            // chat auto-scroll
            const chatHistory = document.getElementById('chat-history');
            if (chatHistory) chatHistory.scrollTop = chatHistory.scrollHeight;

            // message input handlers
            const textarea = document.getElementById('prompt');
            if (textarea) {
                // submit on enter
                textarea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); this.form.submit(); }
                });

                // auto-resize
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 100) + 'px';
                });
            }

            // style table elements
            $('.dataTables_length select').addClass('rounded-lg border border-gray-300 px-3 py-1.5 focus:ring-2 focus:ring-blue-500');
            $('.dataTables_filter input').addClass('rounded-full border border-gray-300 px-5 py-2 pl-10 focus:ring-2 focus:ring-blue-500 shadow-sm');
            $('.dataTables_paginate').addClass('flex items-center justify-center mt-4');
            $('.dataTables_info').addClass('text-gray-600 text-sm');
            $('table.dataTable').addClass('border-none').css('width', '100%');
            $('.dataTable thead th').addClass('border-b-2 border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100');
            $('table.dataTable tbody td').addClass('py-3');

            // Make table stay fixed width without scroll
            $('.dataTables_wrapper').addClass('w-full overflow-x-visible');
            $('table.dataTable').addClass('table-fixed w-full');

            function adjustForViewportSize() {
                // Only handle responsive layout adjustments - no menu manipulation
                // The mobile menu will be handled by the button click only
            }

            // Initial adjustment and listen for window resize
            adjustForViewportSize();
            $(window).resize(adjustForViewportSize);
        });
    </script>
<?php
// Flush the output buffer and send all output to the browser
// ob_end_flush();
?>