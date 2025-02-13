<div class="container">
    <h1>Dashboard</h1>
    <div class="box">

        <!-- System Feedback Messages -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="dashboard-stats">
            <div class="stat-box">
                <h2>Open Tickets</h2>
                <p><?= htmlspecialchars($this->ticketStats['open_tickets']) ?></p>
            </div>
            <div class="stat-box">
                <h2>Tickets in Progress</h2>
                <p><?= htmlspecialchars($this->ticketStats['in_progress_tickets']) ?></p>
            </div>
            <div class="stat-box">
                <h2>Solved Tickets</h2>
                <p><?= htmlspecialchars($this->ticketStats['solved_tickets']) ?></p>
            </div>
            <div class="stat-box">
                <h2>Messages Sent</h2>
                <p><?= htmlspecialchars($this->messageStats['total_messages']) ?></p>
            </div>
        </div>
    </div>
</div>
