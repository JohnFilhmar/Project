<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Manage Campaigns</p>
<div class="mt-6 self-justify-end flex justify-center items-end gap-2 self-end mb-6 text-sm md:text-base lg:text-lg">

  <button
    onclick="openEditCampaign(this)"
    class="drop-shadow-lg bg-green-500 hover:bg-green-700 text-white disabled:bg-green-600 disabled:text-gray-200 disabled:shadow-inner font-bold py-2 px-4 rounded transition duration-300 ease-in-out mb-6"
    type="button"
    id="addNewCampaignBtn" 
    >
    Add New Campaign
  </button>
  <!-- MODAL FOR ADDING NEW CAMPAIGN -->
  <?= view('admin/campaigns_add_modal') ?>

</div>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="studentsTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Title</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Details</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Image</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Partylist</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Date Added</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($campaigns as $campaign): ?>
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-2"><?= esc($campaign['title']) ?></td>
          <td class="px-4 py-2"><?= esc($campaign['details']) ?></td>
          <td class="px-4 py-2 text-center">
            <?php if (!empty($campaign['image_url'])): ?>
              <img src="<?= esc($campaign['image_url']) ?>" alt="Campaign Image" class="w-16 h-16 object-cover rounded shadow" />
            <?php else: ?>
              <img src="/no-image.png" alt="Campaign Image" class="w-16 h-16 object-cover rounded shadow" />
            <?php endif; ?>
          </td>
          <td class="px-4 py-2"><?= esc($campaign['partylist']) ?></td>
          <td class="px-4 py-2"><?= esc($campaign['date_added']) ?></td>
          <td class="px-4 py-2">
            <button
              class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold mr-2"
              data-campaign_id="<?= esc($campaign['campaign_id']) ?>"
              data-partylist="<?= esc($campaign['partylist']) ?>"
              data-campaign_name="<?= esc($campaign['title']) ?>"
              data-description="<?= esc($campaign['details']) ?>"
              data-image_url="<?= esc($campaign['image_url']) ?>"
              data-url="/campaigns/update/<?= esc($campaign['campaign_id']) ?>"
              data-form_title="Edit Campaign"
              onclick="openEditCampaign(this)">
              Edit
            </button>
            <form action="/campaigns/delete/<?= esc($campaign['campaign_id']) ?>" method="post" style="display:inline;">
              <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold" onclick="return confirm('Are you sure you want to delete this campaign?');">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>