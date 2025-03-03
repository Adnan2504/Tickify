<div class="container mx-auto px-4 py-6">
    <div class="box bg-white rounded-xl shadow-lg p-6 max-w-full">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->tickets): ?>
            <div class="rounded-xl border border-gray-200 shadow-sm">
                <table id="ticketsTable" class="w-full bg-white">
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
                                       class="inline-flex items-center px-2.5 py-1.5 border border-blue-100 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                        <svg class="h-3.5 w-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>"
                                       onclick="return confirm('Are you sure you want to delete this ticket?');"
                                       class="inline-flex items-center px-2.5 py-1.5 border border-red-100 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                        <svg class="h-3.5 w-3.5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-500 text-lg">No tickets found. Create some!</p>
            </div>
        <?php endif; ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/jquery.dataTables.min.css" />

        <script>
            $(document).ready(function () {
                $('#ticketsTable').DataTable({
                    responsive: true,
                    paging: true,
                    searching: true,
                    order: [[0, 'asc']],
                    columnDefs: [
                        { width: '4%', targets: 0 },   // ID column
                        { width: '12%', targets: 1 },  // Subject column
                        { width: '20%', targets: 2 },  // Description column
                        { width: '8%', targets: 3 },   // Priority column
                        { width: '10%', targets: 4 },  // Category column
                        { width: '10%', targets: 5 },  // Status column
                        { width: '14%', targets: 6 },  // Created At column
                        { width: '12%', targets: 7 }   // Actions column
                    ],
                    "drawCallback": function() {
                        // Re-attach click handlers after DataTables redraws
                        attachClickHandlers();

                        // Apply custom styles to pagination buttons on each draw
                        $('.paginate_button').addClass('px-3 py-1.5 mx-1 rounded-full text-blue-600 hover:text-blue-800 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-300');
                        $('.paginate_button.current').addClass('bg-blue-500 text-white hover:text-white hover:bg-blue-600');
                        $('.paginate_button.disabled').addClass('text-gray-400 cursor-not-allowed hover:bg-transparent');
                    },
                    // Modern styling for DataTables with Tailwind
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search tickets...",
                        lengthMenu: "_MENU_ per page",
                        info: "_START_-_END_ of _TOTAL_ tickets",
                        infoEmpty: "No tickets found",
                        infoFiltered: "(filtered from _MAX_ total)"
                    },
                    dom: '<"flex flex-wrap gap-4 items-center justify-between py-4"<"flex items-center"l><"flex items-center"f>>rt<"flex flex-wrap gap-4 items-center justify-between py-4"<"flex items-center"i><"flex items-center"p>>'
                });

                // Add custom styling to DataTables elements
                $('.dataTables_length select').addClass('rounded-lg border border-gray-300 text-gray-700 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500');
                $('.dataTables_filter input').addClass('rounded-full border border-gray-300 text-gray-700 px-5 py-2 pl-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm');

                function attachClickHandlers() {
                    $('.ticket-row').off('click').on('click', function () {
                        const ticketId = $(this).data('id');
                        window.location.href = '<?= Config::get("URL"); ?>ticketHandler/index/' + ticketId;
                    });

                    $('.ticket-row a').off('click').on('click', function (e) {
                        e.stopPropagation();
                    });
                }

                // Initial attachment of handlers
                attachClickHandlers();
            });
        </script>

        <script>
            // Apply Tailwind styles to DataTables elements after initialization
            $(document).ready(function() {
                // Style the pagination buttons
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-1.5 mx-1 rounded-full hover:bg-blue-50 transition-colors duration-200');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-500 text-white font-medium hover:bg-blue-600');
                $('.dataTables_paginate .paginate_button.disabled').addClass('text-gray-400 cursor-not-allowed hover:bg-transparent');

                // Style the length selector
                $('.dataTables_length select').addClass('mx-2 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm');

                // Style info and processing
                $('.dataTables_info').addClass('text-gray-600 text-sm');

                // Remove default DataTables borders
                $('table.dataTable').addClass('border-none');

                // Ensure the table header looks good
                $('.dataTable thead th').addClass('border-b-2 border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100');

                // Fix for horizontal scrolling - ensure table takes full width and no overflow
                $('.dataTables_wrapper').addClass('w-full');
                $('.dataTables_scrollBody').css('overflow-x', 'hidden');

                // Add some custom styling to improve the search bar
                $('.dataTables_filter').addClass('relative');
                $('.dataTables_filter input').css('min-width', '250px');

                // Improve spacing for better readability
                $('table.dataTable tbody td').addClass('py-3');
            });
        </script>
    </div>
</div>