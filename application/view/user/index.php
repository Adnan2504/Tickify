<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">Account Settings</h1>
            </div>

            <div class="p-8 space-y-8">
                <?php $this->renderFeedbackMessages(); ?>

                <!-- Profile Section -->
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <?php if (Config::get('USE_GRAVATAR')) { ?>
                            <img src='<?= $this->user_gravatar_image_url; ?>' class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg" alt="Gravatar"/>
                        <?php } else { ?>
                            <img src='<?= $this->user_avatar_file; ?>' class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg" alt="Avatar"/>
                        <?php } ?>
                    </div>
                    <div class="space-y-2">
                        <div class="text-xl font-semibold text-gray-900">
                            <span>Username: </span>
                            <span class="text-blue-600"><?= $this->user_name; ?></span>
                        </div>
                        <div class="text-gray-600">
                            <span>Email: </span>
                            <span class="text-blue-600"><?= $this->user_email; ?></span>
                        </div>
                        <div class="text-gray-600">
                            <span>Account Type: </span>
                            <span class="text-blue-600"><?= $this->user_account_type; ?></span>
                        </div>
                        <?php if (Config::get('USE_GRAVATAR')) { ?>
                            <div class="text-sm text-gray-500">Using Gravatar for profile picture</div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Account Management Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="<?= Config::get('URL'); ?>user/editUsername"
                       class="flex items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 transition-colors group">
                        <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Change Username</h3>
                            <p class="text-sm text-gray-500">Update your display name</p>
                        </div>
                    </a>

                    <a href="<?= Config::get('URL'); ?>user/editUserEmail"
                       class="flex items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 transition-colors group">
                        <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Change Email</h3>
                            <p class="text-sm text-gray-500">Update your email address</p>
                        </div>
                    </a>

                    <a href="<?= Config::get('URL'); ?>user/changePassword"
                       class="flex items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 transition-colors group">
                        <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 15v2m0 0v2m0-2h2m-2 0H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Change Password</h3>
                            <p class="text-sm text-gray-500">Update your security credentials</p>
                        </div>
                    </a>

                    <a href="<?= Config::get('URL'); ?>user/editAvatar"
                       class="flex items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 transition-colors group">
                        <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Change Avatar</h3>
                            <p class="text-sm text-gray-500">Update your profile picture</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>