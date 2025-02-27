
<div class="container mx-auto mt-10">
    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Ticket</h2>

        <!-- Echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->ticket) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>ticket/editSave">
                <!-- Ticket ID -->
                <input type="hidden" name="ticket_id" value="<?php echo htmlentities($this->ticket->id); ?>" />

                <!-- Subject field -->
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 font-medium mb-2">Change Subject:</label>
                    <input type="text" id="subject" name="subject" value="<?php echo htmlentities($this->ticket->subject); ?>" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Description field -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Change Description:</label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlentities($this->ticket->description); ?></textarea>
                </div>

                <!-- Status Dropdown -->
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-medium mb-2">Change Status:</label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php
                        $statuses = ['new', 'open', 'on_hold', 'solved', 'closed'];
                        foreach ($statuses as $status) {
                            $selected = ($this->ticket->status == $status) ? 'selected' : '';
                            echo "<option value=\"$status\" $selected>" . ucfirst(str_replace('_', ' ', $status)) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Priority field -->
                <div class="mb-4">
                    <label for="priority" class="block text-gray-700 font-medium mb-2">Change Priority:</label>
                    <select id="priority" name="priority" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="low" <?php echo $this->ticket->priority === 'low' ? 'selected' : ''; ?>>Low</option>
                        <option value="medium" <?php echo $this->ticket->priority === 'medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="high" <?php echo $this->ticket->priority === 'high' ? 'selected' : ''; ?>>High</option>
                    </select>
                </div>

                <!-- Category field -->
                <div class="mb-6">
                    <label for="category" class="block text-gray-700 font-medium mb-2">Change Category:</label>
                    <select id="category" name="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php
                        $categories = ['billing' => 'Billing & Returns', 'technical' => 'Technical Support', 'general' => 'General Inquiry'];
                        foreach ($categories as $value => $label) {
                            $selected = ($this->ticket->category == $value) ? 'selected' : '';
                            echo "<option value=\"$value\" $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Submit button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        <?php } else { ?>
            <p class="text-red-500">This ticket does not exist.</p>
        <?php } ?>
    </div>
</div>
