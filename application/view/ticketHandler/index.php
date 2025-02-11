<div class="container">
    <h1>Ticket: <?= htmlentities($this->ticket->subject); ?> (#<?= htmlentities($this->ticket->id); ?>)</h1>
    <div class="box">

        <!-- Display feedback messages -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="messenger-container" style="border: 1px solid #ccc; border-radius: 8px; padding: 20px; max-width: 600px; margin: 0 auto;">
            <h2>Ticket Messenger</h2>

            <div id="chat-display" style="height: 300px; overflow-y: auto; border: 1px solid #ddd; border-radius: 8px; padding: 10px; background: #f9f9f9; margin-bottom: 20px;">
                <?php if (!empty($this->messages)): ?>
                    <?php foreach ($this->messages as $message): ?>
                        <div class="chat-message" style="margin-bottom: 10px;">
                            <strong><?= htmlentities($message->sender); ?>:</strong>
                            <p style="margin: 5px 0;"><?= htmlentities($message->content); ?></p>
                            <?php if (!empty($message->attachment)): ?>
                                <img src="<?= config::get("URL") . htmlentities($message->attachment); ?>" alt="Attachment" style="max-width: 100%; max-height: 100%;">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No messages yet. Start the conversation!</p>
                <?php endif; ?>
            </div>


            <form id="message-form" action="<?= config::get("URL"); ?>ticketHandler/respondToTicket" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px;">
                <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">

                <label>
                    Your Message:
                    <textarea name="message" rows="4" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
                </label>

                <label>
                    Attachment (optional):
                    <input type="file" name="attachment" accept="image/*" style="padding: 5px;">
                </label>

                <button type="submit" style="padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
