<dialog id="addOfficerForm" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">
  <?php
  helper('form');

  // Open form
  echo form_open('admin/profile/users/add_officer', [
    'id' => 'addOfficerForm',
    'class' => 'grid grid-cols-1 md:grid-cols-2 gap-2 space-y-4 p-6'
  ]);
  ?>
  <?=
  form_label(
    'Add another officer via their student number',
    'title',
    [
      'class' => 'md:col-span-2 text-2xl font-bold text-center mb-4 border-b-2 border-green-500 w-full'
    ]
  )
  ?>
  <?= form_hidden('title', '') ?>

  <div>
    <?= form_label('Student No.', 'student_number', ['class' => 'col-span-2 block text-sm font-medium']) ?>
    <?= form_input([
      'type' => 'text',
      'name' => 'student_number',
      'id' => 'student_number',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required'
    ])
    ?>
  </div>

  <div>
    <?= form_label('Password', 'password', ['class' => 'col-span-2 block text-sm font-medium']) ?>
    <?= form_password([
      'name' => 'password',
      'id' => 'password',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required'
    ])
    ?>
  </div>

  <div class="md:col-span-2 w-full">
    <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded">Add Officer</button>
  </div>
  <button
    type="button"
    class="md:col-span-2 w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded"
    onclick="document.getElementById('addOfficerForm').close();">Cancel</button>
  <?php echo form_close(); ?>
</dialog>