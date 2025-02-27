<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Tickify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow flex flex-col">
    <!-- User Info -->
    <div class="p-6">
      <div class="flex items-center space-x-4">
        <!-- Replace this placeholder with your user’s avatar image -->
        <img
          src="https://via.placeholder.com/40"
          alt="User Avatar"
          class="w-12 h-12 rounded-full"
        />
        <div>
          <div class="font-bold text-lg">User Name</div>
          <div class="text-sm text-gray-500">Account</div>
        </div>
      </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-2 overflow-y-auto text-sm text-gray-700">
      <!-- Top-Level Links -->
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        <!-- Icon (optional) -->
        <!-- <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
          <path d="..." />
        </svg> -->
        Dashboard
      </a>

      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Create Ticket
      </a>

      <!-- Queues Section -->
      <div class="mt-4 mb-1 text-xs font-semibold tracking-wide text-gray-400 uppercase">
        Queues
      </div>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        All Tickets
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        My Tickets
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Pending Tickets
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Unresponded
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Due Today
      </a>

      <!-- Status Section -->
      <div class="mt-6 mb-1 text-xs font-semibold tracking-wide text-gray-400 uppercase">
        Status
      </div>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        New
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Open
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        On Hold
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Solved
      </a>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Closed
      </a>

      <!-- Categories Section -->
      <div class="mt-6 mb-1 text-xs font-semibold tracking-wide text-gray-400 uppercase">
        Categories
      </div>
      <a
        href="#"
        class="flex items-center p-2 mt-2 rounded hover:bg-gray-200"
      >
        Billing & Returns
      </a>
      <!-- Add more categories or sections as needed -->
    </nav>
  </aside>

  <!-- Main Content Area -->
  <main class="flex-1 p-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <!-- Your main dashboard content goes here -->
    <p class="text-gray-700">Welcome to your dashboard!</p>
  </main>
</body>
</html>
