<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8 overflow-hidden scrollbar-hide">
    <div class="max-w-xl mx-auto px-4">
        <!-- Centered Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Ticket</h1>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- System Feedback -->
            <?php $this->renderFeedbackMessages(); ?>

            <form action="<?= config::get("URL"); ?>ticket/createTicket" method="post">
                <!-- Subject field -->
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 font-medium mb-2">Subject:</label>
                    <input type="text" id="subject" name="subject" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Description field -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Ticket Description:</label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Priority field -->
                <div class="mb-4">
                    <label for="priority" class="block text-gray-700 font-medium mb-2">Priority:</label>
                    <select id="priority" name="priority" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="low">Low</option>
                        <option value="mid">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <!-- Category field -->
                <div class="mb-4">
                    <label for="category" class="block text-gray-700 font-medium mb-2">Category:</label>
                    <select id="category" name="category" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Bug">Bug</option>
                        <option value="Feature Request">Feature Request</option>
                        <option value="Improvement">Improvement</option>
                        <option value="Task">Task</option>
                        <option value="Documentation">Documentation</option>
                        <option value="Support">Support</option>
                    </select>
                </div>

                <!-- Submit button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                        Create Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
