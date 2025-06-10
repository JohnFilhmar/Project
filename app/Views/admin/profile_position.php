<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Positions Lists Per Organization</p>
<div class="mt-6 self-justify-end flex justify-between items-center gap-2 self-end">
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('addPositionForm').showModal();">
    <p>Add New Position</p>
  </button>
</div>
<?= view('admin/profile_position_form') ?>
<?php

helper('form');

// Map organization keys to display names and data keys
$orgOptions = [
  '' => 'Select Organization',
  'rcy' => 'Red Cross Youth',
  'rotaract' => 'Rotaract',
  'jpcs' => 'JPCS',
  'gdsc' => 'GDSC',
  'sc' => 'SC',
];

// Get selected organization from GET or default to ''
$selectedOrgKey = isset($_GET['organization']) ? $_GET['organization'] : '';
$selectedOrgName = $orgOptions[$selectedOrgKey] ?? '';

// Prepare positions data (should be passed from controller)
$positionsData = $positions ?? [];

// Get positions for selected organization
$positionsToShow = [];
if ($selectedOrgKey && isset($positionsData[$selectedOrgName])) {
  $positionsToShow = $positionsData[$selectedOrgName];
}

echo form_open('', ['method' => 'get', 'class' => 'self-start']);
echo form_label('Organization:', 'organization', ['class' => 'font-semibold mr-2']);
echo form_dropdown('organization', $orgOptions, $selectedOrgKey, [
  'id' => 'organization',
  'class' => 'border rounded px-3 py-2 font-bold bg-green-100 px-2 py-1 rounded text-green-800',
  'onchange' => 'this.form.submit()'
]);
echo form_close();
?>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="positionTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">#</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Position Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Active</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($selectedOrgKey && $positionsToShow): ?>
        <?php foreach ($positionsToShow as $position): ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-2 text-center"><?= esc($position['position_no']) ?></td>
            <td class="px-4 py-2"><?= esc($position['position_name']) ?></td>
            <td class="px-4 py-2 text-center">
              <?= $position['position_is_active'] ? '<span class="text-green-600 font-bold">Yes</span>' : '<span class="text-red-600 font-bold">No</span>' ?>
            </td>
            <td class="px-4 py-2 text-center">
              <button class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold" onclick="if(!confirm('Are you sure you want to deactivate this position?')) return false;">Deactivate</button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php elseif ($selectedOrgKey): ?>
        <tr>
          <td colspan="4" class="text-center py-4 text-gray-500">No positions found for this organization.</td>
        </tr>
      <?php else: ?>
        <tr>
          <td colspan="4" class="text-center py-4 text-gray-500">Please select an organization to view positions.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>