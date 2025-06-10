<dialog id="addPositionForm" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">
  <?php

  helper('form');

  echo form_open('admin/add_position', ['id' => 'addPositionForm', 'class' => 'space-y-4 p-6']);

  echo form_label('Add a New Position', 'title', ['class' => 'text-2xl font-bold text-center mb-10 border-b-2 border-green-500 w-full']);
  echo form_input([
    'name' => 'title',
    'id' => 'title',
    'class' => 'hidden',
    'required' => false
  ]);

  echo '<div>';
  echo form_label('Position', 'position', ['class' => 'block text-sm font-medium']);
  echo form_input('position', '', [
    'type' => 'text',
    'id' => 'position',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => 'required'
  ]);
  echo '</div>';

  echo '<div class="w-full">';
  echo form_submit('submit', 'Submit', ['class' => 'w-full bg-green-600 text-white px-4 py-2 rounded']);
  echo '</div>';
  echo form_button([
    'type' => 'button',
    'class' => 'w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
    'content' => 'Cancel',
    'onclick' => "document.getElementById('addPositionForm').close();"
  ]);
  echo form_close();

  ?>
</dialog>