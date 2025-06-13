<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="self-center bg-white bg-opacity-90 rounded-lg shadow-xl p-8 w-full max-w-md flex flex-col items-center mt-12 md:mt-20">
  <h2 class="text-2xl md:text-3xl font-bold mb-2 text-center text-green-700"><span class="capitalize">Student</span> Profile</h2>
  <div class="relative mb-4">
    <img src="<?= esc(session()->get('image_url') ?? '/public/no-profile.png') ?>" alt="Profile Image" class="w-40 h-40 object-cover rounded-full border-4 border-green-500 shadow-md" />
    <button class="absolute bottom-2 right-2 bg-green-500 hover:bg-green-700 text-white text-xs px-3 py-1 rounded transition"
      onclick="document.getElementById('changeImageModal').showModal();">
      <i class="fa fa-pencil mr-1"></i>Change Image
    </button>
  </div>
  <div class="text-center mb-4 w-full">
    <p class="text-lg font-semibold mb-1">
      <?= esc(session()->get('first_name') . ' ' . session()->get('last_name')) ?>
    </p>
    <p class="text-base font-medium text-gray-600">Student ID:</p>
    <p class="text-base font-bold mb-1"><?= esc(session()->get('user_id')) ?></p>
    <p class="text-base font-medium text-gray-600">Student Number:</p>
    <p class="text-base font-bold mb-1"><?= esc(session()->get('student_number')) ?></p>
    <p class="text-base font-medium text-gray-600">Organization:</p>
    <p class="text-base font-bold mb-1"><?= esc(session()->get('organization')) ?></p>
    <p class="text-base font-medium text-gray-600">Email:</p>
    <p class="text-base underline font-semibold mb-1"><?= esc(session()->get('email')) ?></p>
    <p class="text-base font-medium text-gray-600">Course:</p>
    <p class="text-base font-bold mb-1"><?= esc(session()->get('course')) ?></p>
    <p class="text-base font-medium text-gray-600">Year Level:</p>
    <p class="text-base font-bold mb-1"><?= esc(session()->get('year_level')) ?></p>
  </div>
  <div class="flex gap-3 mt-2">
    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition"
      onclick="document.getElementById('editProfileModal').showModal();">
      <i class="fa fa-edit mr-1"></i>Edit Profile
    </button>
  </div>
</div>

<?= $this->endSection() ?>