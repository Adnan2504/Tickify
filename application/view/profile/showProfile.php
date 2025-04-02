<div class="min-h-screen bg-gradient-to-r from-blue-50 to-indigo-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- System feedback messages -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <?php if ($this->user) { ?>
                <div class="p-8">
                    <!-- Profile Header -->
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="flex-shrink-0">
                            <?php if (isset($this->user->user_avatar_link)) { ?>
                                <img src="<?= $this->user->user_avatar_link; ?>"
                                     class="h-24 w-24 rounded-xl object-cover ring-4 ring-blue-50"
                                     alt="<?= $this->user->user_name; ?>'s avatar" />
                            <?php } ?>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900"><?= $this->user->user_name; ?>'s Profile</h1>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-sm font-medium text-gray-500">Username</dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900"><?= $this->user->user_name; ?></dd>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900"><?= $this->user->user_email; ?></dd>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <dt class="text-sm font-medium text-gray-500">Account Type</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <?= $this->user_account_type_long; ?>
                                </span>
                            </dd>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
