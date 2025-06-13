<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="flex flex-col items-center justify-center min-h-[80vh] w-full">
  <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
    <div class="flex flex-col items-center">
      <img src="<?= base_url('/unauthorized.png') ?>" alt="Unauthorized" class="w-96 mb-5">
      <h1 class="text-3xl font-bold text-green-500 mb-2 flex items-center gap-2">
        <i class="bi bi-shield-lock text-2xl"></i>
        Unauthorized Access
      </h1>
      <p class="text-gray-700 mb-4 text-base">
        Sorry, you do not have permission to view this page.<br>
        If you believe this is an error, please contact your administrator.
      </p>
      <div class="mt-3 text-sm text-gray-500 flex items-center gap-1">
        <i class="bi bi-arrow-left-circle"></i>
        <a href="javascript:history.back()" class="text-green-500 underline hover:text-green-600">Go Back</a>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
