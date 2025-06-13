<dialog id="importCandidatesModal" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">

  <?php

  helper('form');

  echo form_open('/import_candidates', [
    'id' => 'createBallotForm',
    'class' => 'bg-white rounded-lg p-6 flex flex-col gap-4',
  ]);
  echo '<span class="text-2xl font-bold mb-4 border-b-2 border-green-500 block">Import Candidates</span>';
  echo '<div class="mb-4">';
  echo form_label('Select CSV File', 'csvFile', ['class' => 'block text-lg font-bold text-green-700 mb-2']);
  echo form_upload('csvFile', '', [
    'id' => 'csvFile',
    'class' => 'py-1 px-2 block w-full text-base text-green-900 border border-green-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500',
    'accept' => '.csv',
    'required' => true
  ]);
  echo '</div>';
  echo form_button([
    'type' => 'submit',
    'class' => 'bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded',
    'content' => 'Import Candidates'
  ]);
  echo form_button([
    'type' => 'button',
    'class' => 'bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
    'content' => 'Cancel',
    'onclick' => "document.getElementById('importCandidatesModal').close();"
  ]);
  echo form_close();
  
  ?>
</dialog>