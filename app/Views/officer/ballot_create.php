<dialog id="createBallotModal" class="rounded-lg shadow-lg p-0 w-full max-w-4xl mx-auto my-auto text-green-900">

<?php
helper('form');

echo form_open('/officer/ballots/create', [
  'id' => 'createBallotForm',
  'class' => 'bg-white rounded-lg p-6 flex flex-col gap-4',
]);
?>

<span class="text-2xl font-bold mb-4 border-b-2 border-green-500 block">Ballot Creation</span>

<button type="button" id="checkAllBtn" class="self-end mb-4 bg-green-200 hover:bg-green-300 text-green-900 font-semibold py-1 px-3 rounded-md w-fit">Check All</button>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mb-4">
  <?php
  $checkboxIndex = 0;
  foreach ($candidates as $position => $cands): ?>
    <div class="flex flex-col items-start justify-center gap-2 mb-3 border-2 border-green-500">
      <div class="font-semibold text-green-700 py-1 px-2 w-full text-start border-b-2 border-green-500 ">
        <p>For <?= esc($position) ?></p>
      </div>
      <?php foreach ($cands as $candidate):
        $checkboxId = 'candidate_' . $checkboxIndex++;
      ?>
        <div class="flex items-center mb-2 ml-4">
          <?= form_checkbox('candidates[]', $candidate['candidate_id'] . '|' . $position, false, [
            'id' => $checkboxId,
            'class' => 'accent-green-600 w-4 h-4 rounded border-green-300 focus:ring-green-500'
          ]) ?>
          <div class="flex flex-col">
            <?= form_label($candidate['name'], $checkboxId, ['class' => 'ml-2 font-semibold text-green-900']) ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>

<?= form_button([
  'type' => 'submit',
  'class' => 'bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded',
  'content' => 'Create Ballot'
]) ?>
<?= form_button([
  'type' => 'button',
  'class' => 'bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
  'content' => 'Cancel',
  'onclick' => "document.getElementById('createBallotModal').close();"
]) ?>
<?= form_close() ?>

<script>
  document.getElementById('checkAllBtn').addEventListener('click', function() {
    document.querySelectorAll('#createBallotForm input[type="checkbox"]').forEach(function(cb) {
      cb.checked = true;
    });
  });
</script>

</dialog>