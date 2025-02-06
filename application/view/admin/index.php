<div class="container">
    <h1>Admin Panel</h1>

    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <?php $availableAccType = UserModel::getAvailableAccountTypes() ?>

        <div>
            <table class="overview-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Avatar</td>
                    <td>Username</td>
                    <td>User's email</td>
                    <td>User Role</td>
                    <td>Link to user's profile</td>
                    <td>Submit</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->users as $user) { ?>
                    <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                        <form action="<?= Config::get('URL'); ?>admin/actionAccountSettings" method="post">
                            <td><?= $user->user_id; ?></td>
                            <td class="avatar">
                                <?php if (isset($user->user_avatar_link)) { ?>
                                    <img src="<?= $user->user_avatar_link; ?>" />
                                <?php } ?>
                            </td>
                            <td data-search="<?= htmlentities($user->user_name); ?>">
                                <input type="text" id="userNameInput" name="userNameInput" value="<?= $user->user_name; ?>" />
                            </td>
                            <td data-search="<?= htmlentities($user->user_email); ?>">
                                <input type="text" id="userEmail" name="userEmail" value="<?= $user->user_email; ?>" />
                            </td>
                            <td>
                                <select name="account_type" id="account_type">
                                    <?php foreach ($availableAccType as $type) : ?>
                                        <option value="<?= $type->account_type; ?>" <?= $type->account_type === $user->user_account_type ? 'selected' : ''; ?>>
                                            <?= $type->lang; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Profile</a>
                            </td>
                            <td>
                                <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" />
                                <input type="submit" value="Submit" />
                            </td>
                        </form>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.0/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.0/css/jquery.dataTables.min.css" />

    <script>
        $(document).ready(function () {
            $('.overview-table').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                order: [[0, 'asc']],
            });
        });
    </script>
    </div>
</div>
