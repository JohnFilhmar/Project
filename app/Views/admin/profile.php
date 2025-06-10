<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<aside id="adminSidebar" class="hidden md:flex absolute top-0 bottom-0 left-0 w-fit bg-green-600 text-white flex-col items-center justify-center py-10 shadow-lg z-40 text-nowrap font-semibold sidebar-transition sidebar-visible">
  <div class="mb-10 w-full border-b-2 border-green-200 text-center">
    <span class="text-2xl font-bold">Admin Panel</span>
  </div>
  <nav class="flex flex-col gap-4 w-full px-10 border-b-2 border-green-200 pb-10">
    <a href="/admin/profile" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 hover:text-white transition <?= active_link('/admin/profile', $url) && !active_link('/admin/profile/', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-user"></i>
      <span>Profile</span>
    </a>
    <a href="/admin/profile/election" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 hover:text-white transition <?= active_link('/admin/profile/election', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-user"></i>
      <span>Election Date</span>
    </a>
    <a href="/admin/profile/organization" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 hover:text-white transition <?= active_link('/admin/profile/organization', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-users"></i>
      <span>Organizations</span>
    </a>
    <a href="/admin/profile/position" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 hover:text-white transition <?= active_link('/admin/profile/position', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-sign-out"></i>
      <span>Positions</span>
    </a>
    <a href="/admin/profile/officers" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-700 hover:text-white transition <?= active_link('/admin/profile/officers', $url) ? 'bg-white text-green-700' : '' ?>">
      <i class="fa fa-sign-out"></i>
      <span>Officers</span>
    </a>
  </nav>
</aside>
<!-- Toggle Button -->
<button id="sidebarToggleBtn" class="hidden md:block fixed top-1/2 left-0 z-50 transform -translate-y-1/2 translate-x-0 sidebar-toggle-btn sidebar-btn-visible bg-green-700 hover:bg-green-800 text-white rounded-full p-2 shadow-lg transition-all duration-500 ease-in-out">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path id="sidebarToggleIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
  </svg>
</button>
<?php
$url = esc($_SERVER['REQUEST_URI']);
if (strpos($url, 'admin/profile/election') !== false) {
  echo view('admin/profile_election');
} else if (strpos($url, 'admin/profile/organization') !== false) {
  echo view('admin/profile_organization');
} else if (strpos($url, 'admin/profile/position') !== false) {
  echo view('admin/profile_position');
} else if (strpos($url, 'admin/profile/officers') !== false) {
  echo view('admin/profile_officers');
} else if (strpos($url, 'admin/profile') !== false) {
  echo view('admin/admin_profile');
} else {
  echo view('admin/profile');
}
?>

<?= $this->endSection() ?>