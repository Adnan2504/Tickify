<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit your avatar</h1>

        <?php $this->renderFeedbackMessages(); ?>

        <!-- Upload Avatar Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Upload an Avatar</h2>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r">
                <p class="text-blue-700">If you see the old picture after uploading: Try refreshing the page with F5. Your browser may cache the old image.</p>
            </div>

            <form action="<?php echo Config::get('URL'); ?>user/uploadAvatar_action" method="post" enctype="multipart/form-data" class="space-y-4">
                <div class="space-y-2">
                    <label for="avatar_file" class="block text-sm font-medium text-gray-700">
                        Select an avatar image (will be scaled to 44x44 px, .jpg only):
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Select a photo
                                </p>
                            </div>
                            <input type="file" name="avatar_file" class="opacity-0" required />
                        </label>
                    </div>
                </div>
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    Upload Avatar
                </button>
            </form>
        </div>

        <!-- Delete Avatar Section -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Delete your avatar</h2>
            <div class="flex items-center justify-between">
                <p class="text-gray-600">Remove your current avatar image</p>
                <a href="<?php echo Config::get('URL'); ?>user/deleteAvatar_action"
                   class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                    Delete Avatar
                </a>
            </div>
        </div>
    </div>
</div>