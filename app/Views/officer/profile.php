<?= $this->extend('layouts/officer') ?>
<?= $this->section('content') ?>

<div class="self-center bg-white bg-opacity-90 rounded-lg shadow-xl p-8 w-full max-w-md flex flex-col items-center mt-12 md:mt-20">
  <h2 class="text-2xl md:text-3xl font-bold mb-2 text-center"><span class="capitalize"><?= esc(session()->get('role')) ?></span> Profile</h2>
  <div class="relative mb-4">
    <img id="profileImage" src="<?= esc(session()->get('image_url') ?: '/no-profile.png') ?>" alt="Profile Image" class="self-center justify-self-center w-40 h-40 object-cover rounded-lg border-4 border-green-500 shadow-md transition-all duration-300" />

    <?php helper('form'); ?>
    <?= form_open_multipart('/admin/profile/update_profile_image', [
      'id' => 'changeImageForm',
      'class' => 'flex gap-2 items-center mt-2 items-center justify-center',
      'method' => 'post',
      'enctype' => 'multipart/form-data'
    ]) ?>
    <label for="imageInput" class="bg-green-500 hover:bg-green-700 text-white text-xs px-3 py-1 rounded transition cursor-pointer flex items-center gap-1">
      <i class="fa fa-pencil"></i>Change
      <input type="file" id="imageInput" name="profile_image" accept="image/*" class="hidden" accept="image/*" />
    </label>
    <button type="button" id="removeImageBtn" class="bg-red-500 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition flex items-center gap-1 hidden">
      <i class="fa fa-trash"></i>Remove
    </button>
    <button type="submit" id="updateProfileBtn" class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded transition flex items-center gap-1 hidden">
      <i class="fa fa-upload"></i>Update
    </button>
    <?= form_close() ?>

    <script>
      const imageInput = document.getElementById('imageInput');
      const profileImage = document.getElementById('profileImage');
      const removeImageBtn = document.getElementById('removeImageBtn');
      const updateProfileBtn = document.getElementById('updateProfileBtn');
      const originalSrc = "<?= esc(session()->get('image_url') ?: '/no-profile.png') ?>";

      imageInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
          const reader = new FileReader();
          reader.onload = function(ev) {
            profileImage.src = ev.target.result;
            profileImage.classList.add('ring-4', 'ring-yellow-400');
            removeImageBtn.classList.remove('hidden');
            updateProfileBtn.classList.remove('hidden');
          };
          reader.readAsDataURL(this.files[0]);
        }
      });

      removeImageBtn.addEventListener('click', function(e) {
        e.preventDefault();
        profileImage.src = originalSrc;
        profileImage.classList.remove('ring-4', 'ring-yellow-400');
        imageInput.value = '';
        removeImageBtn.classList.add('hidden');
        updateProfileBtn.classList.add('hidden');
      });
    </script>
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

<?= $this->endSection() ?>