
<div class="container mx-auto mt-10">
    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Ticket</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <form action="<?= config::get("URL"); ?>ticket/createTicket" method="post">
            <!-- subject field -->
            <div class="mb-4">
                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject:</label>
                <input type="text" id="subject" name="subject" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- description field -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Ticket Description:</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- priority field -->
            <div class="mb-4">
                <label for="priority" class="block text-gray-700 font-medium mb-2">Priority:</label>
                <select id="priority" name="priority" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="low">Low</option>
                    <option value="mid">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <!-- category field -->
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


            <!-- submit button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    Create Ticket
                </button>
            </div>
        </form>
    </div>
</div>
