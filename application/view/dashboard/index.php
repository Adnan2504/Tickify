<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
    <div class="bg-white rounded-lg shadow-md p-6">

        <!-- System Feedback Messages -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-blue-50 rounded-lg p-6 shadow-sm border border-blue-100 transition-all hover:shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Open Tickets</h2>
                <p class="text-3xl font-bold text-blue-600">
                    <?= isset($this->ticketStats['open_tickets']) ? htmlspecialchars($this->ticketStats['open_tickets']) : '0' ?>
                </p>
            </div>
            <div class="bg-yellow-50 rounded-lg p-6 shadow-sm border border-yellow-100 transition-all hover:shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">In Progress</h2>
                <p class="text-3xl font-bold text-yellow-600">
                    <?= isset($this->ticketStats['in_progress_tickets']) ? htmlspecialchars($this->ticketStats['in_progress_tickets']) : '0' ?>
                </p>
            </div>
            <div class="bg-green-50 rounded-lg p-6 shadow-sm border border-green-100 transition-all hover:shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Solved Tickets</h2>
                <p class="text-3xl font-bold text-green-600">
                    <?= isset($this->ticketStats['solved_tickets']) ? htmlspecialchars($this->ticketStats['solved_tickets']) : '0' ?>
                </p>
            </div>
            <div class="bg-purple-50 rounded-lg p-6 shadow-sm border border-purple-100 transition-all hover:shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Messages Sent</h2>
                <p class="text-3xl font-bold text-purple-600">
                    <?= isset($this->messageStats['total_messages']) ? htmlspecialchars($this->messageStats['total_messages']) : '0' ?>
                </p>
            </div>
        </div>

        <!-- You could add additional dashboard sections here -->
        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Recent Activity</h2>
            <p class="text-gray-600">
                This is where you could display recent ticket activity or other important information.
            </p>
        </div>
    </div>
</div>
