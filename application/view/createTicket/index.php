<div class="container">
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>


        <form action="<?= config::get("URL"); ?>ticket/createTicket" method="post" style="display: flex; flex-direction: column; gap: 10px; width: 400px; margin: 0 auto;">
            <label>
                Subject:
                <input type="text" name="subject" style="flex: 1;">
            </label>

            <label>
                Ticket Description:
                <textarea name="description" style="flex: 1;"></textarea>
            </label>

            <label>
                Priority:
                <select name="priority" style="flex: 1;">
                    <option value="low">Low</option>
                    <option value="mid">Mid</option>
                    <option value="high">High</option>
                </select>
            </label>

            <label>
                Category:
                <input type="text" name="category" style="flex: 1;">
            </label>

            <button type="submit" style="padding: 10px;">Submit</button>
        </form>


    </div>
</div>
