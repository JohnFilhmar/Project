<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5 text-center">Ballot & Election Lists</p>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
  <?php if (empty($elections)): ?>
    <div class="col-span-full text-center text-gray-500 text-lg py-12">
      No elections ongoing or ballots found.
    </div>
  <?php else: ?>
    <?php foreach ($elections as $election): ?>
      <div class="bg-white shadow-lg rounded-xl p-6 border border-green-200 hover:shadow-2xl transition duration-200">
        <h2 class="text-2xl font-bold mb-1 text-green-800 flex items-center gap-2">
          <span><?= htmlspecialchars($election['title']) ?></span>
          <span class="ml-2 px-2 py-1 rounded text-xs font-semibold <?= $election['status'] === 'Ongoing' ? 'bg-green-100 text-green-700' : ($election['status'] === 'Upcoming' ? 'bg-blue-100 text-blue-700' : 'bg-gray-200 text-gray-600') ?>">
            <?= $election['status'] ?>
          </span>
        </h2>
        <p class="text-green-700 font-semibold mb-2">Organization: <?= htmlspecialchars($election['organization_name']) ?></p>
        <div class="mb-2 text-sm">
          <span class="font-semibold">Start:</span>
          <?= date('F j, Y, g:i a', strtotime($election['start_date'] . ' ' . $election['start_time'])) ?><br>
          <span class="font-semibold">End:</span>
          <?= date('F j, Y, g:i a', strtotime($election['end_date'] . ' ' . $election['end_time'])) ?>
        </div>
        <div class="flex flex-row gap-4 mt-2 text-sm">
          <span class="bg-green-50 px-3 py-1 rounded font-semibold"># Positions: <span class="text-green-700 font-bold"><?= $election['positions_count'] ?></span></span>
          <span class="bg-blue-50 px-3 py-1 rounded font-semibold"># Candidates: <span class="text-blue-700 font-bold"><?= $election['candidates_count'] ?></span></span>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>