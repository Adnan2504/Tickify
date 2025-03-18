<!doctype html>
<html>
<head>
    <title>Tickify</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:;base64,=">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
</head>
<body class="bg-gray-100">

<?php require_once(Config::get('PATH_VIEW') . '_templates/icons.php'); ?>

<!-- Header -->
<header class="bg-white shadow-md rounded-lg p-5 mb-6 flex items-center justify-between text-lg relative z-50">
    <!-- Brand Name -->
    <a href="<?php echo Config::get('URL'); ?>index/index" class="text-2xl font-extrabold text-gray-900 hover:text-blue-500 hover:scale-110 transform transition-all duration-200">
        Tickify
    </a>

    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="lg:hidden text-gray-700 focus:outline-none">
        <?php echo icon('bars-3', 'w-6 h-6'); ?>
    </button>


    <!-- Desktop Navigation -->
    <nav class="hidden lg:block absolute left-1/2 transform -translate-x-1/2">
        <ul class="flex flex-nowrap justify-center space-x-4 lg:space-x-8 xl:space-x-14">
            <li><a href="<?php echo Config::get('URL'); ?>index/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <?php echo icon('home', 'w-5 h-5 mr-1'); ?> Index
                </a></li>
            <li><a href="<?php echo Config::get('URL'); ?>dashboard/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <?php echo icon('chart-bar-square', 'w-5 h-5 mr-1'); ?> Dashboard
                </a></li>
            <li><a href="<?php echo Config::get('URL'); ?>ticket/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <?php echo icon('clipboard-document-list', 'w-5 h-5 mr-1'); ?> Ticket List
                </a></li>
            <li><a href="<?php echo Config::get('URL'); ?>aiChat/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <?php echo icon('chat-bubble-left-right', 'w-5 h-5 mr-1'); ?> AI
                </a></li>
        </ul>
    </nav>

    <!-- User Navigation -->
    <nav class="hidden lg:block">
        <ul class="flex space-x-10">
            <?php if (Session::userIsLoggedIn()) : ?>
                <li class="relative group">
                    <a href="#" class="flex items-center font-semibold text-gray-700 hover:text-blue-500">
                        <?php echo icon('cog-6-tooth', 'w-5 h-5 mr-1'); ?> User Options
                    </a>
                    <ul class="absolute hidden bg-white shadow-lg rounded-md p-2 mt-1 w-48 right-0 group-hover:block transition-all duration-200 z-50">
                        <li><a href="<?php echo Config::get('URL'); ?>user/editAvatar" class="flex items-center p-3 hover:bg-gray-200">
                                <?php echo icon('pencil-square', 'w-4 h-4 mr-2'); ?> Edit Avatar
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/editusername" class="flex items-center p-3 hover:bg-gray-200">
                                <?php echo icon('pencil', 'w-4 h-4 mr-2'); ?> Edit Username
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/edituseremail" class="flex items-center p-3 hover:bg-gray-200">
                                <?php echo icon('at-symbol', 'w-4 h-4 mr-2'); ?> Edit Email
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/changePassword" class="flex items-center p-3 hover:bg-gray-200">
                                <?php echo icon('key', 'w-4 h-4 mr-2'); ?> Change Password
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>login/logout" class="flex items-center p-3 hover:bg-red-100 text-red-600">
                                <?php echo icon('arrow-left-start-on-rectangle', 'w-4 h-4 mr-2'); ?> Logout
                            </a></li>
                    </ul>
                </li>

                <?php if (Session::get('user_account_type') == 7) : ?>
                    <li class="relative group">
                        <a href="#" class="flex items-center font-semibold text-gray-700 hover:text-blue-500">
                            <?php echo icon('wrench-screwdriver', 'w-5 h-5 mr-1'); ?> Admin
                        </a>
                        <ul class="absolute hidden bg-white shadow-lg rounded-md p-2 mt-1 w-48 right-0 group-hover:block transition-all duration-200 z-50">
                            <li><a href="<?php echo Config::get('URL'); ?>admin/" class="flex items-center p-3 hover:bg-gray-200">
                                    <?php echo icon('wrench-screwdriver', 'w-4 h-4 mr-2'); ?> Admin Panel
                                </a></li>
                            <li><a href="<?php echo Config::get('URL'); ?>register/index" class="flex items-center p-3 hover:bg-gray-200">
                                    <?php echo icon('user-plus', 'w-4 h-4 mr-2'); ?> Register User
                                </a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (Session::get('user_account_type') >= 5) : ?>
                    <li><a href="<?php echo Config::get('URL'); ?>profile/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500">
                            <?php echo icon('user-group', 'w-5 h-5 mr-1'); ?> Profiles
                        </a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Mobile Menu (Initially Hidden) -->
    <div id="mobile-menu" class="fixed inset-0 bg-gray-800 bg-opacity-75 lg:hidden hidden z-40">
        <div class="flex justify-end p-4">
            <button id="close-mobile-menu" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex flex-col items-center">
            <nav class="w-full px-4">
                <ul class="flex flex-col space-y-4 text-white text-xl">
                    <li><a href="<?php echo Config::get('URL'); ?>index/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <?php echo icon('home', 'w-6 h-6 mr-2'); ?> Index
                        </a></li>
                    <li><a href="<?php echo Config::get('URL'); ?>dashboard/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <?php echo icon('chart-bar-square', 'w-6 h-6 mr-2'); ?> Dashboard
                        </a></li>
                    <li><a href="<?php echo Config::get('URL'); ?>ticket/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <?php echo icon('clipboard-document-list', 'w-6 h-6 mr-2'); ?> Ticket List
                        </a></li>
                    <li><a href="<?php echo Config::get('URL'); ?>aiChat/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <?php echo icon('chat-bubble-left-right', 'w-6 h-6 mr-2'); ?> AI
                        </a></li>

                    <?php if (Session::userIsLoggedIn()) : ?>
                        <li class="border-t border-gray-600 mt-4 pt-4">
                            <p class="text-gray-400 px-4 mb-2">User Options</p>
                            <ul class="pl-4">
                                <li><a href="<?php echo Config::get('URL'); ?>user/editAvatar" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <?php echo icon('pencil-square', 'w-5 h-5 mr-2'); ?> Edit Avatar
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/editusername" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <?php echo icon('pencil', 'w-5 h-5 mr-2'); ?> Edit Username
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/edituseremail" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <?php echo icon('at-symbol', 'w-5 h-5 mr-2'); ?> Edit Email
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/changePassword" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <?php echo icon('key', 'w-5 h-5 mr-2'); ?> Change Password
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>login/logout" class="flex items-center py-2 px-4 hover:bg-red-700 rounded text-red-300">
                                        <?php echo icon('arrow-left-start-on-rectangle', 'w-5 h-5 mr-2'); ?> Logout
                                    </a></li>
                            </ul>
                        </li>

                        <?php if (Session::get('user_account_type') == 7) : ?>
                            <li class="border-t border-gray-600 mt-4 pt-4">
                                <p class="text-gray-400 px-4 mb-2">Admin Options</p>
                                <ul class="pl-4">
                                    <li><a href="<?php echo Config::get('URL'); ?>admin/" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                            <?php echo icon('wrench-screwdriver', 'w-5 h-5 mr-2'); ?> Admin Panel
                                        </a></li>
                                    <li><a href="<?php echo Config::get('URL'); ?>register/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                            <?php echo icon('user-plus', 'w-5 h-5 mr-2'); ?> Register User
                                        </a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (Session::get('user_account_type') >= 5) : ?>
                            <li><a href="<?php echo Config::get('URL'); ?>profile/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded mt-4">
                                    <?php echo icon('user-group', 'w-5 h-5 mr-2'); ?> Profiles
                                </a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>

