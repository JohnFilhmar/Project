<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5"><?php if(esc(session()->get('role')) == 'officer'):?><?= esc(session()->get('organization')) ?><?php endif; ?> Candidates List</p>
<p class="text-base md:text-xl lg:text-2xl font-semibold">View all candidates for the upcoming elections.</p>

<?php if (session()->get('role') === 'officer') : ?>
  <div class="flex flex-row items-center gap-2 w-full justify-end">
    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out my-5"
      onclick="document.getElementById('importCandidatesModal').showModal();">
      <p>Import Candidates</p>
    </button>
    <button id="createBallotBtn" disabled
      class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out my-5 disabled:bg-green-200 disabled:text-green-600 disabled:cursor-not-allowed"
      onclick="document.getElementById('createBallotModal').showModal();">
      <p>Create New Ballot</p>
    </button>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
      fetch('/has_election')
        .then(response => response.json())
        .then(data => {
        const btn = document.getElementById('createBallotBtn');
        const msg = document.getElementById('noElectionMsg');
        if (!data.hasSchedule) {
          btn.disabled = true;
          btn.textContent = "Election schedule has not been set";
        } else {
          btn.disabled = false;
          btn.textContent = "Create New Ballot";
        }
        });
      });
    </script>
  </div>

<?php
  // Group candidates by position, keeping only full_name
  $candidates = [];
  foreach ($candidateLists as $candidate) {
    $position = $candidate['position'];
    $candidates[$position][] = ['name' => $candidate['full_name'], 'candidate_id' => $candidate['candidate_id']];
  }
  echo view('officer/ballot_create', [
    'candidates' => $candidates,
  ]);
  echo view('officer/candidates_import');
endif;
?>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="candidatesTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Photo</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Position</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Campaign Message</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Alyas</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Partylist</th>
        <?php if (session()->get('role') === 'admin') : ?>
          <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Action</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php $n = 1;
      foreach ($candidateLists as $candidate): ?>
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-2 text-center">
            <img
              src="<?= !empty($candidate['image_url']) ? esc($candidate['image_url']) : '/no-image.png' ?>"
              alt="<?= esc($candidate['full_name']) ?>"
              class="w-12 h-12 object-cover rounded-full mx-auto">
          </td>
          <td class="px-4 py-2"><?= esc($candidate['full_name']) ?></td>
          <td class="px-4 py-2"><?= esc($candidate['position']) ?></td>
          <td class="px-4 py-2"><?= esc($candidate['campaign_message']) ?></td>
          <td class="px-4 py-2"><?= esc($candidate['alyas']) ?></td>
          <td class="px-4 py-2 italic text-gray-600"><?= esc($candidate['partylist']) ?></td>
          <?php if (session()->get('role') === 'admin') : ?>
            <td class="px-4 py-2 text-center space-x-2">
              <form action="<?= site_url('candidate/disqualify_candidate/' . $candidate['candidate_id']) ?>" method="post" class="inline-block" onsubmit="return confirm('Are you sure you want to disqualify this candidate?');">
                <?= csrf_field() ?>
                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs font-semibold">Disqualify</button>
              </form>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>