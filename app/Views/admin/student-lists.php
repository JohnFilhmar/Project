<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5">Registered Student Lists</p>
<p class="text-base md:text-xl lg:text-2xl font-semibold">Manage student lists for the upcoming elections.</p>
<div class="mt-6 self-justify-end flex justify-between items-center gap-2 self-end">
  <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="document.getElementById('addStudentModal').showModal();">
    <p>Add New Student</p>
  </button>

  <?= view('admin/student_lists_form') ?>
  
  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6"
    onclick="if(!confirm('Are you sure you want to deactivate all students? This action cannot be undone.')) return false;">
    <p>Deactivate Students</p>  
  </button>
</div>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full">
  <table id="studentsTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">#</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Student No.</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Email</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Course</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Year Level</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Organizations</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Status</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $n = 1; foreach ($students as $student_no => $student): ?>
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-2"><?= $n++ ?></td>
          <td class="px-4 py-2"><?= esc($student_no) ?></td>
          <td class="px-4 py-2"><?= esc($student['full_name']) ?></td>
          <td class="px-4 py-2"><?= esc($student['email']) ?></td>
          <td class="px-4 py-2"><?= esc($student['course']) ?></td>
          <td class="px-4 py-2"><?= esc($student['year_level']) ?></td>
          <td class="px-4 py-2"><?= esc($student['organizations']) ?></td>
          <td class="px-4 py-2">
            <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Active</span>
          </td>
          <td class="px-4 py-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold mr-2" onclick="document.getElementById('addStudentModal').showModal();">Edit</button>
            <button class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold" onclick="if(!confirm('Are you sure you want to deactivate this student?')) return false;">Deactivate</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>