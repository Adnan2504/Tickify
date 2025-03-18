
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row gap-6">
        <?php if (Session::get("user_account_type") >= 5) : ?>
            <div class="md:w-1/3 bg-white shadow-md rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Manage Ticket</h2>
                <form action="<?= config::get("URL"); ?>ticketHandler/updateTicket" method="post" class="space-y-4">
                    <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject:</label>
                        <input type="text" name="subject" value="<?= htmlentities($this->ticket->subject); ?>" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                        <textarea name="description" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><?= htmlentities($this->ticket->description); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Priority:</label>
                        <select name="priority" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="low" <?= $this->ticket->priority == 'low' ? 'selected' : ''; ?>>Low</option>
                            <option value="mid" <?= $this->ticket->priority == 'medium' ? 'selected' : ''; ?>>Medium</option>
                            <option value="high" <?= $this->ticket->priority == 'high' ? 'selected' : ''; ?>>High</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category:</label>
                        <input type="text" name="category" value="<?= htmlentities($this->ticket->category); ?>" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status:</label>
                        <select name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="open" <?= $this->ticket->status == 'open' ? 'selected' : ''; ?>>Open</option>
                            <option value="waiting" <?= $this->ticket->status == 'waiting' ? 'selected' : ''; ?>>Waiting</option>
                            <option value="resolved" <?= $this->ticket->status == 'resolved' ? 'selected' : ''; ?>>Resolved</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        Update Ticket
                    </button>
                </form>

                <form action="<?= config::get("URL"); ?>ticketHandler/closeTicket" method="post" class="mt-4">
                    <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        Close Ticket
                    </button>
                </form>
            </div>
        <?php endif; ?>

        <div class="md:flex-1">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Ticket: <?= htmlentities($this->ticket->subject); ?>
                        <span class="text-gray-500 font-normal">(#<?= htmlentities($this->ticket->id); ?>)</span>
                    </h1>
                </div>

                <div class="p-6">
                    <?php $this->renderFeedbackMessages(); ?>

                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-800">Ticket Conversation</h2>
                        </div>

                        <div id="chat-display" class="h-80 overflow-y-auto p-4 bg-gray-50 space-y-4">
                            <?php if (!empty($this->messages)): ?>
                                <?php foreach ($this->messages as $message): ?>
                                    <div class="bg-white rounded-lg shadow-sm p-4">
                                        <div class="flex items-center mb-2">
                                            <span class="font-medium text-gray-800"><?= htmlentities($message->sender); ?></span>
                                            <span class="text-xs text-gray-500 ml-2">
                                                <?= isset($message->created_at) ? htmlentities($message->created_at) : ''; ?>
                                            </span>
                                        </div>
                                        <p class="text-gray-700 mb-2"><?= htmlentities($message->content); ?></p>
                                        <?php if (!empty($message->attachment)): ?>
                                            <div class="mt-2 border rounded-lg p-2 bg-gray-50">
                                                <img src="<?= config::get("URL") . htmlentities($message->attachment); ?>"
                                                     alt="Attachment" class="max-w-full rounded">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-8 text-gray-500">
                                    <p>No messages yet. Start the conversation!</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-4 bg-white border-t border-gray-200">
                            <form id="message-form" action="<?= config::get("URL"); ?>ticketHandler/respondToTicket" method="post" enctype="multipart/form-data" class="space-y-4">
                                <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Your Message:</label>
                                    <textarea name="message" rows="3" required id="message"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Attachment (optional):</label>
                                    <input type="file" name="attachment" accept="image/*"
                                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                                <button type="submit" class="inline-flex justify-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // enable enter key to send messaghe
        const textarea = document.getElementById('message');
        const form = document.getElementById('message-form');

        textarea.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                form.submit();
            }
        });

    });
</script>

