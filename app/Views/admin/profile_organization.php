
<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Organization Lists</p>
<div class="mt-6 self-justify-end flex justify-between items-center gap-2 self-end">
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('addOrganizationForm').showModal();">
    <p>Create New Organization</p>
  </button>
  <?= view('admin/profile_organization_form') ?>
</div>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="organizationTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Organization Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Date Created</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Status</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($organizations)): ?>
        <tr>
          <td colspan="5" class="text-center py-4 text-gray-500">No organizations found.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($organizations as $organization_id => $organization): ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2"><?= esc($organization['organization_name']) ?></td>
            <td class="px-4 py-2"><?= esc($organization['date_created']) ?></td>
            <td class="px-4 py-2"><?= esc($organization['is_active']) ? 'active' : 'inactive' ?></td>
            <td class="px-4 py-2">
              <?php if ($organization['is_active']): ?>
                <form method="post" action="<?= site_url('admin/profile/organization/deactivate/' . esc($organization['organization_id'])) ?>" style="display:inline;">
                  <?= csrf_field() ?>
                  <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold"
                    onclick="return confirm('Are you sure you want to deactivate this organization?');">
                    Deactivate
                  </button>
                </form>
              <?php else: ?>
                <form method="post" action="<?= site_url('admin/profile/organization/activate/' . esc($organization['organization_id'])) ?>" style="display:inline;">
                  <?= csrf_field() ?>
                  <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold"
                    onclick="return confirm('Are you sure you want to re-activate this organization?');">
                    Re-activate
                  </button>
                </form>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
