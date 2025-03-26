<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Overview</h1>
            <p class="text-gray-600">Welcome to your ticket management dashboard</p>
        </div>
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Open Tickets -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900">Open Tickets</h3>
                        <p class="mt-2 text-3xl font-semibold text-blue-600"><?= isset($this->ticketStats['open_tickets']) ? htmlspecialchars($this->ticketStats['open_tickets']) : '0' ?></p>
                    </div>
                </div>
            </div>

            <!-- In Progress Tickets -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900">In Progress</h3>
                        <p class="mt-2 text-3xl font-semibold text-yellow-600"><?= isset($this->ticketStats['in_progress_tickets']) ? htmlspecialchars($this->ticketStats['in_progress_tickets']) : '0' ?></p>
                    </div>
                </div>
            </div>

            <!-- Solved Tickets -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900">Solved Tickets</h3>
                        <p class="mt-2 text-3xl font-semibold text-green-600"><?= isset($this->ticketStats['solved_tickets']) ? htmlspecialchars($this->ticketStats['solved_tickets']) : '0' ?></p>
                    </div>
                </div>
            </div>

            <!-- Messages Sent -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900">Messages Sent</h3>
                        <p class="mt-2 text-3xl font-semibold text-purple-600"><?= isset($this->messageStats['total_messages']) ? htmlspecialchars($this->messageStats['total_messages']) : '0' ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Recent Activity</h3>
                <div class="text-gray-600">
                    Information will be displayed here
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">System Status</h3>
                <div class="text-gray-600">
                    Information will be displayed here
                </div>
            </div>
        </div>
    </div>
</div>