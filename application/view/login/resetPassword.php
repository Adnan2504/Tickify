<div class="login-container">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-content">
        <div class="login-box">
            <h1>Reset Password</h1>
            <p class="login-subtitle">Enter your new password</p>

            <form method="post" action="<?php echo Config::get('URL'); ?>login/setNewPassword" name="new_password_form">
                <input type='hidden' name='user_name' value='<?php echo $this->user_name; ?>' />
                <input type='hidden' name='user_password_reset_hash' value='<?php echo $this->user_password_reset_hash; ?>' />

                <div class="form-group">
                    <label for="reset_input_password_new">New Password</label>
                    <input id="reset_input_password_new" class="reset_input" type="password"
                           name="user_password_new" pattern=".{6,}" 
                           placeholder="Enter new password (min. 6 characters)"
                           required autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="reset_input_password_repeat">Confirm Password</label>
                    <input id="reset_input_password_repeat" class="reset_input" type="password"
                           name="user_password_repeat" pattern=".{6,}" 
                           placeholder="Confirm new password"
                           required autocomplete="off" />
                </div>

                <button type="submit" name="submit_new_password" class="submit-button">
                    Reset Password
                </button>
            </form>

            <div class="back-to-login">
                <a href="<?php echo Config::get('URL'); ?>login/index">Back to Login</a>
            </div>
        </div>
    </div>
</div>