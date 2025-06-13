<dialog id="addAdminForm" class="rounded-lg shadow-lg p-0 w-full max-w-2xl mx-auto my-auto text-green-900">
  <?php helper('form'); ?>
  <?= form_open_multipart('admin/profile/users/add_admin', [
    'id' => 'addAdminForm',
    'class' => 'grid grid-cols-1 md:grid-cols-2 gap-2 w-full space-y-5 p-6'
  ]) ?>
    <div class="md:col-span-2">
      <h2 class="text-3xl font-bold text-green-800 mb-2 text-center">Create Admin Account</h2>
      <p class="text-gray-600 mb-6 text-center">Register a new admin account</p>
    </div>
    <div>
      <label for="first_name" class="block text-sm font-medium text-green-700 mb-1">First Name</label>
      <?= form_input([
        'type' => 'text',
        'id' => 'first_name',
        'name' => 'first_name',
        'required' => true,
        'autocomplete' => 'first_name',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'placeholder' => 'Enter first name'
      ]) ?>
    </div>
    <div>
      <label for="middle_name" class="block text-sm font-medium text-green-700 mb-1">Middle Name</label>
      <?= form_input([
        'type' => 'text',
        'id' => 'middle_name',
        'name' => 'middle_name',
        'autocomplete' => 'middle_name',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'placeholder' => 'Enter middle name'
      ]) ?>
    </div>
    <div>
      <label for="last_name" class="block text-sm font-medium text-green-700 mb-1">Last Name</label>
      <?= form_input([
        'type' => 'text',
        'id' => 'last_name',
        'name' => 'last_name',
        'required' => true,
        'autocomplete' => 'last_name',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'placeholder' => 'Enter last name'
      ]) ?>
    </div>
    <div>
      <label for="email" class="block text-sm font-medium text-green-700 mb-1">Email Address</label>
      <?= form_input([
        'type' => 'email',
        'id' => 'email',
        'name' => 'email',
        'required' => true,
        'autocomplete' => 'email',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'placeholder' => 'Enter email'
      ]) ?>
    </div>
    <div>
      <label for="password" class="block text-sm font-medium text-green-700 mb-1">Password</label>
      <div class="relative">
        <?= form_input([
          'type' => 'password',
          'id' => 'password',
          'name' => 'password',
          'required' => true,
          'autocomplete' => 'new-password',
          'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition pr-10',
          'placeholder' => 'Create a password'
        ]) ?>
        <button type="button" tabindex="-1" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-green-600 focus:outline-none" onclick="togglePassword()">
          <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
        </button>
      </div>
    </div>
    <div>
      <label for="password_confirm" class="block text-sm font-medium text-green-700 mb-1">Confirm Password</label>
      <div class="relative">
        <?= form_input([
          'type' => 'password',
          'id' => 'password_confirm',
          'name' => 'password_confirm',
          'required' => true,
          'autocomplete' => 'new-password',
          'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition pr-10',
          'placeholder' => 'Confirm password'
        ]) ?>
        <button type="button" tabindex="-1" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-green-600 focus:outline-none" onclick="togglePasswordConfirm()">
          <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
        </button>
      </div>
    </div>
    <div>
      <label for="image_url" class="block text-sm font-medium text-green-700 mb-1 mt-3">Profile Image</label>
      <?= form_upload([
        'id' => 'image_url',
        'name' => 'image_url',
        'accept' => 'image/*',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition'
      ]) ?>
    </div>
    <div>
      <label for="organization" class="block text-sm font-medium text-green-700 mb-1 mt-3">Organization</label>
      <select id="organization" name="organization" required class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition">
        <option value="">Select organization</option>
      </select>
    </div>
    <div class="md:col-span-2 w-full mt-4">
      <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-lg shadow transition">Register Admin</button>
    </div>
    <button
      type="button"
      class="md:col-span-2 w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mt-2"
      onclick="document.getElementById('addAdminForm').close();">Cancel</button>
  <?= form_close() ?>
  <script>
    function togglePassword() {
      const pwd = document.getElementById('password');
      const icon = document.getElementById('eyeIcon');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m1.414-1.414A9.956 9.956 0 0112 5c4.478 0 8.268-2.943 9.542 7a9.956 9.956 0 01-4.043 5.197M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
      } else {
        pwd.type = 'password';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268-2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
      }
    }
    function togglePasswordConfirm() {
      const pwd = document.getElementById('password_confirm');
      const icon = document.getElementById('eyeIconConfirm');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m1.414-1.414A9.956 9.956 0 0112 5c4.478 0 8.268-2.943 9.542 7a9.956 9.956 0 01-4.043 5.197M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
      } else {
        pwd.type = 'password';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268-2.943 9.542-7z" />`;
      }
    }
    // Fetch organizations and populate dropdown
    document.addEventListener('DOMContentLoaded', function() {
      fetch('/admin/profile/organization/retrieve_organizations')
        .then(response => response.json())
        .then(data => {
          const orgSelect = document.getElementById('organization');
          if (data.organizations && Array.isArray(data.organizations)) {
            data.organizations.forEach(org => {
              const option = document.createElement('option');
              option.value = org;
              option.textContent = org;
              orgSelect.appendChild(option);
            });
          }
        });
    });
  </script>
</dialog>
