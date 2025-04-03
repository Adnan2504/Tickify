<div class="fixed inset-0 pt-20 pb-6 bg-gradient-to-br from-blue-50 to-indigo-50 overflow-y-auto">
    <div class="h-full max-w-7xl mx-auto px-4 flex flex-col">
        <div class="flex flex-col md:flex-row gap-6 h-full">
            <?php if (Session::get("user_account_type") >= 5) : ?>
                <div class="md:w-1/4 bg-white shadow-md rounded-lg p-6 border border-gray-200 flex flex-col h-full">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Ticket</h2>

                    <!-- ✅ Full update form starts here -->
                    <form action="<?= config::get("URL"); ?>ticketHandler/updateTicket" method="post" class="flex flex-col flex-grow justify-between mt-8">
                        <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">

                        <!-- ✅ All form fields included -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subject:</label>
                                <input type="text" name="subject" value="<?= htmlentities($this->ticket->subject); ?>" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                                <textarea name="description" rows="6" required
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
                                <label for="category" class="block text-gray-700 font-medium mb-2">Category:</label>
                                <select id="category" name="category" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="Bug" <?= $this->ticket->category === 'Bug' ? 'selected' : ''; ?>>Bug</option>
                                    <option value="Feature Request" <?= $this->ticket->category === 'Feature Request' ? 'selected' : ''; ?>>Feature Request</option>
                                    <option value="Improvement" <?= $this->ticket->category === 'Improvement' ? 'selected' : ''; ?>>Improvement</option>
                                    <option value="Task" <?= $this->ticket->category === 'Task' ? 'selected' : ''; ?>>Task</option>
                                    <option value="Documentation" <?= $this->ticket->category === 'Documentation' ? 'selected' : ''; ?>>Documentation</option>
                                    <option value="Support" <?= $this->ticket->category === 'Support' ? 'selected' : ''; ?>>Support</option>
                                </select>
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
                        </div>

                        <!-- ✅ Submit button for updating -->
                        <div class="relative z-10 space-y-4 mt-6">
                            <button type="submit"
                                    class="w-full px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                Update Ticket
                            </button>
                        </div>
                    </form>

                    <!-- ✅ Separate close ticket form -->
                    <form action="<?= config::get("URL"); ?>ticketHandler/closeTicket" method="post" class="mt-4">
                        <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            Close Ticket
                        </button>
                    </form>
                </div>
            <?php endif; ?>


            <!-- Chat-Bereich (rechte Seite) -->
            <div class="md:flex-1 h-full">
                <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200 h-full flex flex-col">
                    <div class="border-b border-gray-200 pb-4">
                        <h1 class="text-2xl font-bold text-gray-800">
                            Ticket: <?= htmlentities($this->ticket->subject); ?>
                            <span class="text-gray-500 font-normal">(#<?= htmlentities($this->ticket->id); ?>)</span>
                        </h1>
                    </div>
                    <div id="chat-display" class="flex-1 overflow-y-auto bg-gray-50 p-4 mt-4 rounded-lg">
                        <h2 class="text-lg font-medium text-gray-800 mb-4">Ticket Conversation</h2>
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($this->messages)): ?>
                            <?php foreach ($this->messages as $message): ?>
                                <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                                    <div class="flex items-center mb-2">
                                        <span class="sender-name font-medium"><?= htmlentities($message->sender); ?></span>
                                        <span class="text-xs text-gray-500 ml-2">
                      <?= isset($message->created_at) ? htmlentities($message->created_at) : ''; ?>
                    </span>
                                    </div>
                                    <p class="text-gray-700 mb-2 whitespace-pre-line"><?= htmlentities($message->content); ?></p>
                                    <?php if (!empty($message->attachment)): ?>
                                        <div class="mt-2 border rounded-lg p-2 bg-gray-50 w-fit">
                                            <img src="<?= config::get("URL") . htmlentities($message->attachment); ?>" alt="Attachment"
                                                 class="max-w-[300px] max-h-48 w-auto h-auto object-contain rounded cursor-pointer hover:opacity-90 transition-opacity"
                                                 onclick="openImageModal('<?= config::get("URL") . htmlentities($message->attachment); ?>')">
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
                    <div class="mt-4">
                        <form id="message-form" action="<?= config::get("URL"); ?>ticketHandler/respondToTicket" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">
                            <div id="file-preview" class="hidden mb-4">
                                <img id="image-preview" src="" alt="File preview" class="max-h-32 rounded-lg">
                                <button type="button" onclick="removeFilePreview()" class="mt-2 text-red-600 text-sm">Remove</button>
                            </div>
                            <div class="flex items-end gap-2">
                                <div class="flex-1">
                  <textarea name="message" required id="message" rows="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                            style="min-height: 40px;"></textarea>
                                </div>
                                <label class="w-10 h-10 bg-gray-500 text-white rounded-full flex items-center justify-center hover:bg-gray-600 transition-colors cursor-pointer">
                                    <input type="file" name="attachment" accept="image/*" class="hidden" onchange="previewFile(event)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                    </svg>
                                </label>
                                <button type="submit" id="send-button"
                                        class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional Custom CSS to hide scrollbars -->
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    // Nachricht per Enter (ohne Shift) senden
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('message');
        const form = document.getElementById('message-form');
        textarea.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                form.submit();
            }
        });
    });
</script>

<!-- Auto-Resize des Chat-Eingabefeldes (max. 3 Zeilen) -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const textarea = document.getElementById("message");
        textarea.style.overflowY = "hidden";
        const computedLineHeight = parseFloat(window.getComputedStyle(textarea).lineHeight) || 20;
        const maxHeight = computedLineHeight * 3;
        textarea.addEventListener("input", function () {
            this.style.height = "auto";
            const newHeight = Math.min(this.scrollHeight, maxHeight);
            this.style.height = newHeight + "px";
        });
    });
</script>

<!-- Einmalige, dunkle Farbe pro Sender -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const senderElements = document.querySelectorAll(".sender-name");
        senderElements.forEach(el => {
            const sender = el.textContent.trim();
            el.style.color = getDarkColor(sender);
        });
        function getDarkColor(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            const colors = ["#00008B", "#000080", "#4B0082", "#8B4513", "#800000", "#483D8B"];
            return colors[Math.abs(hash) % colors.length];
        }
    });
</script>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" onclick="closeImageModal()">
    <div class="max-w-4xl mx-auto p-4">
        <img id="modalImage" src="" alt="Full size image" class="max-h-[90vh] max-w-full rounded-lg">
    </div>
</div>
<script>
    function openImageModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeImageModal();
        }
    });
</script>

<script>
    function previewFile(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('file-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
    function removeFilePreview() {
        document.getElementById('image-preview').src = '';
        document.getElementById('file-preview').classList.add('hidden');
    }
</script>

<!-- Automatisches Scrollen des Chat-Fensters beim Laden der Seite -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chatDisplay = document.getElementById("chat-display");
        if (chatDisplay) {
            chatDisplay.scrollTop = chatDisplay.scrollHeight;
        }
    });
</script>
