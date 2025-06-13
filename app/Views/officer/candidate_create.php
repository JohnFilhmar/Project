<dialog id="applyCandidateModal" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">
<?php helper('form'); ?>
<?= form_open_multipart('candidate/candidate_create/' . esc($student_id), [
  'id' => 'createCandidateForm',
  'class' => 'grid grid-cols-1 md:grid-cols-2 gap-2 space-y-4 p-6 bg-white rounded-lg',
]) ?>

<?= form_label('Apply as Candidate', 'candidateFormTitle', [
  'id' => 'candidateFormTitle',
  'class' => 'md:col-span-2 text-2xl font-bold text-center mb-4 border-b-2 border-green-500 w-full'
]) ?>

<div>
  <?= form_label('Allias', 'alyas', ['class' => 'block text-sm font-medium']) ?>
  <?= form_input([
    'type' => 'text',
    'name' => 'alyas',
    'id' => 'alyas',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => true
  ]) ?>
</div>

<div>
  <?= form_label('Position', 'position', ['class' => 'block text-sm font-medium']) ?>
  <?= form_input([
    'type' => 'text',
    'name' => 'position',
    'id' => 'position',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => true
  ]) ?>
</div>

<div class="md:col-span-2">
  <?= form_label('Campaign Message', 'campaign_message', ['class' => 'block text-sm font-medium']) ?>
  <?= form_textarea([
    'name' => 'campaign_message',
    'id' => 'campaign_message',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'rows' => 4,
    'placeholder' => 'Enter your campaign message...',
    'required' => true
  ]) ?>
</div>

<div class="md:col-span-2">
  <?= form_label('Partylist', 'partylist', ['class' => 'block text-sm font-medium']) ?>
  <?= form_input([
    'type' => 'text',
    'name' => 'partylist',
    'id' => 'partylist',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105'
  ]) ?>
</div>

<div class="md:col-span-2 flex items-center gap-2">
  <?= form_label('Candidate Image', 'image_file', ['class' => 'block text-sm font-medium']) ?>
  <?= form_upload('image_file', '', [
    'id' => 'image_file',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'accept' => 'image/*'
  ]) ?>
  <button type="button" id="removeImageFileBtn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded" style="display:none;" onclick="removeImageFile()">Remove</button>
</div>

<div class="md:col-span-2 w-full flex flex-col gap-2">
  <?= form_submit('submit', 'Create', ['class' => 'w-full bg-green-600 text-white px-4 py-2 rounded']) ?>
  <?= form_button([
    'type' => 'button',
    'class' => 'w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
    'content' => 'Cancel',
    'onclick' => "document.getElementById('applyCandidateModal').close();"
  ]) ?>
</div>

<?= form_close() ?>
</dialog>