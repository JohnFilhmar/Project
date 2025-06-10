<dialog id="addOfficerForm" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">
  <?php

  helper('form');

  echo form_open('admin/add_officer', ['id' => 'addOfficerForm', 'class' => 'grid grid-cols-1 md:grid-cols-2 gap-2 space-y-4 p-6']);

  echo form_label('Add New Officer', 'title', ['class' => 'md:col-span-2 text-2xl font-bold text-center mb-4 border-b-2 border-green-500 w-full']);
  echo form_input([
    'name' => 'title',
    'id' => 'title',
    'class' => 'hidden',
    'required' => false
  ]);

  echo '<div>';
  echo form_label('Student No.', 'student_no', ['class' => 'col-span-2 block text-sm font-medium']);
  echo form_input('student_no', '', [
    'id' => 'student_no',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => 'required'
  ]);
  echo '</div>';

  echo '<div>';
  echo form_label('First Name', 'first_name', ['class' => 'block text-sm font-medium']);
  echo form_input('first_name', '', [
    'id' => 'first_name',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => 'required'
  ]);
  echo '</div>';

  echo '<div>';
  echo form_label('Middle Name', 'middle_name', ['class' => 'block text-sm font-medium']);
  echo form_input('middle_name', '', [
    'id' => 'middle_name',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105'
  ]);
  echo '</div>';

  echo '<div>';
  echo form_label('Last Name', 'last_name', ['class' => 'block text-sm font-medium']);
  echo form_input('last_name', '', [
    'id' => 'last_name',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => 'required'
  ]);
  echo '</div>';

  echo '<div>';
  echo form_label('Organization', 'organization', ['class' => 'block text-sm font-medium']);
  echo form_dropdown('organization', [
    '' => 'Select Organization',
    'Org1' => 'Organization 1',
    'Org2' => 'Organization 2',
    'Org3' => 'Organization 3'
  ], '', [
    'id' => 'organization',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => 'required'
  ]);
  echo '</div>';

  echo '<div>';
  echo form_label('Email', 'email', ['class' => 'block text-sm font-medium']);
  echo form_input('email', '', [
    'id' => 'email',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'required' => 'required',
    'type' => 'email'
  ]);
  echo '</div>';

  echo '<div class="md:col-span-2">';
  echo form_label('Upload Officer Photo', 'officer_photo', ['class' => 'block text-sm font-medium']);
  echo form_upload('officer_photo', '', [
    'id' => 'officer_photo',
    'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
    'accept' => 'image/*'
  ]);
  echo '</div>';

  echo '<div class="md:col-span-2 w-full">';
  echo form_submit('submit', 'Add Officer', ['class' => 'w-full bg-green-600 text-white px-4 py-2 rounded']);
  echo '</div>';
  echo form_button([
    'type' => 'button',
    'class' => 'md:col-span-2 w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
    'content' => 'Cancel',
    'onclick' => "document.getElementById('addOfficerForm').close();"
  ]);
  echo form_close();

  ?>
</dialog>