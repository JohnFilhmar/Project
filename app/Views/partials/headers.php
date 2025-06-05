<header class="flex items-center justify-between p-4 bg-gray-800 text-white">
  <div class="flex items-center">
    <a href="/" class="text-lg font-bold">
      <img src="/logo.jpg" alt="E-Ballot Logo" class="h-8 w-8 inline-block mr-2">
      E-Ballot System
    </a>
    <nav class="ml-6">
      <ul class="flex space-x-4">
        <li><a href="/" class="hover:underline">Home</a></li>
        <li><a href="/about" class="hover:underline">About</a></li>
        <li><a href="/contact" class="hover:underline">Contact</a></li>
        <li><a href="/login" class="hover:underline">Login</a></li>
        <li><a href="/register" class="hover:underline">Register</a></li>
      </ul>
    </nav>
  </div>
  <div class="flex items-center">
    <form action="/search" method="get" class="flex items-center">
      <input type="text" name="query" placeholder="Search..." class="p-2 rounded bg-gray-700 text-white">
      <button type="submit" class="ml-2 p-2 bg-blue-600 rounded hover:bg-blue-700">Search</button>
    </form>
    <a href="/profile" class="ml-4 p-2 bg-gray-700 rounded hover:bg-gray-600">Profile</a>
    <a href="/logout" class="ml-4 p-2 bg-red-600 rounded hover:bg-red-700">Logout</a>
  </div>
</header>