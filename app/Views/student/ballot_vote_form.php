<?php
helper('form');
?>

<dialog id="ballotVoteModal" class="rounded-lg shadow-lg p-0 w-full max-w-4xl mx-auto my-auto text-green-900">
  <div class="bg-white rounded-lg shadow-lg w-full p-8 m-0 max-h-[80vh] overflow-y-auto">
    <button type="button" id="closeBallotModalBtn" onclick="toggleBallotModal('close')" class="absolute top-3 right-3 text-gray-400 hover:text-red-600 text-2xl font-bold focus:outline-none" aria-label="Close">&times;</button>
    <h2 class="text-2xl font-semibold text-center text-green-700 mb-6 border-b-2 border-green-500 pb-2">Ballot Creation</h2>
    <?= form_open('student/submit_votes', ['class' => 'flex flex-col justify-center items-center gap-2']) ?>
    <div class="flex flex-wrap gap-2 justify-start items-start w-full">
      <?php foreach ($candidates as $position => $list): ?>
        <div class="border border-green-500 rounded-md p-4 max-w-lg">
          <div class="font-semibold text-green-700 mb-2"><?= esc("For $position") ?></div>
          <div class="space-y-2">
            <?php foreach ($list as $candidate): ?>
              <label class="flex items-center space-x-2">
                <input
                  type="checkbox"
                  name="votes[<?= esc($position) ?>][]"
                  value="<?= esc($candidate['id']) ?>"
                  class="form-checkbox h-5 w-5 text-green-600 border-green-400 focus:ring-green-500">
                <span class="text-gray-800"><?= esc($candidate['name']) ?></span>
              </label>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="self-end text-nowrap mt-8 flex items-center gap-3">
      <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-1 px-2 rounded transition">Submit Votes</button>
      <a href="<?= site_url('dashboard') ?>" class="w-full block text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1 px-2 rounded transition" onclick="toggleBallotModal('close'); return false;">Cancel</a>
    </div>
    <?= form_close() ?>
  </div>
</dialog>