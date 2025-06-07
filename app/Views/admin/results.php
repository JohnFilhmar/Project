<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Partial Live Results For</p>
<p class="text-base md:text-xl lg:text-2xl font-semibold">As of June 7, 2025, 9:00am</p>
<div class="mt-6 self-justify-end flex justify-between items-center gap-2 self-end">
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('printWinners').showModal();">
    <p>Print Winners</p>
  </button>
  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('printResults').showModal();">
    <p>Print Results</p>
  </button>
</div>
<div class="self-start flex flex-col justify-start items-start gap-2 text-white font-bold text-lg mb-6">
  <p class="text-green-900 text-xl font-extrabold">Election Results for:</p>
  <?=
  helper('form');
  echo form_dropdown(
    'organization',
    [
      'option1' => 'Organization 1',
      'option2' => 'Organization 2',
      'option3' => 'Organization 3'
    ],
    'option1',
    [
      'id' => 'organization',
      'class' => 'appearance-none rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 transition bg-green-600', // added appearance-none
      'onchange' => "window.location.href='/admin/results/' + this.value"
    ]
  );
  ?>
</div>
<div class="flex flex-wrap justify-center gap-6 w-full">
  <?php
  // Example positions and sample results
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
  $gradientColors = [
    0   => '#ef4444',
    10  => '#f59e42',
    25  => '#facc15',
    50  => '#22c55e',
    100 => '#3b82f6',
  ];
  if (!function_exists('getGradientColor')) {
    function getGradientColor($index, $total, $colors) {
      $stops = array_keys($colors);
      $segments = count($stops) - 1;
      $percent = ($index / $total) * 100;
      for ($i = 0; $i < $segments; $i++) {
        if ($percent >= $stops[$i] && $percent <= $stops[$i+1]) {
          $start = $stops[$i];
          $end = $stops[$i+1];
          $startColor = $colors[$start];
          $endColor = $colors[$end];
          $ratio = ($percent - $start) / ($end - $start);
          $sc = sscanf($startColor, "#%02x%02x%02x");
          $ec = sscanf($endColor, "#%02x%02x%02x");
          $r = round($sc[0] + ($ec[0] - $sc[0]) * $ratio);
          $g = round($sc[1] + ($ec[1] - $sc[1]) * $ratio);
          $b = round($sc[2] + ($ec[2] - $sc[2]) * $ratio);
          return sprintf("#%02x%02x%02x", $r, $g, $b);
        }
      }
      return $colors[100];
    }
  }
  foreach ($positions as $position => $candidates): ?>
    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center max-w-xs w-full min-w-[220px] border-2 border-green-400 hover:shadow-xl transition-shadow duration-300 ease-in-out">
      <h3 class="text-xl font-bold text-green-700 mb-4"><?= esc($position) ?></h3>
      <ul class="w-full flex justify-between flex-col gap-2">
        <?php foreach ($candidates as $candidate): ?>
          <li class="flex justify-between items-center py-1 border-b last:border-b-0">
            <span class="font-medium"><?= esc($candidate['name']) ?></span>
            <span class="font-bold text-green-600"><?= esc($candidate['votes']) ?></span>
          </li>
          <div>
            <?php
            $percent = isset($candidate['percent']) ? $candidate['percent'] : 0;
            $totalBoxes = 100;
            $filledBoxes = round($percent);
            $emptyBoxes = $totalBoxes - $filledBoxes;
            ?>
            <div class="flex items-center gap-[1px]">
              <?php for ($i = 0; $i < $filledBoxes; $i++): ?>
              <?php $color = getGradientColor($i, $totalBoxes, $gradientColors); ?>
              <span class="inline-block w-1 h-3 rounded" style="background: <?= esc($color) ?>"></span>
              <?php endfor; ?>
              <?php for ($i = 0; $i < $emptyBoxes; $i++): ?>
              <span class="inline-block w-1 h-3 bg-gray-200 rounded"></span>
              <?php endfor; ?>
            </div>
            <span class="ml-2 text-xs text-gray-500"><?= esc($percent) ?>%</span>
          </div>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endforeach; ?>
</div>

<?= $this->endSection() ?>