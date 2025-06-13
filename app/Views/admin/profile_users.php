<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">User Management</p>
<div class="mt-6 self-justify-end flex justify-between items-center gap-2 self-end">
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('addAdminForm').showModal();">
    <p>Create a new admin</p>
  </button>
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('addOfficerForm').showModal();">
    <p>Add another officer</p>
  </button>
  <?= view('admin/profile_users_admin_form') ?>
  <?= view('admin/profile_users_form', ['student_number' => isset($student_number) ? $student_number : '']) ?>
</div>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="organizationTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Profile Image</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Full Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Organization</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Email</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Role</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Created At</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Status</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
      <tr class="hover:bg-gray-50 transition">
        <td class="px-4 py-2 text-center">
          <?php if (!empty($user['image_url'])): ?>
            <img src="<?= esc($user['image_url']) ?>" alt="Profile Image" class="h-10 w-10 rounded-full object-cover mx-auto">
          <?php else: ?>
            <img src="/no-profile.png" alt="Profile Image" class="h-10 w-10 rounded-full object-cover mx-auto">
          <?php endif; ?>
        </td>
        <td class="px-4 py-2 text-center"><?= esc($user['first_name']) . ' ' . esc($user['middle_name']) . ' ' . esc($user['last_name']) ?></td>
        <td class="px-4 py-2 text-center"><?= esc($user['organization']) ?></td>
        <td class="px-4 py-2 text-center"><?= esc($user['email']) ?></td>
        <td class="px-4 py-2 text-center"><?= esc($user['role']) ?></td>
        <td class="px-4 py-2 text-center"><?= esc($user['created_at']) ?></td>
        <td class="px-4 py-2 text-center"><?= esc($user['is_active']) ? 'activated' : 'deactivated' ?></td>
        <td class="px-4 py-2 text-center">
          <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold mr-1">Edit</button> -->
          <?php if ($user['is_active']): ?>
            <form action="/admin/profile/users/deactivate/<?= esc($user['user_id']) ?>" method="post" style="display:inline;">
              <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold" onclick="return confirm('Are you sure you want to deactivate this user?');">Deactivate</button>
            </form>
          <?php else: ?>
            <form action="/admin/profile/users/activate/<?= esc($user['user_id']) ?>" method="post" style="display:inline;">
              <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold" onclick="return confirm('Are you sure you want to activate this user?');">Activate</button>
            </form>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
