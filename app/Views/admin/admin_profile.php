<div class="self-center bg-white bg-opacity-90 rounded-lg shadow-xl p-8 w-full max-w-md flex flex-col items-center mt-12 md:mt-20">
  <h2 class="text-2xl md:text-3xl font-bold mb-2 text-center"><span class="capitalize"><?= esc(session()->get('role')) ?></span> Profile</h2>
  <div class="relative mb-4">
    <img src="<?= esc(session()->get('image_url') ?: '/no-profile.png') ?>" alt="Profile Image" class="w-40 h-40 object-cover rounded-lg border-4 border-green-500 shadow-md" />
    <button class="absolute bottom-2 right-2 bg-green-500 hover:bg-green-700 text-white text-xs px-3 py-1 rounded transition"
      onclick="document.getElementById('changeImageModal').showModal();">
      <i class="fa fa-pencil mr-1"></i>Change Image
    </button>
  </div>
  <div class="text-center mb-4">
    <p class="text-lg font-semibold">
      <?= esc(session()->get('first_name') . ' ' . session()->get('last_name')) ?>
    </p>
    <p class="text-base font-medium">Organization:</p>
    <p class="text-base font-bold"><?= esc(session()->get('organization')) ?></p>
    <p class="text-base font-medium">Email:</p>
    <p class="text-base underline font-semibold"><?= esc(session()->get('email')) ?></p>
  </div>
  <div class="flex gap-3 mt-2">
    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition"
      onclick="document.getElementById('editProfileModal').showModal();">
      <i class="fa fa-edit mr-1"></i>Edit Profile
    </button>
  </div>
</div>