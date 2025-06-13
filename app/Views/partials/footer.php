<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php if (session()->has('notif-success')): ?>
  <div id="notification" class="fixed bottom-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-md z-50 transition-opacity duration-500 ease-in-out text-2xl">
    <?= session('notif-success') ?>
  </div>
<?php endif; ?>
<?php if (session()->has('notif-error')): ?>
  <div id="notification" class="fixed bottom-5 right-5 bg-red-600 text-white px-4 py-2 rounded shadow-md z-50 transition-opacity duration-500 ease-in-out text-2xl">
    <?= session('notif-error') ?>
  </div>
<?php endif; ?>