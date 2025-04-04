<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8 overflow-hidden scrollbar-hide">
    <!-- Centered Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Panel</h1>
        <p class="text-gray-600">Manage system users and their permissions</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- System Feedback -->
        <div class="px-4 mb-4">
            <?php $this->renderFeedbackMessages(); ?>
            <?php $availableAccType = UserModel::getAvailableAccountTypes(); ?>
        </div>

        <!-- Search Bar -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-4">
            <div class="p-4">
                <input
                        type="text"
                        id="tableSearch"
                        placeholder="Search users..."
                        class="w-full rounded-md border border-gray-300 p-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                />
            </div>
        </div>

        <!-- Mobile View: Cards (visible below md) -->
        <div class="block md:hidden space-y-4">
            <?php foreach ($this->users as $user) { ?>
                <div class="bg-white rounded-xl shadow-lg p-4">
                    <form action="<?= Config::get('URL'); ?>admin/actionAccountSettings" method="post">
                        <!-- Id -->
                        <div class="mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Id</label>
                            <span><?= $user->user_id; ?></span>
                        </div>
                        <!-- Avatar -->
                        <div class="mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Avatar</label>
                            <?php if (isset($user->user_avatar_link)) { ?>
                                <img src="<?= $user->user_avatar_link; ?>" alt="avatar" class="h-10 w-10 rounded-full shadow-md object-cover">
                            <?php } ?>
                        </div>
                        <!-- Username -->
                        <div class="mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Username</label>
                            <input
                                    type="text"
                                    name="userNameInput"
                                    value="<?= $user->user_name; ?>"
                                    class="w-full bg-transparent border border-gray-200 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                        </div>
                        <!-- Email -->
                        <div class="mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Email</label>
                            <input
                                    type="text"
                                    name="userEmail"
                                    value="<?= $user->user_email; ?>"
                                    class="w-full bg-transparent border border-gray-200 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                        </div>
                        <!-- Role -->
                        <div class="mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Role</label>
                            <select
                                    name="account_type"
                                    class="w-full bg-transparent border border-gray-200 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                <?php foreach ($this->availableAccType as $type) : ?>
                                    <option value="<?= $type->account_type; ?>" <?= $type->account_type === $user->user_account_type ? 'selected' : ''; ?>>
                                        <?= $type->lang; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Profile -->
                        <div class="mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Profile</label>
                            <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                View Profile
                            </a>
                        </div>
                        <!-- Actions -->
                        <div class="mb-2">
                            <input type="hidden" name="user_id" value="<?= $user->user_id; ?>">
                            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>

        <!-- Desktop View: Table (visible md and above) -->
        <div class="hidden md:block">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="min-w-full" id="userTable">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <?php foreach ($this->users as $user) { ?>
                        <tr class="<?= ($user->user_active == 0 ? 'bg-red-50' : 'hover:bg-gray-50 transition-colors duration-150'); ?>">
                            <form action="<?= Config::get('URL'); ?>admin/actionAccountSettings" method="post">
                                <!-- Id -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" data-label="Id">
                                    <?= $user->user_id; ?>
                                </td>
                                <!-- Avatar -->
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Avatar">
                                    <?php if (isset($user->user_avatar_link)) { ?>
                                        <img src="<?= $user->user_avatar_link; ?>" alt="avatar" class="h-10 w-10 rounded-full shadow-md object-cover">
                                    <?php } ?>
                                </td>
                                <!-- Username -->
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Username">
                                    <input
                                            type="text"
                                            name="userNameInput"
                                            value="<?= $user->user_name; ?>"
                                            class="w-full bg-transparent border border-gray-200 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    />
                                </td>
                                <!-- Email -->
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Email">
                                    <input
                                            type="text"
                                            name="userEmail"
                                            value="<?= $user->user_email; ?>"
                                            class="w-full bg-transparent border border-gray-200 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    />
                                </td>
                                <!-- Role -->
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Role">
                                    <select
                                            name="account_type"
                                            class="w-full bg-transparent border border-gray-200 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    >
                                        <?php foreach ($this->availableAccType as $type) : ?>
                                            <option value="<?= $type->account_type; ?>" <?= $type->account_type === $user->user_account_type ? 'selected' : ''; ?>>
                                                <?= $type->lang; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <!-- Profile -->
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Profile">
                                    <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                        View Profile
                                    </a>
                                </td>
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Actions">
                                    <input type="hidden" name="user_id" value="<?= $user->user_id; ?>">
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                        Update
                                    </button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- jQuery for search functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase().trim();
            $("#userTable tbody tr, .block.md\\:hidden .bg-white.rounded-xl.shadow-lg.p-4").each(function(){
                var clone = $(this).clone();
                clone.find("label").remove();
                clone.find("select").remove();
                var combinedText = clone.text().toLowerCase().replace(/\s+/g, " ").trim();
                $(this).find("input").each(function(){
                    combinedText += " " + $(this).val().toLowerCase().trim();
                });
                $(this).find("select").each(function(){
                    combinedText += " " + $(this).find("option:selected").text().toLowerCase().trim();
                });
                $(this).toggle(combinedText.indexOf(value) > -1);
            });
        });
    });
</script>

