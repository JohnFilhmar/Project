<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('partials/head') ?>
</head>

<body>
  <div class="container mx-auto min-h-screen flex justify-center items-center">
    <div class="bg-green-200 rounded-2xl shadow-xl p-10 w-full max-w-3xl flex flex-col items-center">
      <img src="/logo.jpg" alt="Prince of Peace College Logo" class="w-24 h-24 mb-6 rounded-full shadow-md bg-white p-2">
      <h1 class="text-4xl font-bold text-green-800 mb-2 text-center">Prince of Peace College Election</h1>
      <p class="text-gray-700 mb-6 text-center">Your vote matters! Join the election process by getting started below.</p>
      <a href="/login" class="mb-8">
        <button class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow transition duration-200 text-lg">
          Login
        </button>
      </a>

      <!-- NEED TO FIX CAROUSEL -->
      <div class="w-full max-w-2xl mb-8">
        <div class="swiper home-campaigns">
          <div class="swiper-wrapper">
            <?php foreach ($campaigns as $campaign): ?>
              <div class="swiper-slide">
                <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
                  <?php if (!empty($campaign['image']) && file_exists(FCPATH . ltrim($campaign['image'], '/'))): ?>
                    <img class="w-full h-80 object-cover" src="<?= esc($campaign['image']) ?>" alt="<?= esc($campaign['title']) ?>">
                  <?php else: ?>
                    <img class="w-full h-80 object-cover" src="/no-image.png" alt="No Image">
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <footer class="text-gray-600 text-sm mt-4 text-center">
          Supreme Student Council and Organizations. &copy;<?= date('Y') ?>
        </footer>
      </div>
    </div>
  </div>
  <?= view('partials/footer') ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const swiper = new Swiper('.home-campaigns', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    });
  </script>
</body>

</html>