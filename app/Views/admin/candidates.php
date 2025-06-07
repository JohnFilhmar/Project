<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="flex flex-col items-center justify-center h-full w-full text-center">
  <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold my-6 md:my-8 lg:my-10">Candidates</h1>
  <p class="text-base text-gray-700 italic mb-8 max-w-2xl mx-auto bg-yellow-50 rounded-lg shadow-md p-6 tracking-in-expand duration-700">
    View and manage candidates for the upcoming elections. Ensure all candidates are registered and verified.
  </p>

  <div class="mt-4 w-full max-w-7xl mx-auto">
    <div class="swiper candidates-swiper">
      <?php
      $positions = [
        'Governor' => [
          ['name' => 'Alice Johnson', 'votes' => 120, 'percent' => 60],
          ['name' => 'Bob Smith', 'votes' => 95, 'percent' => 40],
        ],
        'Vice Governor Internal' => [
          ['name' => 'Carol Lee', 'votes' => 110, 'percent' => 55],
          ['name' => 'David Kim', 'votes' => 90, 'percent' => 45],
        ],
        'Vice Governor External' => [
          ['name' => 'Eve Adams', 'votes' => 130, 'percent' => 65],
          ['name' => 'Frank Wright', 'votes' => 70, 'percent' => 35],
        ],
        'Secretary' => [
          ['name' => 'Grace Lin', 'votes' => 140, 'percent' => 70],
          ['name' => 'Helen Cruz', 'votes' => 60, 'percent' => 30],
        ],
        'Treasurer' => [
          ['name' => 'Ian Torres', 'votes' => 125, 'percent' => 62],
          ['name' => 'Jake Evans', 'votes' => 75, 'percent' => 38],
        ],
        'Auditor 1' => [
          ['name' => 'Karen Young', 'votes' => 100, 'percent' => 50],
          ['name' => 'Leo Park', 'votes' => 100, 'percent' => 50],
        ],
        'Auditor 2' => [
          ['name' => 'Mona Diaz', 'votes' => 110, 'percent' => 55],
          ['name' => 'Nate Reed', 'votes' => 90, 'percent' => 45],
        ],
        'Peace Officer' => [
          ['name' => 'Olivia Fox', 'votes' => 135, 'percent' => 67],
          ['name' => 'Paul Grant', 'votes' => 65, 'percent' => 33],
        ],
        'Muse' => [
          ['name' => 'Quinn Lee', 'votes' => 120, 'percent' => 60],
          ['name' => 'Rita Chan', 'votes' => 80, 'percent' => 40],
        ],
        'Escort' => [
          ['name' => 'Sam Cruz', 'votes' => 140, 'percent' => 70],
          ['name' => 'Tom Yu', 'votes' => 60, 'percent' => 30],
        ],
      ];
      $candidateQuotes = [
        'Alice Johnson' => 'Dedicated to progress and unity.',
        'Bob Smith' => 'Committed to serving the people.',
        'Carol Lee' => 'Passionate about student welfare.',
        'David Kim' => 'Focused on inclusive leadership.',
        'Eve Adams' => 'Driven by innovation and results.',
        'Frank Wright' => 'Ready to make a difference.',
        'Grace Lin' => 'Organized for your success.',
        'Helen Cruz' => 'Your voice, your secretary.',
        'Ian Torres' => 'Transparency and trust in finance.',
        'Jake Evans' => 'Accountability at every step.',
        'Karen Young' => 'Ensuring fairness for all.',
        'Leo Park' => 'Integrity in every audit.',
        'Mona Diaz' => 'Committed to honest reporting.',
        'Nate Reed' => 'Your reliable auditor.',
        'Olivia Fox' => 'Peace and order above all.',
        'Paul Grant' => 'Safety is my priority.',
        'Quinn Lee' => 'Inspiring creativity and joy.',
        'Rita Chan' => 'Bringing grace to every event.',
        'Sam Cruz' => 'Leading with confidence.',
        'Tom Yu' => 'Supportive and dependable.',
      ];
      $candidatesList = [];
      foreach ($positions as $position => $candidates) {
        foreach ($candidates as $candidate) {
          $name = $candidate['name'];
          $candidatesList[] = [
            'name' => $name,
            'position' => $position,
            'image' => '/no-profile.png',
            'quote' => $candidateQuotes[$name] ?? '',
          ];
        }
      }
      ?>

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