<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMobileMenu = document.getElementById('close-mobile-menu');

        // Ensure menu is hidden on page load
        if (mobileMenu) {
            mobileMenu.classList.add('hidden');
        }

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            if (closeMobileMenu) {
                closeMobileMenu.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            }
        }

        function checkLayout() {
            const isDesktopWidth = window.innerWidth >= 1024;

            if (isDesktopWidth) {
                document.body.classList.remove('mobile-view');
                document.body.classList.add('desktop-view');
            } else {
                document.body.classList.remove('desktop-view');
                document.body.classList.add('mobile-view');

                // Ensure menu is hidden in mobile view
                if (mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
            }

            sessionStorage.setItem('viewMode', isDesktopWidth ? 'desktop' : 'mobile');
        }


        function applyStoredViewMode() {
            const storedViewMode = sessionStorage.getItem('viewMode');

            if (storedViewMode === 'desktop' && window.innerWidth >= 1024) {
                document.body.classList.remove('mobile-view');
                document.body.classList.add('desktop-view');
            }

            // Ensure menu is hidden regardless of view mode
            if (mobileMenu) {
                mobileMenu.classList.add('hidden');
            }
        }

        applyStoredViewMode();
        checkLayout();
        window.addEventListener('resize', checkLayout);
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                applyStoredViewMode();
            }
            if (mobileMenu) {
                mobileMenu.classList.add('hidden');
            }
            checkLayout();
        });
    });
</script>

</body>
</html>