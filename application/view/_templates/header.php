<!doctype html>
<html>
<head>
    <title>Tickify</title>
    <!-- META -->
    <meta charset="utf-8">
    <link rel="icon" href="data:;base64,=">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
</head>
<body class="bg-gray-100">
<!-- Header -->
<header class="bg-white shadow-md rounded-lg p-5 mb-6 flex justify-between items-center text-lg relative z-50">
    <!-- Brand Name -->
    <div class="text-2xl font-extrabold text-gray-900">Tickify</div>

    <!-- Navigation -->
    <nav>
        <ul class="flex space-x-4">
            <?php if (Session::userIsLoggedIn()) { ?>
                <li>
                    <a href="<?php echo Config::get('URL'); ?>aiChat/index" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">AI</a>
                </li>
                <li>
                    <a href="<?php echo Config::get('URL'); ?>index/index" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Index</a>
                </li>
                <li>
                    <a href="<?php echo Config::get('URL'); ?>dashboard/index" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo Config::get('URL'); ?>ticket/index" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Ticket List</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="<?php echo Config::get('URL'); ?>login/index" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Login</a>
                </li>
            <?php } ?>
        </ul>
    </nav>

    <!-- Right Navigation -->
    <nav>
        <ul class="flex space-x-4">
            <?php if (Session::userIsLoggedIn()) : ?>
                <li class="relative group">
                    <a href="#" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Settings</a>
                    <ul class="absolute hidden bg-white shadow-lg rounded-md p-2 mt-2 group-hover:block w-48 right-0 opacity-0 group-hover:opacity-100 transition-opacity duration-200 ease-in-out z-50" onmouseover="this.style.opacity='1'" onmouseleave="this.style.opacity='1'">
                        <li><a href="<?php echo Config::get('URL'); ?>user/editAvatar" class="block p-3 hover:bg-gray-200">Edit Avatar</a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/editusername" class="block p-3 hover:bg-gray-200">Edit Username</a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/edituseremail" class="block p-3 hover:bg-gray-200">Edit Email</a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/changePassword" class="block p-3 hover:bg-gray-200">Change Password</a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>login/logout" class="block p-3 hover:bg-red-100 text-red-600">Logout</a></li>
                    </ul>
                </li>
                <?php if (Session::get('user_account_type') == 7) : ?>
                    <li>
                        <a href="<?php echo Config::get('URL'); ?>admin/" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Admin</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::get('URL'); ?>register/index" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Register</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (Session::get('user_account_type') >= 5) : ?>
                <li>
                    <a href="<?php echo Config::get('URL'); ?>profile/index" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white hover:scale-105 transition-all font-semibold hover:shadow-md">Profiles</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
</body>
</html>