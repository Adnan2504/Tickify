<div class="container" style="display: flex;">
    <?php if (Session::get("user_account_type") >= 5) : ?>
    <div class="moderation-panel" style="width: 30%; padding: 20px; border-right: 1px solid #ccc;">
        <h2>Manage Ticket</h2>
        <form action="<?= config::get("URL"); ?>ticketHandler/updateTicket" method="post">
            <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">

            <label>
                Subject:
                <input type="text" name="subject" value="<?= htmlentities($this->ticket->subject); ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </label>

            <label>
                Description:
                <textarea name="description" rows="4" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?= htmlentities($this->ticket->description); ?></textarea>
            </label>

            <label>
                Priority:
                <select name="priority" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="low" <?= $this->ticket->priority == 'low' ? 'selected' : ''; ?>>Low</option>
                    <option value="mid" <?= $this->ticket->priority == 'medium' ? 'selected' : ''; ?>>Medium</option>
                    <option value="high" <?= $this->ticket->priority == 'high' ? 'selected' : ''; ?>>High</option>
                </select>
            </label>

            <label>
                Category:
                <input type="text" name="category" value="<?= htmlentities($this->ticket->category); ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </label>

            <label>
                Status:
                <select name="status" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="open" <?= $this->ticket->status == 'open' ? 'selected' : ''; ?>>Open</option>
                    <option value="waiting" <?= $this->ticket->status == 'waiting' ? 'selected' : ''; ?>>waiting</option>
                    <option value="resolved" <?= $this->ticket->status == 'resolved' ? 'selected' : ''; ?>>resolved</option>
                </select>
            </label>

            <button type="submit" style="margin-top: 10px; padding: 10px 20px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Update Ticket
            </button>
        </form>
        <form action="<?= config::get("URL"); ?>ticketHandler/closeTicket" method="post">
            <input type="hidden" name="ticket_id" value="<?= htmlentities($this->ticket->id); ?>">
            <button type="submit" style="margin-top: 10px; padding: 10px 20px; background: #d60d44; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Close Ticket
            </button>
        </form>
    </div>
    <?php endif; ?>


    <div style="width: 70%; padding: 20px;">
        <h1>Ticket: <?= htmlentities($this->ticket->subject); ?> (#<?= htmlentities($this->ticket->id); ?>)</h1>
        <div class="box">
            <?php $this->renderFeedbackMessages(); ?>

            <div class="messenger-container" style="border: 1px solid #ccc; border-radius: 8px; padding: 20px; max-width: 600px; margin: 0 auto;">
                <h2>Ticket Messenger</h2>
                <div id="chat-display" style="height: 300px; overflow-y: auto; border: 1px solid #ddd; border-radius: 8px; padding: 10px; background: #f9f9f9; margin-bottom: 20px;">
                    <?php if (!empty($this->messages)): ?>
                        <?php foreach ($this->messages as $message): ?>
                            <div class="chat-message" style="margin-bottom: 10px;">
                                <strong><?= htmlentities($message->sender); ?>:</strong>
                                <p style="margin: 5px 0;"> <?= htmlentities($message->content); ?> </p>
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
</div>
