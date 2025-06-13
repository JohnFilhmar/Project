<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('partials/head') ?>
</head>

<body>
</body>
<div class="container mx-auto min-h-screen flex justify-center items-center">
  <div class="w-full max-w-2xl bg-white bg-opacity-90 rounded-2xl shadow-2xl p-10 flex flex-col items-center">
    <img src="/logo.jpg" alt="Logo" class="w-24 h-24 mb-6 rounded-full shadow-md border-4 border-green-200 bg-white object-contain" />
    <h2 class="text-3xl font-bold text-green-800 mb-2">Create Account</h2>
    <p class="text-gray-600 mb-6 text-center">Register a new account</p>
    <?php helper('form'); ?>
    <?= form_open_multipart('login/create-account', ['class' => 'grid grid-cols-1 md:grid-cols-2 gap-2 w-full space-y-5']) ?>
    <div>
      <label for="name" class="block text-sm font-medium text-green-700 mb-1">First Name</label>
      <?= form_input([
        'type' => 'text',
        'id' => 'first_name',
        'name' => 'first_name',
        'required' => true,
        'autocomplete' => 'first_name',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'placeholder' => 'Enter your first name'
      ]) ?>
    </div>
    <div>
      <label for="name" class="block text-sm font-medium text-green-700 mb-1">Middle Name</label>
      <?= form_input([
        'type' => 'text',
        'id' => 'middle_name',
        'name' => 'middle_name',
        'required' => false,
        'autocomplete' => 'middle_name',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'placeholder' => 'Enter your middle name'
      ]) ?>
    </div>
    <div>
      <label for="name" class="block text-sm font-medium text-green-700 mb-1">Last Name</label>
      <?= form_input([
        'type' => 'text',
        'id' => 'last_name',
        'name' => 'last_name',
        'required' => true,
        'autocomplete' => 'last_name',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'placeholder' => 'Enter your last name'
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
        'placeholder' => 'Enter your email'
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
          'placeholder' => 'Confirm your password'
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
      <label for="organization" class="block text-sm font-medium text-green-700 mb-1 mt-4">Organization</label>
      <?= form_dropdown('organization', $organizations ?? [], '', [
        'id' => 'organization',
        'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition',
        'required' => true,
        'selected' => set_value('organization', ''),
      ]) ?>
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
    <?= form_submit('submit', 'Register', [
      'class' => 'md:col-span-2 w-full py-3 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg shadow transition'
    ]) ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center" role="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <?= form_close() ?>
    <div class="w-full flex justify-between mt-4 text-sm">
      <a href="#" class="text-green-700 hover:underline">Forgot Password?</a>
      <a href="/login" class="text-green-700 hover:underline">Already have an account?</a>
    </div>
  </div>
</div>
<script>
  function togglePassword() {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m1.414-1.414A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.197M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
    } else {
      pwd.type = 'password';
      icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    }
  }

  function togglePasswordConfirm() {
    const pwd = document.getElementById('password_confirm');
    const icon = document.getElementById('eyeIconConfirm');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m1.414-1.414A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.197M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
    } else {
      pwd.type = 'password';
      icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    }
  }
</script>

</html>