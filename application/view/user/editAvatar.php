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
                    <div class="relative w-40 h-40 mx-auto mb-4">
                        <div id="uploadIcon" class="absolute inset-0 flex items-center justify-center bg-gray-100 rounded-lg border-2 border-dashed border-gray-300">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900">Click to upload</span>
                        </div>
                        <!-- Image Preview -->
                        <div id="imagePreview" class="absolute inset-0 hidden">
                            <img id="preview" src="#" alt="Preview" class="w-full h-full object-cover rounded-lg"/>
                            <button type="button" onclick="removePreview()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 z-50 cursor-pointer">
                                <svg class="w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <input type="file" name="avatar_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required onchange="previewImage(this)"/>
                    </div>
                </div>
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    Upload Avatar
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('uploadIcon').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removePreview() {
        document.getElementById('preview').src = '#';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('uploadIcon').classList.remove('hidden');
        document.querySelector('input[type="file"]').value = '';
    }
</script>