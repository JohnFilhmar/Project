<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="flex flex-col items-center justify-center h-full w-full text-center">
  <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold my-6 md:my-8 lg:my-10">Candidates</h1>
  <p class="text-base text-gray-700 italic mb-8 max-w-2xl mx-auto bg-yellow-50 rounded-lg shadow-md p-6 tracking-in-expand duration-700">
    View and manage candidates for the upcoming elections. Ensure all candidates are registered and verified.
  </p>

  <div class="mt-4 w-full max-w-7xl mx-auto">
    <div class="swiper candidates-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($candidatesList as $candidate): ?>
          <div class="swiper-slide">
            <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
              <img class="w-full h-80 object-cover" src="<?= esc($candidate['image']) ?>" alt="Candidate Photo">
              <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2"><?= esc($candidate['name']) ?></div>
                <div class="text-sm text-gray-500 mb-1"><?= esc($candidate['position']) ?></div>
                <p class="text-gray-700 text-base italic"><?= esc($candidate['quote']) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="mt-10">
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>

  <?= $this->endSection() ?>