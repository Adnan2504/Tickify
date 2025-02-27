<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Your App</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>application/view/login/style.css">
</head>
<body class="bg-gray-100">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8 transition-all duration-200 hover:shadow-2xl">
      <!-- System feedback (error and success messages) -->
      <?php $this->renderFeedbackMessages(); ?>

      <!-- Login Section -->
      <div class="mb-6">
        <h1 class="text-3xl font-bold mb-2 text-center">Login</h1>
        <p class="text-center text-gray-600 mb-4">Login to your account to continue</p>
        <form action="<?php echo Config::get('URL'); ?>login/login" method="post" class="space-y-4">
          <div class="form-group">
            <label for="user_name" class="block text-gray-700 text-center">Username or Email</label>
            <input type="text" id="user_name" name="user_name" placeholder="Enter your username or email" required
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
          </div>
          <div class="form-group">
            <label for="user_password" class="block text-gray-700 text-center">Password</label>
            <input type="password" id="user_password" name="user_password" placeholder="Enter your password" required
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
          </div>
          <div class="flex items-center justify-between">
            <label class="inline-flex items-center">
              <input type="checkbox" name="set_remember_me_cookie" class="form-checkbox h-4 w-4 text-blue-500">
              <span class="ml-2 text-gray-700">Remember me for 2 weeks</span>
            </label>
            <a href="<?php echo Config::get('URL'); ?>login/requestPasswordReset" 
               class="text-blue-500 hover:underline transition-transform hover:scale-105">
              I forgot my password
            </a>
          </div>
          <?php if (!empty($this->redirect)) { ?>
            <input type="hidden" name="redirect" value="<?php echo $this->encodeHTML($this->redirect); ?>">
          <?php } ?>
          <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>">
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-all duration-200 hover:scale-105">
            Login
          </button>
        </form>
      </div>

      <!-- Divider -->
      <div class="flex items-center justify-center mb-6">
        <span class="border-b border-gray-300 w-1/3"></span>
        <span class="px-2 text-gray-500">or</span>
        <span class="border-b border-gray-300 w-1/3"></span>
      </div>

      <!-- Registration Section -->
      <div class="text-center">
        <h2 class="text-2xl font-bold mb-2">No account yet?</h2>
        <p class="mb-4 text-gray-600">Create an account to get started</p>
        <a href="<?php echo Config::get('URL'); ?>register/index" 
           class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-all duration-200 inline-block hover:scale-105">
          Register
        </a>
      </div>
    </div>
  </div>
</body>
</html>
