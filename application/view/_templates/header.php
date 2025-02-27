<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickify</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css">
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="<?php echo Config::get('URL'); ?>" class="text-xl font-bold text-blue-600">
                        Tickify
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-6">
                    <?php if (Session::userIsLoggedIn()) { ?>
                        <a href="<?php echo Config::get('URL'); ?>index/index" class="hover:text-blue-500 transition">Index</a>
                        <a href="<?php echo Config::get('URL'); ?>dashboard/index" class="hover:text-blue-500 transition">Dashboard</a>
                        <a href="<?php echo Config::get('URL'); ?>ticket/index" class="hover:text-blue-500 transition">Tickets</a>
                        <a href="<?php echo Config::get('URL'); ?>aiChat/index" class="hover:text-blue-500 transition">AI</a>
                    <?php } else { ?>
                        <a href="<?php echo Config::get('URL'); ?>login/index" class="hover:text-blue-500 transition">Login</a>
                    <?php } ?>
                </div>

                <!-- User Menü (Rechts) -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php if (Session::userIsLoggedIn()) : ?>
                        <a href="<?php echo Config::get('URL'); ?>user/index" class="hover:text-blue-500 transition">Einstellungen</a>
                        <a href="<?php echo Config::get('URL'); ?>login/logout" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                            Logout
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menü Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <?php if (Session::userIsLoggedIn()) { ?>
                    <a href="<?php echo Config::get('URL'); ?>index/index" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 rounded">Index</a>
                    <a href="<?php echo Config::get('URL'); ?>dashboard/index" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 rounded">Dashboard</a>
                    <a href="<?php echo Config::get('URL'); ?>ticket/index" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 rounded">Tickets</a>
                    <a href="<?php echo Config::get('URL'); ?>aiChat/index" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 rounded">AI</a>
                    <a href="<?php echo Config::get('URL'); ?>user/index" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 rounded">Einstellungen</a>
                    <a href="<?php echo Config::get('URL'); ?>login/logout" class="block px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Logout</a>
                <?php } else { ?>
                    <a href="<?php echo Config::get('URL'); ?>login/index" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 rounded">Login</a>
                <?php } ?>
            </div>
        </div>
    </nav>

    <!-- JavaScript für das Mobile Menü -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
