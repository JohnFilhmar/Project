<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Positions Lists Per Organization</p>
<div class="self-justify-end flex justify-between items-center gap-2 self-end">
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out"
    onclick="document.getElementById('addPositionForm').showModal();">
    <p>Add New Position</p>
  </button>
</div>
<?php
helper('form');

// Example organization list based on actual organization names in the database
$orgOptions = ['' => 'Select Organization'];
if (!empty($organizationPositions)) {
  foreach ($organizationPositions as $orgName => $positions) {
    $orgOptions[$orgName] = $orgName;
  }
}

$selectedOrgName = $_GET['organization'] ?? '';
$positionsToShow = $organizationPositions[$selectedOrgName] ?? [];

echo form_open('', ['method' => 'get', 'class' => 'self-start']);
echo form_label('Organization:', 'organization', ['class' => 'font-semibold mr-2']);
echo form_dropdown('organization', $orgOptions, $selectedOrgName, [
  'id' => 'organization',
  'class' => 'border rounded px-3 py-2 font-bold bg-green-100 text-green-800',
  'onchange' => 'this.form.submit()'
]);
echo form_close();
?>
<?= view('admin/profile_position_form', ['selectedOrg' => $selectedOrgName]) ?>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="positionTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Position Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Active</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($selectedOrgName)): ?>
        <?php $i = 1;
        foreach ($positionsToShow as $position => $isActive): ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2"><?= esc($position) ?></td>
            <td class="px-4 py-2 text-center">
              <?= $isActive ? '<span class="text-green-600 font-bold">Yes</span>' : '<span class="text-red-600 font-bold">No</span>' ?>
            </td>
            <td class="px-4 py-2 text-center">
              <?php if ($isActive): ?>
                <form method="post" action="<?= site_url('admin/profile/position/deactivate/' . esc($position)) . '/' . esc($selectedOrgName) ?>" style="display:inline;">
                  <?= csrf_field() ?>
                  <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold"
                    onclick="return confirm('Are you sure you want to deactivate this position?');">
                    Deactivate
                  </button>
                </form>
              <?php else: ?>
                <form method="post" action="<?= site_url('admin/profile/position/activate/' . esc($position)) . '/' . esc($selectedOrgName) ?>" style="display:inline;">
                  <?= csrf_field() ?>
                  <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold"
                    onclick="return confirm('Are you sure you want to re-activate this position?');">
                    Re-activate
                  </button>
                </form>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="px-4 py-4 text-center text-gray-500">
            No organization selected. Please select an organization to proceed.
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>