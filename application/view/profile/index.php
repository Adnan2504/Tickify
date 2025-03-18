
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">All Users</h1>
        </div>

        <div class="p-6">
            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>
            <?php $availableAccType = UserModel::getAvailableAccountTypes() ?>

            <div class="overflow-x-auto">
                <table id="users-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User's email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Role</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($this->users as $user) { ?>
                        <tr class="<?= ($user->user_active == 0 ? 'bg-gray-100' : 'hover:bg-gray-50'); ?>">
                            <form action="<?= Config::get('URL'); ?>admin/actionAccountSettings" method="post">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $user->user_id; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if (isset($user->user_avatar_link)) { ?>
                                        <img src="<?= $user->user_avatar_link; ?>" class="h-10 w-10 rounded-full" />
                                    <?php } else { ?>
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500"><?= substr(htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'), 0, 1); ?></span>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" data-search="<?= htmlentities($user->user_name); ?>">
                                    <?= htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-search="<?= htmlentities($user->user_email); ?>">
                                    <?= htmlspecialchars($user->user_email, ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            <?= htmlspecialchars(UserModel::getAccountTypeLang($availableAccType, $user->user_account_type), ENT_QUOTES, 'UTF-8'); ?>
                                        </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>" class="text-indigo-600 hover:text-indigo-900">View Profile</a>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/jquery.dataTables.min.css" />

    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                order: [[0, 'asc']],
                "dom": '<"top"f>rt<"bottom"lip><"clear">',
                "language": {
                    "search": "<span class='text-gray-500'>Search:</span>",
                    "paginate": {
                        "previous": "<span class='text-indigo-600'>&lt;</span>",
                        "next": "<span class='text-indigo-600'>&gt;</span>"
                    }
                }
            });

            // Apply some styling to DataTables elements
            $('.dataTables_wrapper .dataTables_filter input').addClass('border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500');
            $('.dataTables_wrapper .dataTables_length select').addClass('border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500');
        });
    </script>
</div>
