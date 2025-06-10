<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Candidates List</p>
<p class="text-base md:text-xl lg:text-2xl font-semibold">View all candidates for the upcoming elections.</p>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="candidatesTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">#</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Photo</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Position</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Quote</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $n = 1; foreach ($candidatesList as $candidate): ?>
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-2 text-center"><?= $n++ ?></td>
          <td class="px-4 py-2 text-center">
            <img 
              src="<?= !empty($candidate['image']) ? esc($candidate['image']) : '/no-image.png' ?>" 
              alt="<?= esc($candidate['name']) ?>" 
              class="w-12 h-12 object-cover rounded-full mx-auto"
            >
          </td>
          <td class="px-4 py-2"><?= esc($candidate['name']) ?></td>
          <td class="px-4 py-2"><?= esc($candidate['position']) ?></td>
          <td class="px-4 py-2 italic text-gray-600"><?= esc($candidate['quote']) ?></td>
          <td class="px-4 py-2 text-center space-x-2">
            <a href="<?= site_url('admin/candidates/edit/' . $candidate['id']) ?>" class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs font-semibold">Edit</a>
            <form action="<?= site_url('admin/candidates/disqualify/' . $candidate['id']) ?>" method="post" class="inline-block" onsubmit="return confirm('Are you sure you want to disqualify this candidate?');">
              <?= csrf_field() ?>
              <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs font-semibold">Disqualify</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
