<dialog id="addCampaignModal" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">
  <?php

  helper('form');
  echo form_open('/campaigns/create', [
    'id' => 'addCampaignForm',
    'class' => 'bg-white rounded-lg p-6 flex flex-col gap-4',
    'enctype' => 'multipart/form-data'
  ]);
  echo form_label('Add New Campaign', 'title', ['id' => 'campaignFormTitle', 'class' => 'text-2xl font-bold text-center mb-4 border-b-2 border-green-500']);

  echo form_label('Partylist', 'partylist', ['class' => 'text-left font-semibold']);
  echo form_input([
    'name' => 'partylist',
    'id' => 'partylist',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => true
  ]);
  echo form_label('Campaign Name', 'campaign_name', ['class' => 'text-left font-semibold']);
  echo form_input([
    'name' => 'campaign_name',
    'id' => 'campaign_name',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => true
  ]);
  echo form_label('Description', 'description', ['class' => 'text-left font-semibold']);
  echo form_textarea([
    'name' => 'description',
    'id' => 'description',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'rows' => 3,
    'required' => true
  ]);
  echo form_label('Image URL', 'image_url', ['class' => 'text-left font-semibold']);
  echo form_input([
    'name' => 'image_url',
    'id' => 'image_url',
    'type' => 'url',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'oninput' => "toggleImageInputs()"
  ]);
  echo form_label('Image File', 'image_file', ['class' => 'text-left font-semibold']);
  echo '<div class="flex items-center gap-2">';
  echo form_upload([
    'name' => 'image_file',
    'id' => 'image_file',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => true,
    'accept' => 'image/*',
    'onchange' => "toggleImageInputs()"
  ]);
  echo '<button type="button" id="removeImageFileBtn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded" style="display:none;" onclick="removeImageFile()">Remove</button>';
  echo '</div>';
  ?>
  <?php
  echo form_button([
    'type' => 'submit',
    'class' => 'bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded',
    'content' => 'Submit'
  ]);
  echo form_button([
    'type' => 'button',
    'class' => 'bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
    'content' => 'Cancel',
    'onclick' => "document.getElementById('addCampaignModal').close();"
  ]);
  echo form_close();

  ?>
</dialog>