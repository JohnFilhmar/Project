<dialog id="addStudentModal" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">
  <?php helper('form'); ?>
  <?= form_open('students/create', [
    'id' => 'addStudentForm',
    'class' => 'grid grid-cols-1 md:grid-cols-2 gap-2 space-y-4 p-6',
    'enctype' => 'multipart/form-data'
  ]) ?>

  <?= form_label('Add New Student', 'title', ['id' => 'studentFormTitle', 'class' => 'md:col-span-2 text-2xl font-bold text-center mb-4 border-b-2 border-green-500 w-full']) ?>

  <div>
    <?= form_label('Student No.', 'student_number', ['class' => 'block text-sm font-medium']) ?>
    <?= form_input('student_number', '', [
      'id' => 'student_number',
      'name' => 'student_number',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required',
      'pattern' => '\d{2}-\d{5}',
      'title' => 'Format: nn-nnnnn (e.g., 12-34567)'
    ]) ?>
  </div>

  <div>
    <?= form_label('First Name', 'first_name', ['class' => 'block text-sm font-medium']) ?>
    <?= form_input('first_name', '', [
      'id' => 'first_name',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required'
    ]) ?>
  </div>

  <div>
    <?= form_label('Middle Name', 'middle_name', ['class' => 'block text-sm font-medium']) ?>
    <?= form_input('middle_name', '', [
      'id' => 'middle_name',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105'
    ]) ?>
  </div>

  <div>
    <?= form_label('Last Name', 'last_name', ['class' => 'block text-sm font-medium']) ?>
    <?= form_input('last_name', '', [
      'id' => 'last_name',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required'
    ]) ?>
  </div>

  <div>
    <?= form_label('Sex', 'sex', ['class' => 'block text-sm font-medium']) ?>
    <?= form_dropdown('sex', [
      '' => 'Select Sex',
      'male' => 'Male',
      'female' => 'Female'
    ], '', [
      'id' => 'sex',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required'
    ]) ?>
  </div>

  <div>
    <?= form_label('Course', 'course', ['class' => 'block text-sm font-medium']) ?>
    <?= form_input('course', '', [
      'id' => 'course',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required'
    ]) ?>
  </div>

  <div>
    <?= form_label('Year Level', 'year_level', ['class' => 'block text-sm font-medium']) ?>
    <?= form_dropdown('year_level', [
      '' => 'Select Year Level',
      '1' => '1st Year',
      '2' => '2nd Year',
      '3' => '3rd Year',
      '4' => '4th Year'
    ], '', [
      'id' => 'year_level',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required'
    ]) ?>
  </div>

  <div>
    <?= form_label('Email', 'email', ['class' => 'block text-sm font-medium']) ?>
    <?= form_input('email', '', [
      'id' => 'email',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required',
      'type' => 'email'
    ]) ?>
  </div>

  <div class="md:col-span-2" id="organizationDropdown">
    <label for="organization_id" class="font-semibold mb-1 block">Organization:</label>
    <select id="organization_id" name="organization_id" class="form-control px-4 py-2 rounded-md w-full border" required>
      <option value="">-- Select Organization --</option>
    </select>
  </div>

  <div class="md:col-span-2 flex items-center gap-2">
    <?= form_label('Student Image', 'image_file', ['class' => 'block text-sm font-medium']) ?>
    <?= form_upload('image_file', '', [
      'id' => 'image_file',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'accept' => 'image/*'
    ]) ?>
    <button type="button" id="removeImageFileBtn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded" style="display:none;" onclick="removeImageFile()">Remove</button>
  </div>

  <div class="md:col-span-2 w-full">
    <?= form_submit('submit', 'Submit', ['class' => 'w-full bg-green-600 text-white px-4 py-2 rounded']) ?>
  </div>
  <?= form_button([
    'type' => 'button',
    'class' => 'md:col-span-2 w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
    'content' => 'Cancel',
    'onclick' => "document.getElementById('addStudentModal').close();"
  ]) ?>
  <?= form_close() ?>
</dialog>