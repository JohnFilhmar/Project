<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Ballot Lists</p>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <?php foreach ($ballots as $ballot): ?>
    <div class="bg-white shadow rounded-lg p-6">
      <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($ballot['organization']) ?></h2>
      <p class="text-gray-600 text-sm">Created at: <?= date('F j, Y, g:i a', strtotime($ballot['created_at'])) ?></p>
    </div>
  <?php endforeach; ?>
</div>

<?= $this->endSection() ?>