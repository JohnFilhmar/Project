<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<?php if (session()->get('role') == 'student'): ?>
  <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold my-4">We Lead, We Educate, We Make Believers Be</h1>
  <h1 class="text-lg md:text-xl lg:text-2xl font-bold"><?= session()->get('organization'); ?> Assemble!!!</h1>
  <div id="election-countdown-container" class="my-8 flex flex-col items-center justify-center"></div>
  <script>
    document.addEventListener('DOMContentLoaded', async function () {
      try {
        const res = await fetch('/has_election');
        const data = await res.json();

        if (data.hasSchedule && data.schedule) {
          const s = data.schedule;
          const startDateTime = new Date(`${s.start_date}T${s.start_time}`);
          const endDateTime = new Date(`${s.end_date}T${s.end_time}`);
          const now = new Date();

          let countdownTo = now < startDateTime ? startDateTime : endDateTime;
          let countdownLabel = now < startDateTime ? 'Election starts in:' : 'Election ends in:';

          if (now < endDateTime) {
            const container = document.getElementById('election-countdown-container');
            container.innerHTML = `
              <div class="w-full max-w-md bg-white/80 backdrop-blur-md border border-green-200 rounded-2xl shadow-xl px-8 py-7 flex flex-col items-center gap-2 animate-fade-in">
                <h2 class="text-2xl md:text-3xl font-extrabold text-green-900 mb-1 tracking-tight">${s.title}</h2>
                <p class="text-base text-green-700 font-semibold mb-1">${s.semester}</p>
                <p class="text-xs text-gray-500 mb-4">From <span class="font-bold">${s.start_date} ${s.start_time}</span> to <span class="font-bold">${s.end_date} ${s.end_time}</span></p>
                <div class="text-base md:text-lg font-bold text-green-800 mb-2 countdown-label">${countdownLabel}</div>
                <div id="election-countdown" class="flex gap-4 justify-center items-center"></div>
              </div>
            `;

            function updateCountdown() {
              const now = new Date();
              let distance = countdownTo - now;
              if (distance < 0) {
                // Switch to end countdown if election just started
                if (countdownTo === startDateTime && now < endDateTime) {
                  countdownTo = endDateTime;
                  countdownLabel = 'Election ends in:';
                  container.querySelector('.countdown-label').textContent = countdownLabel;
                  distance = countdownTo - now;
                } else {
                  container.querySelector('#election-countdown').innerHTML = `<span class="text-green-700 font-bold text-lg">Election ended</span>`;
                  clearInterval(timer);
                  return;
                }
              }
              const days = Math.floor(distance / (1000 * 60 * 60 * 24));
              const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              const seconds = Math.floor((distance % (1000 * 60)) / 1000);

              container.querySelector('#election-countdown').innerHTML = `
                <div class="flex flex-col items-center">
                  <span class="text-3xl md:text-4xl font-extrabold text-green-800">${days}</span>
                  <span class="text-xs text-green-700 font-medium uppercase tracking-wider">Days</span>
                </div>
                <div class="flex flex-col items-center">
                  <span class="text-3xl md:text-4xl font-extrabold text-green-800">${hours}</span>
                  <span class="text-xs text-green-700 font-medium uppercase tracking-wider">Hours</span>
                </div>
                <div class="flex flex-col items-center">
                  <span class="text-3xl md:text-4xl font-extrabold text-green-800">${minutes}</span>
                  <span class="text-xs text-green-700 font-medium uppercase tracking-wider">Minutes</span>
                </div>
                <div class="flex flex-col items-center">
                  <span class="text-3xl md:text-4xl font-extrabold text-green-800">${seconds}</span>
                  <span class="text-xs text-green-700 font-medium uppercase tracking-wider">Seconds</span>
                </div>
              `;
            }

            updateCountdown();
            const timer = setInterval(updateCountdown, 1000);
          }
        }
      } catch (e) {
        // Optionally handle error
      }
    });
  </script>
<?php else: ?>
  <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold my-6 md:my-8 lg:my-10">Ongoing Campaigns</h1>
<?php endif; ?>
<p class="text-base text-gray-700 italic mb-8 max-w-2xl mx-auto bg-yellow-50 rounded-lg shadow-md p-6 tracking-in-expand duration-700">
  <?= session()->get('role') != 'student' ? "Explore ongoing campaigns and learn more about each partylist's goals and objectives." : "Got concerns or needs? Reach out to us directly here! The Supreme Student Council is just right here. PPCEANS, always remember that the SSC is your ally wherever and whenever you need us." ?>
</p>

<div class="mt-4 w-full max-w-9xl mx-auto">

  <?php if (!empty($campaigns) && is_array($campaigns)): ?>
    <div class="swiper campaigns-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($campaigns as $campaign): ?>
          <div class="swiper-slide">
            <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
              <img class="w-full h-80 object-cover" src="<?= !empty($campaign['image_url']) ? esc($campaign['image_url']) : '/no-image.png' ?>" alt="<?= esc($campaign['title']) ?>">
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