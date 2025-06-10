
<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Officers' Lists</p>
<div class="mt-6 self-justify-end flex justify-between items-center gap-2 self-end">
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('addOfficerForm').showModal();">
    <p>Add New Officer</p>
  </button>
  <?= view('admin/profile_officer_form') ?>
</div>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="organizationTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">#</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Full Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Organization</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Email</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Profile Image</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php $n = 1; foreach ($officers as $officer): ?>
      <tr class="hover:bg-gray-50 transition">
        <td class="px-4 py-2 text-center"><?= $n++ ?></td>
        <td class="px-4 py-2 text-center"><?= esc($officer['full_name']) ?></td>
        <td class="px-4 py-2 text-center"><?= esc($officer['organization']) ?></td>
        <td class="px-4 py-2 text-center"><?= esc($officer['email']) ?></td>
        <td class="px-4 py-2 text-center">
          <?php if (!empty($officer['profile_image'])): ?>
            <img src="<?= esc($officer['profile_image']) ?>" alt="Profile Image" class="h-10 w-10 rounded-full object-cover mx-auto">
          <?php else: ?>
            <img src="/no-profile.png" alt="Profile Image" class="h-10 w-10 rounded-full object-cover mx-auto">
          <?php endif; ?>
        </td>
        <td class="px-4 py-2 text-center">
          <button class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold mr-1">Edit</button>
          <button class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold" onclick="return confirm('Are you sure you want to delete this officer?');">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
