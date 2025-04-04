<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl">
        <div class="px-8 py-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Change Password</h1>
            <?php $this->renderFeedbackMessages(); ?>

            <form method="post" action="<?php echo Config::get('URL'); ?>user/changePassword_action" name="new_password_form" class="space-y-6">
                <div>
                    <label for="change_input_password_current" class="block text-sm font-medium text-gray-700">Current Password</label>
                    <input id="change_input_password_current" type="password" name="user_password_current" pattern=".{6,}" required
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150" />
                </div>

                <div>
                    <label for="change_input_password_new" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input id="change_input_password_new" type="password" name="user_password_new" pattern=".{6,}" required
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150" />
                    <p class="mt-1 text-xs text-gray-500">Minimum 6 characters</p>
                </div>

                <div>
                    <label for="change_input_password_repeat" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input id="change_input_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150" />
                </div>

                <button type="submit" name="submit_new_password"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>