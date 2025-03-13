<div class="min-h-screen flex items-center justify-center p-4 bg-gray-100">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8 transition-all duration-200 hover:shadow-2xl">
        <!-- System feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <!-- Registration Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold mb-2 text-center">Register</h1>
            <p class="text-center text-gray-600 mb-4">Create an account</p>
            <form action="<?php echo Config::get('URL'); ?>register/index" method="post" class="space-y-4">
                <div class="form-group">
                    <label for="user_name" class="block text-gray-700 text-center">Username</label>
                    <input type="text" id="user_name" name="user_name" placeholder="Enter username" required
                           class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                </div>
                <div class="form-group">
                    <label for="user_email" class="block text-gray-700 text-center">Email</label>
                    <input type="email" id="user_email" name="user_email" placeholder="Enter email" required
                           class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                </div>
                <div class="form-group">
                    <label for="user_password" class="block text-gray-700 text-center">Password</label>
                    <input type="password" id="user_password" name="user_password" placeholder="Enter password" required
                           class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                </div>
                <div class="form-group">
                    <label for="user_password_repeat" class="block text-gray-700 text-center">Repeat Password</label>
                    <input type="password" id="user_password_repeat" name="user_password_repeat" placeholder="Repeat password" required
                           class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                </div>
                <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition-all duration-200 hover:scale-105">
                    Register
                </button>
            </form>
        </div>
    </div>
</div>