<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold my-6 md:my-8 lg:my-10">Ongoing Campaigns</h1>
<p class="text-base text-gray-700 italic mb-8 max-w-2xl mx-auto bg-yellow-50 rounded-lg shadow-md p-6 tracking-in-expand duration-700">
  Explore ongoing campaigns and learn more about each partylist's goals and objectives.
</p>

<div class="mt-4 w-full max-w-9xl mx-auto">

  <?php if (!empty($campaigns) && is_array($campaigns)): ?>
    <div class="swiper campaigns-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($campaigns as $campaign): ?>
          <div class="swiper-slide">
            <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
              <img class="w-full h-80 object-cover" src="<?= !empty($campaign['image']) ? esc($campaign['image']) : '/no-image.png' ?>" alt="<?= esc($campaign['title']) ?>">
              <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2"><?= esc($campaign['title']) ?></div>
                <p class="text-gray-700 text-base mb-2">
                  <?= esc($campaign['details']) ?>
                </p>
                <div class="text-sm text-gray-500 italic">
                  Partylist: <?= esc($campaign['partylist']) ?> <br>
                  Added: <?= date('M d, Y', strtotime($campaign['date_added'])) ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php else: ?>
    <div class="text-center text-gray-500 py-8">
      No campaigns found.
    </div>
  <?php endif; ?>

</div>

<?= $this->endSection() ?>