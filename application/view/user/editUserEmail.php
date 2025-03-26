<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl">
        <div class="px-8 py-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Update Email Address</h1>
            <?php $this->renderFeedbackMessages(); ?>

            <form action="<?php echo Config::get('URL'); ?>user/editUserEmail_action" method="post" class="space-y-6">
                <div>
                    <label for="user_email" class="block text-sm font-medium text-gray-700">New Email Address</label>
                    <input type="email" name="user_email" id="user_email" required
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                           placeholder="Enter your new email address" />
                </div>

                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    Update Email
                </button>
            </form>
        </div>
    </div>
</div>