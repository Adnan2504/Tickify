<div class="container">
    <h1>TicketController/edit/:ticket_id</h1>

    <div class="box">
        <h2>Edit Ticket</h2>

        <!-- Echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->ticket) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>ticket/editSave" class="form-edit-ticket">
                <!-- Ticket ID -->
                <input type="hidden" name="ticket_id" value="<?php echo htmlentities($this->ticket->id); ?>" />

                <!-- Subject field -->
                <div class="form-group">
                    <label for="subject">Change Subject:</label>
                    <input type="text" id="subject" name="subject" value="<?php echo htmlentities($this->ticket->subject); ?>" required />
                </div>

                <!-- Description field -->
                <div class="form-group">
                    <label for="description">Change Description:</label>
                    <textarea id="description" name="description" rows="5" required><?php echo htmlentities($this->ticket->description); ?></textarea>
                </div>

                <!-- Priority field -->
                <div class="form-group">
                    <label for="priority">Change Priority:</label>
                    <select id="priority" name="priority" required>
                        <option value="low" <?php echo $this->ticket->priority === 'low' ? 'selected' : ''; ?>>Low</option>
                        <option value="mid" <?php echo $this->ticket->priority === 'mid' ? 'selected' : ''; ?>>Medium</option>
                        <option value="high" <?php echo $this->ticket->priority === 'high' ? 'selected' : ''; ?>>High</option>
                    </select>
                </div>

                <!-- Category field -->
                <div class="form-group">
                    <label for="category">Change Category (optional):</label>
                    <input type="text" id="category" name="category" value="<?php echo htmlentities($this->ticket->category); ?>" />
                </div>

                <!-- Submit button -->
                <div class="form-group">
                    <input type="submit" value="Save Changes" class="btn-submit" />
                </div>
            </form>
        <?php } else { ?>
            <p>This ticket does not exist.</p>
        <?php } ?>
    </div>
</div>
