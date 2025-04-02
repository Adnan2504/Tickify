<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8 overflow-hidden scrollbar-hide">
    <!-- Centered Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">All Users</h1>
        <p class="text-gray-600">Admin Panel</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- System Feedback -->
        <div class="px-4 mb-4">
            <?php $this->renderFeedbackMessages(); ?>
            <?php $availableAccType = UserModel::getAvailableAccountTypes(); ?>
        </div>

        <!-- Search Bar (common for both layouts) -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-4">
            <div class="p-4">
                <input type="text" id="customSearch" placeholder="Search users..." class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>

        <!-- Mobile View: Cards (visible below md) -->
        <div class="block md:hidden space-y-4">
            <?php foreach($this->users as $user) { ?>
                <div class="bg-white rounded-xl shadow-lg p-4">
                    <!-- Id -->
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Id</label>
                        <span class="text-gray-700"><?= $user->user_id; ?></span>
                    </div>
                    <!-- Avatar -->
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Avatar</label>
                        <?php if(isset($user->user_avatar_link)) { ?>
                            <img src="<?= $user->user_avatar_link; ?>" alt="Avatar" class="h-10 w-10 rounded-full shadow-md object-cover">
                        <?php } else { ?>
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500"><?= substr(htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'), 0, 1); ?></span>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Username -->
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Username</label>
                        <span class="text-gray-900"><?= htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <!-- Email -->
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Email</label>
                        <span class="text-gray-500"><?= htmlspecialchars($user->user_email, ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <!-- Role -->
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Role</label>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
              <?= htmlspecialchars(UserModel::getAccountTypeLang($this->availableAccType, $user->user_account_type), ENT_QUOTES, 'UTF-8'); ?>
            </span>
                    </div>
                    <!-- Profile -->
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Profile</label>
                        <a href="<?= Config::get('URL').'profile/showProfile/'.$user->user_id; ?>" class="text-indigo-600 hover:text-indigo-900">
                            View Profile
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Desktop View: Table (visible md and above) -->
        <div class="hidden md:block">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table id="users-table" class="w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <?php foreach($this->users as $user) { ?>
                        <tr class="<?= ($user->user_active == 0 ? 'bg-gray-100' : 'bg-white hover:bg-gray-50 transition-colors duration-150'); ?>">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" data-label="Id"><?= $user->user_id; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Avatar">
                                <?php if(isset($user->user_avatar_link)) { ?>
                                    <img src="<?= $user->user_avatar_link; ?>" alt="Avatar" class="h-10 w-10 rounded-full inline-block">
                                <?php } else { ?>
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center inline-block">
                                        <span class="text-gray-500"><?= substr(htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'), 0, 1); ?></span>
                                    </div>
                                <?php } ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Username"><?= htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Email"><?= htmlspecialchars($user->user_email, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Role">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                    <?= htmlspecialchars(UserModel::getAccountTypeLang($this->availableAccType, $user->user_account_type), ENT_QUOTES, 'UTF-8'); ?>
                  </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Profile">
                                <a href="<?= Config::get('URL').'profile/showProfile/'.$user->user_id; ?>" class="text-indigo-600 hover:text-indigo-900">
                                    View Profile
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#customSearch").on("keyup", function(){
            var value = $(this).val().toLowerCase();
            $("#users-table tbody tr").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
