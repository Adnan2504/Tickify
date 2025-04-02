<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 px-4 sm:px-6 lg:px-8 pt-8 overflow-x-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Ticket List</h1>
            <p class="text-gray-600">Here you can see all the tickets created</p>
        </div>
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->tickets): ?>

            <!-- Desktop View Filtering Form -->
            <div class="hidden lg:block mb-4">
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <!-- Search Box -->
                    <div class="mb-4">
                        <input type="text" id="desktopSearch" placeholder="Search tickets (by subject, description, id or date)..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <!-- Filter Options: Category, Priority, Status -->
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Category Filters -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Category</p>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="desktop-category-filter rounded text-blue-500" value="bug">
                                    <span class="ml-2 text-sm">Bug</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="desktop-category-filter rounded text-blue-500" value="feature request">
                                    <span class="ml-2 text-sm">Feature Request</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="desktop-category-filter rounded text-blue-500" value="improvement">
                                    <span class="ml-2 text-sm">Improvement</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="desktop-category-filter rounded text-blue-500" value="task">
                                    <span class="ml-2 text-sm">Task</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="desktop-category-filter rounded text-blue-500" value="documentation">
                                    <span class="ml-2 text-sm">Documentation</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="desktop-category-filter rounded text-blue-500" value="support">
                                    <span class="ml-2 text-sm">Support</span>
                                </label>
                            </div>
                        </div>
                        <!-- Priority Filters -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Priority</p>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="priority[]" class="desktop-priority-filter rounded text-blue-500" value="high">
                                    <span class="ml-2 text-sm">High</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="priority[]" class="desktop-priority-filter rounded text-blue-500" value="medium">
                                    <span class="ml-2 text-sm">Medium</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="priority[]" class="desktop-priority-filter rounded text-blue-500" value="low">
                                    <span class="ml-2 text-sm">Low</span>
                                </label>
                            </div>
                        </div>
                        <!-- Status Filters -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Status</p>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="status[]" class="desktop-status-filter rounded text-blue-500" value="waiting">
                                    <span class="ml-2 text-sm">Waiting</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="status[]" class="desktop-status-filter rounded text-blue-500" value="open">
                                    <span class="ml-2 text-sm">Open</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="status[]" class="desktop-status-filter rounded text-blue-500" value="resolved">
                                    <span class="ml-2 text-sm">Resolved</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Sorting Options: Date -->
                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Sort by Date</p>
                            <select id="desktopDateSort" class="w-full rounded-md border border-gray-300 px-3 py-1.5">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop View: Table Layout -->
            <div class="hidden lg:block">
                <div class="bg-white rounded-lg shadow-sm overflow-x-auto">
                    <table id="ticketsTable" class="w-full divide-y divide-gray-200 min-w-max">
                        <thead class="bg-gray-200">
                        <tr>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Subject</th>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Description</th>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Priority</th>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Category</th>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Created At</th>
                            <th class="xl:px-6 xl:py-3 lg:px-3 lg:py-2 px-2 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                        <?php foreach ($this->tickets as $ticket): ?>
                            <tr class="ticket-row hover:bg-gray-50 transition duration-150 ease-in-out cursor-pointer"
                                data-id="<?= $ticket->id; ?>"
                                data-date="<?= $ticket->created_at; ?>"
                                data-category="<?= strtolower($ticket->category); ?>"
                                data-priority="<?= strtolower($ticket->priority); ?>"
                                data-status="<?= strtolower($ticket->status); ?>"
                                onclick="if (!event.target.closest('a')) window.location.href='<?= Config::get('URL'); ?>ticketHandler/index/<?= $ticket->id; ?>'">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $ticket->id; ?></td>
                                <td class="xl:px-6 xl:py-4 lg:px-3 lg:py-2 px-2 py-2 truncate xl:max-w-[200px] lg:max-w-[150px] max-w-[100px] text-sm text-gray-700"><?= htmlentities($ticket->subject); ?></td>
                                <td class="xl:px-6 lg:px-4 px-2 py-2 truncate xl:max-w-[200px] lg:max-w-[150px] max-w-[100px] text-sm text-gray-500"><?= htmlentities($ticket->description); ?></td>
                                <td class="xl:px-6 lg:px-3 px-2 py-2 whitespace-nowrap">
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= htmlentities($ticket->category); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                <td class="xl:px-6 xl:py-4 lg:px-3 lg:py-2 px-2 py-2 truncate xl:max-w-[200px] lg:max-w-[100px] max-w-[80px] text-sm text-gray-700"><?= $ticket->created_at; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>" class="inline-flex items-center px-2.5 py-1.5 border border-blue-100 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 transition-all duration-200">
                                            Edit
                                        </a>
                                        <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>" onclick="return confirm('Are you sure you want to delete this ticket?');" class="inline-flex items-center px-2.5 py-1.5 border border-red-100 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 transition-all duration-200">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Custom Pagination for Desktop (reduced bottom margin) -->
                    <div id="desktopPagination" class="flex justify-center mt-4 mb-4"></div>
                </div>
            </div>

            <!-- Mobile View: Card Layout -->
            <div class="lg:hidden px-2 sm:px-4 py-3">
                <div class="mb-4 p-4 bg-white rounded-lg border border-gray-200">
                    <!-- Search Box -->
                    <div class="mb-4">
                        <input type="text" id="mobileSearch" placeholder="Search tickets (by subject, description, id or date)..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <!-- Filter Options -->
                    <div class="mb-4 p-4 bg-white rounded-lg border border-gray-200">
                        <!-- Category Filters -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Category</p>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="mobile-category-filter rounded text-blue-500" value="bug">
                                    <span class="ml-2 text-sm">Bug</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="mobile-category-filter rounded text-blue-500" value="feature request">
                                    <span class="ml-2 text-sm">Feature Request</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="mobile-category-filter rounded text-blue-500" value="improvement">
                                    <span class="ml-2 text-sm">Improvement</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="mobile-category-filter rounded text-blue-500" value="task">
                                    <span class="ml-2 text-sm">Task</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="mobile-category-filter rounded text-blue-500" value="documentation">
                                    <span class="ml-2 text-sm">Documentation</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="category[]" class="mobile-category-filter rounded text-blue-500" value="support">
                                    <span class="ml-2 text-sm">Support</span>
                                </label>
                            </div>
                        </div>
                        <!-- Priority Filters -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Priority</p>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="priority[]" class="mobile-priority-filter rounded text-blue-500" value="high">
                                    <span class="ml-2 text-sm">High</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="priority[]" class="mobile-priority-filter rounded text-blue-500" value="medium">
                                    <span class="ml-2 text-sm">Medium</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="priority[]" class="mobile-priority-filter rounded text-blue-500" value="low">
                                    <span class="ml-2 text-sm">Low</span>
                                </label>
                            </div>
                        </div>
                        <!-- Status Filters -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Status</p>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="status[]" class="mobile-status-filter rounded text-blue-500" value="waiting">
                                    <span class="ml-2 text-sm">Waiting</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="status[]" class="mobile-status-filter rounded text-blue-500" value="open">
                                    <span class="ml-2 text-sm">Open</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="status[]" class="mobile-status-filter rounded text-blue-500" value="resolved">
                                    <span class="ml-2 text-sm">Resolved</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Sorting Options -->
                    <div class="grid grid-cols-1 gap-4 mt-4">
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Sort by Date</p>
                            <select id="mobileDateSort" class="w-full rounded-md border border-gray-300 px-3 py-1.5">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Mobile Tickets Card Layout -->
                <div id="mobileTicketContainer" class="grid grid-cols-1 gap-4">
                    <?php if(empty($this->tickets)): ?>
                        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-gray-500 text-lg">Sorry, we couldn't find any tickets matching your filters.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($this->tickets as $ticket): ?>
                            <div class="ticket-card bg-white rounded-lg shadow-sm p-4 border border-gray-100 hover:shadow-md transition duration-200 cursor-pointer"
                                 data-id="<?= $ticket->id; ?>"
                                 data-date="<?= $ticket->created_at; ?>"
                                 data-category="<?= strtolower($ticket->category); ?>"
                                 data-priority="<?= strtolower($ticket->priority); ?>"
                                 data-status="<?= strtolower($ticket->status); ?>"
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
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700"><?= htmlentities($ticket->category); ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500"><?= $ticket->created_at; ?></span>
                                    <div class="flex gap-2">
                                        <a href="<?= Config::get('URL') . 'ticket/edit/' . $ticket->id; ?>" class="text-blue-700">Edit</a>
                                        <a href="<?= Config::get('URL') . 'ticket/delete/' . $ticket->id; ?>" onclick="return confirm('Are you sure you want to delete this ticket?');" class="text-red-700">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <!-- Custom Pagination for Mobile (reduced bottom margin) -->
                <div id="mobilePagination" class="flex justify-center mt-4 mb-4"></div>
            </div>

        <?php else: ?>
            <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-500 text-lg">No tickets found. Create some!</p>
            </div>
        <?php endif; ?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Global variables for pagination and filtering
            var originalDesktopRows = [];
            var originalMobileCards = [];
            var filteredDesktopRows = [];
            var filteredMobileCards = [];
            var desktopCurrentPage = 1;
            var desktopRowsPerPage = 10;
            var mobileCurrentPage = 1;
            var mobileCardsPerPage = 10;

            $(document).ready(function(){
                originalDesktopRows = $('#ticketsTable tbody tr').toArray();
                originalMobileCards = $('#mobileTicketContainer .ticket-card').toArray();

                // Desktop filtering function
                function desktopFilter() {
                    var searchText = $.trim($('#desktopSearch').val()).toLowerCase();
                    var selectedCategories = $('.desktop-category-filter:checked').map(function() { return $.trim($(this).val()).toLowerCase(); }).get();
                    var selectedPriorities = $('.desktop-priority-filter:checked').map(function() { return $.trim($(this).val()).toLowerCase(); }).get();
                    var selectedStatuses = $('.desktop-status-filter:checked').map(function() { return $.trim($(this).val()).toLowerCase(); }).get();
                    var dateSort = $('#desktopDateSort').val();
                    var idSort = 'lowest'; // default

                    var rows = originalDesktopRows.slice();

                    rows = rows.filter(function(row) {
                        var $row = $(row);
                        var subject = $.trim($row.find('td:nth-child(2)').text()).toLowerCase();
                        var description = $.trim($row.find('td:nth-child(3)').text()).toLowerCase();
                        var idText = $.trim($row.find('td:nth-child(1)').text()).toLowerCase();
                        var createdAt = $.trim($row.find('td:nth-child(7)').text()).toLowerCase();
                        var matchesSearch = (searchText === "") || (subject.indexOf(searchText) !== -1 ||
                            description.indexOf(searchText) !== -1 ||
                            idText.indexOf(searchText) !== -1 ||
                            createdAt.indexOf(searchText) !== -1);
                        var category = $.trim($row.attr('data-category') || "").toLowerCase();
                        var priority = $.trim($row.attr('data-priority') || "").toLowerCase();
                        if(priority === "mid") { priority = "medium"; }
                        var status = $.trim($row.attr('data-status') || "").toLowerCase();
                        var matchesCategory = (selectedCategories.length === 0) || (selectedCategories.indexOf(category) !== -1);
                        var matchesPriority = (selectedPriorities.length === 0) || (selectedPriorities.indexOf(priority) !== -1);
                        var matchesStatus = (selectedStatuses.length === 0) || (selectedStatuses.indexOf(status) !== -1);
                        return matchesSearch && matchesCategory && matchesPriority && matchesStatus;
                    });

                    if(searchText !== "") {
                        rows.sort(function(a, b) {
                            var subjectA = $.trim($(a).find('td:nth-child(2)').text()).toLowerCase();
                            var descriptionA = $.trim($(a).find('td:nth-child(3)').text()).toLowerCase();
                            var idA = $.trim($(a).find('td:nth-child(1)').text()).toLowerCase();
                            var dateA = $.trim($(a).find('td:nth-child(7)').text()).toLowerCase();
                            var subjectB = $.trim($(b).find('td:nth-child(2)').text()).toLowerCase();
                            var descriptionB = $.trim($(b).find('td:nth-child(3)').text()).toLowerCase();
                            var idB = $.trim($(b).find('td:nth-child(1)').text()).toLowerCase();
                            var dateB = $.trim($(b).find('td:nth-child(7)').text()).toLowerCase();
                            var scoreA = ((subjectA.match(new RegExp(searchText, "g")) || []).length +
                                (descriptionA.match(new RegExp(searchText, "g")) || []).length);
                            var scoreB = ((subjectB.match(new RegExp(searchText, "g")) || []).length +
                                (descriptionB.match(new RegExp(searchText, "g")) || []).length);
                            if(scoreB !== scoreA) return scoreB - scoreA;
                            var dA = new Date($.trim($(a).attr('data-date')));
                            var dB = new Date($.trim($(b).attr('data-date')));
                            if(dateSort === 'newest') {
                                if(dB - dA !== 0) return dB - dA;
                            } else {
                                if(dA - dB !== 0) return dA - dB;
                            }
                            var numA = parseInt($.trim($(a).attr('data-id')));
                            var numB = parseInt($.trim($(b).attr('data-id')));
                            return (idSort === 'lowest') ? numA - numB : numB - numA;
                        });
                    } else {
                        rows.sort(function(a, b) {
                            var dA = new Date($.trim($(a).attr('data-date')));
                            var dB = new Date($.trim($(b).attr('data-date')));
                            if(dateSort === 'newest') {
                                if(dB - dA !== 0) return dB - dA;
                            } else {
                                if(dA - dB !== 0) return dA - dB;
                            }
                            var numA = parseInt($.trim($(a).attr('data-id')));
                            var numB = parseInt($.trim($(b).attr('data-id')));
                            return (idSort === 'lowest') ? numA - numB : numB - numA;
                        });
                    }
                    filteredDesktopRows = rows; // store filtered results globally
                    $('#ticketsTable tbody').empty().append(rows);
                    desktopCurrentPage = 1;
                    paginateDesktop(filteredDesktopRows);
                }

                // Mobile filtering function
                function mobileFilter() {
                    var searchText = $.trim($('#mobileSearch').val()).toLowerCase();
                    var selectedCategories = $('.mobile-category-filter:checked').map(function() { return $.trim($(this).val()).toLowerCase(); }).get();
                    var selectedPriorities = $('.mobile-priority-filter:checked').map(function() { return $.trim($(this).val()).toLowerCase(); }).get();
                    var selectedStatuses = $('.mobile-status-filter:checked').map(function() { return $.trim($(this).val()).toLowerCase(); }).get();
                    var dateSort = $('#mobileDateSort').val();
                    var idSort = 'lowest';

                    var cards = originalMobileCards.slice();

                    cards = cards.filter(function(card) {
                        var $card = $(card);
                        var subject = $.trim($card.find('h3').text()).toLowerCase();
                        var description = $.trim($card.find('p').text()).toLowerCase();
                        var idText = $.trim($card.attr('data-id')).toLowerCase();
                        var dateText = $.trim($card.attr('data-date')).toLowerCase();
                        var matchesSearch = (searchText === "") || (subject.indexOf(searchText) !== -1 ||
                            description.indexOf(searchText) !== -1 ||
                            idText.indexOf(searchText) !== -1 ||
                            dateText.indexOf(searchText) !== -1);
                        var category = $.trim($card.attr('data-category') || "").toLowerCase();
                        var priority = $.trim($card.attr('data-priority') || "").toLowerCase();
                        if(priority === "mid") { priority = "medium"; }
                        var status = $.trim($card.attr('data-status') || "").toLowerCase();
                        var matchesCategory = (selectedCategories.length === 0) || (selectedCategories.indexOf(category) !== -1);
                        var matchesPriority = (selectedPriorities.length === 0) || (selectedPriorities.indexOf(priority) !== -1);
                        var matchesStatus = (selectedStatuses.length === 0) || (selectedStatuses.indexOf(status) !== -1);
                        return matchesSearch && matchesCategory && matchesPriority && matchesStatus;
                    });

                    if(searchText !== "") {
                        cards.sort(function(a, b) {
                            var subjectA = $.trim($(a).find('h3').text()).toLowerCase();
                            var descriptionA = $.trim($(a).find('p').text()).toLowerCase();
                            var idA = $.trim($(a).attr('data-id')).toLowerCase();
                            var dateA = $.trim($(a).attr('data-date')).toLowerCase();
                            var subjectB = $.trim($(b).find('h3').text()).toLowerCase();
                            var descriptionB = $.trim($(b).find('p').text()).toLowerCase();
                            var idB = $.trim($(b).attr('data-id')).toLowerCase();
                            var dateB = $.trim($(b).attr('data-date')).toLowerCase();
                            var scoreA = ((subjectA.match(new RegExp(searchText, "g")) || []).length +
                                (descriptionA.match(new RegExp(searchText, "g")) || []).length);
                            var scoreB = ((subjectB.match(new RegExp(searchText, "g")) || []).length +
                                (descriptionB.match(new RegExp(searchText, "g")) || []).length);
                            if(scoreB !== scoreA) return scoreB - scoreA;
                            var dA = new Date($.trim($(a).attr('data-date')));
                            var dB = new Date($.trim($(b).attr('data-date')));
                            if(dateSort === 'newest'){
                                if(dB - dA !== 0) return dB - dA;
                            } else {
                                if(dA - dB !== 0) return dA - dB;
                            }
                            var numA = parseInt($.trim($(a).attr('data-id')));
                            var numB = parseInt($.trim($(b).attr('data-id')));
                            return (idSort === 'lowest') ? numA - numB : numB - numA;
                        });
                    } else {
                        cards.sort(function(a, b) {
                            var dA = new Date($.trim($(a).attr('data-date')));
                            var dB = new Date($.trim($(b).attr('data-date')));
                            if(dateSort === 'newest'){
                                if(dB - dA !== 0) return dB - dA;
                            } else {
                                if(dA - dB !== 0) return dA - dB;
                            }
                            var numA = parseInt($.trim($(a).attr('data-id')));
                            var numB = parseInt($.trim($(b).attr('data-id')));
                            return (idSort === 'lowest') ? numA - numB : numB - numA;
                        });
                    }
                    filteredMobileCards = cards; // store filtered cards globally
                    $('#mobileTicketContainer').empty().append(cards);
                    mobileCurrentPage = 1;
                    paginateMobile(filteredMobileCards);
                }

                // Pagination functions
                function paginateDesktop(rows) {
                    var totalRows = rows.length;
                    var totalPages = Math.ceil(totalRows / desktopRowsPerPage);
                    if(totalPages < 1) totalPages = 1;
                    $(rows).hide();
                    var start = (desktopCurrentPage - 1) * desktopRowsPerPage;
                    var end = start + desktopRowsPerPage;
                    $(rows.slice(start, end)).show();
                    var paginationHtml = generatePaginationButtons(desktopCurrentPage, totalPages);
                    $('#desktopPagination').html(paginationHtml);
                }

                function paginateMobile(cards) {
                    var totalCards = cards.length;
                    var totalPages = Math.ceil(totalCards / mobileCardsPerPage);
                    if(totalPages < 1) totalPages = 1;
                    $(cards).hide();
                    var start = (mobileCurrentPage - 1) * mobileCardsPerPage;
                    var end = start + mobileCardsPerPage;
                    $(cards.slice(start, end)).show();
                    var paginationHtml = generatePaginationButtons(mobileCurrentPage, totalPages);
                    $('#mobilePagination').html(paginationHtml);
                }

                // Generate pagination buttons with a sliding window
                function generatePaginationButtons(currentPage, totalPages) {
                    var maxButtons = 5;
                    var half = Math.floor(maxButtons / 2);
                    var start = currentPage - half;
                    var end = currentPage + half;
                    if(start < 1) {
                        end += (1 - start);
                        start = 1;
                    }
                    if(end > totalPages) {
                        start -= (end - totalPages);
                        end = totalPages;
                        if(start < 1) start = 1;
                    }
                    var buttons = "";
                    buttons += '<button class="page-btn px-3 py-1 mx-1 rounded-lg border" data-page="'+(currentPage - 1)+'" ' + (currentPage === 1 ? 'disabled' : '') + '>Previous</button>';
                    for(var i = start; i <= end; i++){
                        var active = (i === currentPage) ? 'bg-blue-500 text-white' : 'bg-white text-blue-500';
                        buttons += '<button class="page-btn px-3 py-1 mx-1 rounded-lg border '+active+'" data-page="'+i+'">'+i+'</button>';
                    }
                    buttons += '<button class="page-btn px-3 py-1 mx-1 rounded-lg border" data-page="'+(currentPage + 1)+'" ' + (currentPage === totalPages ? 'disabled' : '') + '>Next</button>';
                    return buttons;
                }

                // Pagination button click handler
                $(document).on('click', '.page-btn', function(){
                    var page = parseInt($(this).data('page'));
                    if ($(this).closest('#desktopPagination').length) {
                        desktopCurrentPage = page;
                        paginateDesktop(filteredDesktopRows);
                    } else if ($(this).closest('#mobilePagination').length) {
                        mobileCurrentPage = page;
                        paginateMobile(filteredMobileCards);
                    }
                });

                // Attach events and initial calls
                $('#desktopSearch').on('input', desktopFilter);
                $('.desktop-category-filter, .desktop-priority-filter, .desktop-status-filter, #desktopDateSort').on('change', desktopFilter);
                $('#mobileSearch').on('input', mobileFilter);
                $('.mobile-category-filter, .mobile-priority-filter, .mobile-status-filter, #mobileDateSort').on('change', mobileFilter);
                desktopFilter();
                mobileFilter();
            });
        </script>
    </div>