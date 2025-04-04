<div class="login-container">
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-content">
        <div class="login-box">
            <h1>Reset Password</h1>
            <p class="login-subtitle">Enter your email to reset your password</p>

            <form method="post" action="<?php echo Config::get('URL'); ?>login/requestPasswordReset_action">
                <div class="form-group">
                    <label for="user_name_or_email">Email Address</label>
                    <input type="text" id="user_name_or_email" name="user_name_or_email" 
                           placeholder="Enter your email address" required />
                </div>

                <div class="form-group">
                    <label>Verification</label>
                    <div class="captcha-container">
                        <img id="captcha" src="<?php echo Config::get('URL'); ?>register/showCaptcha" />
                        <a href="#" class="refresh-captcha" 
                           onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>register/showCaptcha?' + Math.random(); return false">
                            Refresh Captcha
                        </a>
                    </div>
                    <input type="text" name="captcha" placeholder="Enter captcha code" required />
                </div>

                <button type="submit" class="submit-button">Reset Password</button>
            </form>

            <div class="back-to-login">
                <a href="<?php echo Config::get('URL'); ?>login">Back to Login</a>
            </div>
        </div>
    </div>
</div>