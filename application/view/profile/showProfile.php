<div class="container">
    <h1>Profile</h1>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div><?= $this->user->user_name . "'s Profile" ?></div>

        <?php if ($this->user) { ?>
            <div>
                <div>Username: <?= $this->user->user_name; ?></div>
                <div>Email: <?= $this->user->user_email; ?></div>
                <div>Avatar:
                    <?php if (isset($this->user->user_avatar_link)) { ?>
                        <img src="<?= $this->user->user_avatar_link; ?>" />
                    <?php } ?>
                </div>
                <div>Your account type is: <?= $this->user_account_type_long; ?></div>
            </div>
        <?php } ?>

</div>
