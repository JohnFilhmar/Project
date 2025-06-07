<!DOCTYPE html>
<html lang="en">
<head>
  <?= view('partials/head') ?>
</head>
<body>
  <div class="relative flex flex-col min-h-screen text-green-900">
    <?= view('partials/headers') ?>
    <main class="min-h-screen overflow-y-auto p-4 pt-20 md:pt-25 lg:pt-30 main-bg">
      <div class="flex flex-col items-center justify-center h-full w-full text-center">
        <?= $this->renderSection('content') ?>
      </div>
    </main>
    <?= view('partials/footer') ?>
  </div>
</body>
</html>
