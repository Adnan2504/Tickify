<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Edit Ticket</h1>
        </div>

        <div class="p-6">
            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>

            <?php if ($this->ticket) { ?>
                <form method="post" action="<?php echo Config::get('URL'); ?>ticket/editSave" class="space-y-4">
                    <!-- ticket ID -->
                    <input type="hidden" name="ticket_id" value="<?php echo htmlentities($this->ticket->id); ?>" />

                    <!-- subject field -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject:</label>
                        <input type="text" id="subject" name="subject" value="<?php echo htmlentities($this->ticket->subject); ?>" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- description field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                        <textarea id="description" name="description" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><?php echo htmlentities($this->ticket->description); ?></textarea>
                    </div>

                    <!-- priority field -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority:</label>
                        <select id="priority" name="priority" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="low" <?php echo $this->ticket->priority === 'low' ? 'selected' : ''; ?>>Low</option>
                            <option value="mid" <?php echo $this->ticket->priority === 'mid' ? 'selected' : ''; ?>>Medium</option>
                            <option value="high" <?php echo $this->ticket->priority === 'high' ? 'selected' : ''; ?>>High</option>
                        </select>
                    </div>

                    <!-- category field -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium mb-2">Category:</label>
                        <select id="category" name="category" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Bug" <?php echo $this->ticket->category === 'Bug' ? 'selected' : ''; ?>>Bug</option>
                            <option value="Feature Request" <?php echo $this->ticket->category === 'Feature Request' ? 'selected' : ''; ?>>Feature Request</option>
                            <option value="Improvement" <?php echo $this->ticket->category === 'Improvement' ? 'selected' : ''; ?>>Improvement</option>
                            <option value="Task" <?php echo $this->ticket->category === 'Task' ? 'selected' : ''; ?>>Task</option>
                            <option value="Documentation" <?php echo $this->ticket->category === 'Documentation' ? 'selected' : ''; ?>>Documentation</option>
                            <option value="Support" <?php echo $this->ticket->category === 'Support' ? 'selected' : ''; ?>>Support</option>
                        </select>
                    </div>


                    <!-- submit button -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            <?php } else { ?>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">This ticket does not exist.</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
