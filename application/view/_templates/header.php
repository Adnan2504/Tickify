<!doctype html>
<html>
<head>
    <title>Tickify</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:;base64,=">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
    <!-- SVG Icons -->
    <svg xmlns="http://www.w3.org/2000/svg" class="hidden">
        <symbol id="bars-3" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </symbol>
        <symbol id="x-mark" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </symbol>
        <symbol id="trash" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
        </symbol>
        <symbol id="pencil-square" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
        </symbol>
        <symbol id="pencil" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </symbol>
        <symbol id="home" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
        </symbol>
        <symbol id="chart-bar-square" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z"/>
        </symbol>
        <symbol id="clipboard-document-list" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008h-.008V12Zm0 3h.008v.008h-.008V15Zm0 3h.008v.008h-.008V18Z"/>
        </symbol>
        <symbol id="chat-bubble-left-right" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
        </symbol>
        <symbol id="cog-6-tooth" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
        </symbol>
        <symbol id="wrench-screwdriver" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z"/>
        </symbol>
        <symbol id="user-group" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
        </symbol>
        <symbol id="at-symbol" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25"/>
        </symbol>
        <symbol id="key" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"/>
        </symbol>
        <symbol id="arrow-left-start-on-rectangle" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"/>
        </symbol>
        <symbol id="user-plus" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>
        </symbol>
    </svg>
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-white shadow-md rounded-lg p-5 mb-6 flex items-center justify-between text-lg relative z-50">
    <!-- Brand Name -->
    <a href="<?php echo Config::get('URL'); ?>index/index" class="text-2xl font-extrabold text-gray-900 hover:text-blue-500 hover:scale-110 transform transition-all duration-200">
        Tickify
    </a>

    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="lg:hidden text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>


    <!-- Desktop Navigation -->
    <nav class="hidden lg:block absolute left-1/2 transform -translate-x-1/2">
        <ul class="flex flex-nowrap justify-center space-x-4 lg:space-x-8 xl:space-x-14">
            <li><a href="<?php echo Config::get('URL'); ?>index/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#home"/></svg>Index
                </a></li>
            <li><a href="<?php echo Config::get('URL'); ?>dashboard/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#chart-bar-square"/></svg>Dashboard
                </a></li>
            <li><a href="<?php echo Config::get('URL'); ?>ticket/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#clipboard-document-list"/></svg>Ticket List
                </a></li>
            <li><a href="<?php echo Config::get('URL'); ?>aiChat/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500 whitespace-nowrap py-2">
                    <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#chat-bubble-left-right"/></svg>AI
                </a></li>
        </ul>
    </nav>

    <!-- User Navigation -->
    <nav class="hidden lg:block">
        <ul class="flex space-x-10">
            <?php if (Session::userIsLoggedIn()) : ?>
                <li class="relative group">
                    <a href="#" class="flex items-center font-semibold text-gray-700 hover:text-blue-500">
                        <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#cog-6-tooth"/></svg>User Options
                    </a>
                    <ul class="absolute hidden bg-white shadow-lg rounded-md p-2 mt-1 w-48 right-0 group-hover:block transition-all duration-200 z-50">
                        <li><a href="<?php echo Config::get('URL'); ?>user/index" class="flex items-center p-3 hover:bg-gray-200">
                                <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#pencil-square"/></svg>My Profile
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/editAvatar" class="flex items-center p-3 hover:bg-gray-200">
                                <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#pencil-square"/></svg>Edit Avatar
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/editusername" class="flex items-center p-3 hover:bg-gray-200">
                                <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#pencil"/></svg>Edit Username
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/edituseremail" class="flex items-center p-3 hover:bg-gray-200">
                                <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#at-symbol"/></svg>Edit Email
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>user/changePassword" class="flex items-center p-3 hover:bg-gray-200">
                                <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#key"/></svg>Change Password
                            </a></li>
                        <li><a href="<?php echo Config::get('URL'); ?>login/logout" class="flex items-center p-3 hover:bg-red-100 text-red-600">
                                <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#arrow-left-start-on-rectangle"/></svg>Logout
                            </a></li>
                    </ul>
                </li>

                <?php if (Session::get('user_account_type') == 7) : ?>
                    <li class="relative group">
                        <a href="#" class="flex items-center font-semibold text-gray-700 hover:text-blue-500">
                            <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#wrench-screwdriver"/></svg>Admin
                        </a>
                        <ul class="absolute hidden bg-white shadow-lg rounded-md p-2 mt-1 w-48 right-0 group-hover:block transition-all duration-200 z-50">
                            <li><a href="<?php echo Config::get('URL'); ?>admin/" class="flex items-center p-3 hover:bg-gray-200">
                                    <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#wrench-screwdriver"/></svg>Admin Panel
                                </a></li>
                            <li><a href="<?php echo Config::get('URL'); ?>register/index" class="flex items-center p-3 hover:bg-gray-200">
                                    <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#user-plus"/></svg>Register User
                                </a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (Session::get('user_account_type') >= 5) : ?>
                    <li><a href="<?php echo Config::get('URL'); ?>profile/index" class="flex items-center font-semibold text-gray-700 hover:text-blue-500">
                            <svg class="w-5 h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#user-group"/></svg>Profiles
                        </a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Mobile Menu (Initially Hidden) -->
    <div id="mobile-menu" class="fixed inset-0 bg-gray-800 bg-opacity-75 lg:hidden hidden z-40">
        <div class="flex justify-end p-4">
            <button id="close-mobile-menu" class="text-white">
                <svg class="w-8 h-8" xmlns<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex flex-col items-center">
            <nav class="w-full px-4">
                <ul class="flex flex-col space-y-4 text-white text-xl">
                    <li><a href="<?php echo Config::get('URL'); ?>index/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#home"/></svg>Index
                        </a></li>
                    <li><a href="<?php echo Config::get('URL'); ?>dashboard/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#chart-bar-square"/></svg>Dashboard
                        </a></li>
                    <li><a href="<?php echo Config::get('URL'); ?>ticket/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#clipboard-document-list"/></svg>Ticket List
                        </a></li>
                    <li><a href="<?php echo Config::get('URL'); ?>aiChat/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#chat-bubble-left-right"/></svg>AI
                        </a></li>

                    <?php if (Session::userIsLoggedIn()) : ?>
                        <li class="border-t border-gray-600 mt-4 pt-4">
                            <p class="text-gray-400 px-4 mb-2">User Options</p>
                            <ul class="pl-4">
                                <li><a href="<?php echo Config::get('URL'); ?>user/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#pencil-square"/></svg>My Profile
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#pencil-square"/></svg>Edit Avatar
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/editusername" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#pencil"/></svg>Edit Username
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/edituseremail" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#at-symbol"/></svg>Edit Email
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>user/changePassword" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#key"/></svg>Change Password
                                    </a></li>
                                <li><a href="<?php echo Config::get('URL'); ?>login/logout" class="flex items-center py-2 px-4 hover:bg-red-700 rounded text-red-300">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#arrow-left-start-on-rectangle"/></svg>Logout
                                    </a></li>
                            </ul>
                        </li>

                        <?php if (Session::get('user_account_type') == 7) : ?>
                            <li class="border-t border-gray-600 mt-4 pt-4">
                                <p class="text-gray-400 px-4 mb-2">Admin Options</p>
                                <ul class="pl-4">
                                    <li><a href="<?php echo Config::get('URL'); ?>admin/" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#wrench-screwdriver"/></svg>Admin Panel
                                        </a></li>
                                    <li><a href="<?php echo Config::get('URL'); ?>register/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded">
                                            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#user-plus"/></svg>Register User
                                        </a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (Session::get('user_account_type') >= 5) : ?>
                            <li><a href="<?php echo Config::get('URL'); ?>profile/index" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded mt-4">
                                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><use href="#user-group"/></svg>Profiles
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