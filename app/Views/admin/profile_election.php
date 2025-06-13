<?php
// Assuming CodeIgniter 4 with form helper loaded
helper('form');
?>

<div class="container max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-10 mt-10">
  <h2 class="text-center text-green-700 font-bold mb-9 tracking-wide text-2xl">
    Manage Election Date and Time
  </h2>
  <?= form_open('admin/profile/election/create', ['id' => 'electionForm']) ?>

  <div class="mb-4" id="organizationDropdown">
    <label for="organization_id" class="font-semibold mb-1 block">Organization:</label>
    <select id="organization_id" name="organization_id" class="form-control px-4 py-2 rounded-md w-full border" required>
      <option value="">-- Select Organization --</option>
    </select>
  </div>

  <div class="mb-4">
    <label for="title" class="font-semibold mb-1 block">Title of Election:</label>
    <?= form_input([
      'name' => 'title',
      'id' => 'title',
      'class' => 'form-control px-4 py-2 rounded-md w-full border',
      'placeholder' => 'Enter election title',
      'value' => isset($election['title']) ? esc($election['title']) : '',
      'required' => true
    ]) ?>
  </div>

  <div class="flex flex-col md:flex-row gap-4 mb-4">
    <div class="flex-1">
      <label for="start_date" class="font-semibold mb-1 block">Start Date:</label>
      <?= form_input([
        'type' => 'date',
        'name' => 'start_date',
        'id' => 'start_date',
        'class' => 'form-control px-4 py-2 rounded-md w-full border',
        'value' => isset($election['start_date']) ? esc($election['start_date']) : '',
        'required' => true
      ]) ?>
    </div>
    <div class="flex-1">
      <label for="start_time" class="font-semibold mb-1 block">Start Time:</label>
      <?= form_input([
        'type' => 'time',
        'name' => 'start_time',
        'id' => 'start_time',
        'class' => 'form-control px-4 py-2 rounded-md w-full border',
        'value' => isset($election['start_time']) ? esc($election['start_time']) : '',
        'required' => true
      ]) ?>
    </div>
  </div>

  <div class="flex flex-col md:flex-row gap-4 mb-4">
    <div class="flex-1">
      <label for="end_date" class="font-semibold mb-1 block">End Date:</label>
      <?= form_input([
        'type' => 'date',
        'name' => 'end_date',
        'id' => 'end_date',
        'class' => 'form-control px-4 py-2 rounded-md w-full border',
        'value' => isset($election['end_date']) ? esc($election['end_date']) : '',
        'required' => true
      ]) ?>
    </div>
    <div class="flex-1">
      <label for="end_time" class="font-semibold mb-1 block">End Time:</label>
      <?= form_input([
        'type' => 'time',
        'name' => 'end_time',
        'id' => 'end_time',
        'class' => 'form-control px-4 py-2 rounded-md w-full border',
        'value' => isset($election['end_time']) ? esc($election['end_time']) : '',
        'required' => true
      ]) ?>
    </div>
  </div>

  <div class="flex flex-col md:flex-row gap-4 mt-6">
    <div class="flex-1">
      <button id="submitElectionButton" type="submit" name="action" value="set" class="btn btn-success w-full bg-green-700 hover:bg-green-800 text-white rounded-lg py-3 font-semibold">
        Set Election Date and Time
      </button>
    </div>
  </div>
  <?= form_close() ?>
</div>