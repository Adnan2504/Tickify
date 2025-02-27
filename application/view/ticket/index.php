<div class="container mx-auto px-4 py-4">
    <div class="box bg-white rounded shadow p-4">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->tickets): ?>
            <div class="overflow-x-auto">
                <table id="ticketsTable" class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-left">
                            <th class="py-2 px-3 font-semibold">ID</th>
                            <th class="py-2 px-3 font-semibold">Subject</th>
                            <th class="py-2 px-3 font-semibold">Description</th>
                            <th class="py-2 px-3 font-semibold">Priority</th>
                            <th class="py-2 px-3 font-semibold">Category</th>
                            <th class="py-2 px-3 font-semibold">Status</th>
                            <th class="py-2 px-3 font-semibold">Created At</th>
                            <th class="py-2 px-3 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->tickets as $ticket): ?>
                            <tr class="ticket-row hover:bg-gray-50 border-b" data-id="<?= $ticket->id; ?>">
                                <td class="py-2 px-3"><?= $ticket->id; ?></td>
                                <td class="py-2 px-3"><?= htmlentities($ticket->subject); ?></td>
                                <td class="py-2 px-3 truncate max-w-[200px]"><?= htmlentities($ticket->description); ?></td>
                                <td class="py-2 px-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
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
                                <td class="py-2 px-3"><?= htmlentities($ticket->category); ?></td>
                                <td class="py-2 px-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
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
                                <td class="py-2 px-3"><?= $ticket->created_at; ?></td>
                                <td class="py-2 px-3">
                                    <div class="flex space-x-2">
                                        <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>" class="text-blue-600 hover:text-blue-800">
                                            <span class="underline">Edit</span>
                                        </a>
                                        <span class="text-gray-500">|</span>
                                        <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>" 
                                        onclick="return confirm('Are you sure you want to delete this ticket?');" 
                                        class="text-red-600 hover:text-red-800">
                                            <span class="underline">Delete</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-4 text-gray-600">No tickets found. Create some!</div>
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
                        { width: '5%', targets: 0 },  // ID column
                        { width: '15%', targets: 1 }, // Subject column
                        { width: '18%', targets: 2 }, // Description column
                        { width: '8%', targets: 3 },  // Priority column
                        { width: '10%', targets: 4 }, // Category column 
                        { width: '10%', targets: 5 }, // Status column
                        { width: '14%', targets: 6 }, // Created At column
                        { width: '10%', targets: 7 }  // Actions column
                    ],
                    "drawCallback": function() {
                        // Re-attach click handlers after DataTables redraws
                        attachClickHandlers();
                    }
                });

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
    </div>
</div>