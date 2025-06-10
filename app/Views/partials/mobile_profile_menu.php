<button id="sidebarToggle" class="absolute left-1 top-18 animate-pulse flex md:hidden items-center justify-center bg-green-600 text-white rounded-full p-2 shadow-lg z-1 transition hover:bg-green-700 focus:outline-none" aria-label="Open sidebar">
  <svg id="sidebarArrow" class="w-7 h-7 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
  </svg>
</button>

<aside id="mobileSidebar" class="fixed top-0 left-0 h-screen w-72 bg-green-600 text-white flex-col items-center justify-start py-10 shadow-lg z-50 text-nowrap font-semibold transition-all duration-300 sm:flex hidden opacity-0 -translate-x-10 pointer-events-none">
  <div class="mb-10 w-full border-b-2 border-green-200 text-center">
    <span class="text-2xl font-bold">Admin Panel</span>
  </div>
  <?php
  $url = $_SERVER['REQUEST_URI'];
  ?>
  <nav class="flex flex-col gap-4 w-full px-4 border-b-2 border-green-200 pb-10">
    <a href="/admin/profile" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 transition <?= active_link('/admin/profile', $url) && !active_link('/admin/profile/', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-user"></i>
      <span>Profile</span>
    </a>
    <a href="/admin/profile/election" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 transition <?= active_link('/admin/profile/election', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-user"></i>
      <span>Election Date</span>
    </a>
    <a href="/admin/profile/organization" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 transition <?= active_link('/admin/profile/organization', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-users"></i>
      <span>Organizations</span>
    </a>
    <a href="/admin/profile/position" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 transition <?= active_link('/admin/profile/position', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-sign-out"></i>
      <span>Positions</span>
    </a>
    <a href="/admin/profile/officers" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 transition <?= active_link('/admin/profile/officers', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-sign-out"></i>
      <span>Officers</span>
    </a>
  </nav>
  <button id="sidebarClose" class="absolute top-4 right-4 bg-green-700 hover:bg-green-800 rounded-full p-2 transition" aria-label="Close sidebar">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>
</aside>