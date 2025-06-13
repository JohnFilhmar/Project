<!DOCTYPE html>
<html lang="en">

<head>
  <?= view('partials/head') ?>
</head>

<body>
  <div class="container mx-auto min-h-screen flex justify-center items-center">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-2xl shadow-2xl p-10 flex flex-col items-center hover:translate-y-[-1rem] transition-all duration-500 ease-in-out">
      <img src="/logo.jpg" alt="Logo" class="w-24 h-24 mb-6 rounded-full shadow-md border-4 border-green-200 bg-white object-contain" />
      <h2 class="text-3xl font-bold text-green-800 mb-2">Welcome Back</h2>
      <p class="text-gray-600 mb-6 text-center">Sign in to your account</p>
      <?php helper('form'); ?>
      <?= form_open('login/signin', ['class' => 'w-full space-y-5']) ?>
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
            'autocomplete' => 'current-password',
            'class' => 'w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition pr-10',
            'placeholder' => 'Enter your password'
          ]) ?>
          <button type="button" tabindex="-1" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-green-600 focus:outline-none" onclick="togglePassword()">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </button>
        </div>
      </div>
      <?= form_submit('submit', 'Log In', [
        'class' => 'w-full py-3 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg shadow transition'
      ]) ?>
      <?php if (session()->getFlashdata('success')): ?>
        <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center" role="alert">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div class="w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center" role="alert">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      <div class="w-full text-center text-sm text-gray-500">
        By logging in, you agree to our <a href="/terms" class="text-green-700 hover:underline">Terms of Service</a> and <a href="/privacy" class="text-green-700 hover:underline">Privacy Policy</a>.
        <?= form_close() ?>
        <div class="w-full flex justify-start items-center mt-4 text-sm">
          <a href="/login/forgot-password" class="text-green-700 hover:underline">Forgot Password?</a>
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
      </script>
    </div>
</body>

</html>