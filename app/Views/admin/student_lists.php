<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p class="text-2xl md:text-3xl lg:text-4xl font-extrabold mt-8 md:mt-9 lg:mt-10 mb-5"><?php if (esc(session()->get('role')) == 'officer'): ?><?= esc(session()->get('organization')) ?><?php endif; ?> Registered Student Lists</p>
<p class="text-base md:text-xl lg:text-2xl font-semibold">Manage student lists for the upcoming elections.</p>
<div class="mt-6 self-justify-end flex flex-col md:flex-row justify-between items-center gap-2 self-end mb-6 text-sm md:text-base lg:text-lg">

  <?php helper('form'); ?>
  <form method="get" class="flex flex-col md:flex-row gap-2 items-end mb-0">
    <?= form_dropdown('year_level', ['' => 'All Year Levels'] + $yearLevels, $selectedYearLevel ?? '', ['class' => 'border rounded px-2 py-1']) ?>
    <?= form_dropdown('course', ['' => 'All Courses'] + $courses, $selectedCourse ?? '', ['class' => 'border rounded px-2 py-1']) ?>
    <?php if (esc(session()->get('role')) == 'admin'): ?>
      <?= form_dropdown('organization', ['' => 'All Organizations'] + $organizations, $selectedOrganization ?? '', ['class' => 'border rounded px-2 py-1']) ?>
    <?php endif; ?>
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold">Filter</button>
  </form>

  <?php if (esc(session()->get('role')) == 'admin'): ?>
    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out"
      onclick="openEditProfile(this)">
      <p>Add New Student</p>
    </button>

    <?= view('admin/student_lists_form') ?>

    <form action="/students/deactivate_all" method="post" style="display:inline;">
      <button
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed"
        onclick="if(!confirm('Are you sure you want to deactivate all students? This action cannot be undone.')) return false;"
        <?= empty($students) ? 'disabled' : '' ?>>
        <p>Deactivate Students</p>
      </button>
    </form>
  <?php endif; ?>
  <?php if (esc(session()->get('role')) == 'officer'): ?>
    <div class="relative">
      <button id="toggleVotersBtn" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out">
        <p>Votees</p>
      </button>
      <?= view('officer/students_voters') ?>
    </div>
  <?php endif; ?>
</div>

<div class="bg-white rounded-lg shadow-lg p-6 mt-4 w-full text-nowrap">
  <?php echo session()->get('notif-details'); ?>
  <table id="studentsTable" class="min-w-full divide-y divide-green-600 text-green-800 border-2 border-green-600">
    <thead class="bg-green-100">
      <tr class="divide-x-2 divide-green-600">
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Student No.</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Image</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Name</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Email</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Phone Number</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Course</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Year Level</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Organizations</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Status</th>
        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wider text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($students as $student_no => $student): ?>
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-2"><?= esc($student['student_number']) ?></td>
          <td class="px-4 py-2">
            <img src="<?= !empty($student['image_url']) ? esc($student['image_url']) : '/no-profile.png' ?>" alt="<?= esc($student['last_name']) ?>" class="w-12 h-12 object-cover rounded-full mx-auto">
          </td>
          <td class="px-4 py-2"><?= esc($student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name']) ?></td>
          <td class="px-4 py-2"><?= esc($student['email']) ?></td>
          <td class="px-4 py-2"><?= !empty(esc($student['phone_number'])) ? esc($student['phone_number']) : 'n/a' ?></td>
          <td class="px-4 py-2"><?= esc($student['course']) ?></td>
          <td class="px-4 py-2">
            <?= esc($student['year_level'] . ($student['year_level'] == 1 ? 'st' : ($student['year_level'] == 2 ? 'nd' : ($student['year_level'] == 3 ? 'rd' : 'th'))) . ' Year') ?>
          </td>
          <td class="px-4 py-2"><?= esc($student['organizations']) ?></td>
          <td class="px-4 py-2">
            <?php if (!empty($student['is_enrolled'])): ?>
              <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Active</span>
            <?php else: ?>
              <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">Inactive</span>
            <?php endif; ?>
          </td>
          <td class="px-4 py-2">
            <?php if (esc(session()->get('role')) == 'officer'): ?>
              <?php if (!empty($student['is_candidate'])): ?>
                <button class="bg-gray-300 text-gray-500 px-3 py-1 rounded text-xs font-bold mr-2 cursor-not-allowed" disabled>Already a Candidate</button>
              <?php else: ?>
                <button class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold mr-2" onclick="document.getElementById('applyCandidateModal').showModal();">
                  Apply as Candidate
                </button>
                <?= view('officer/candidate_create', ['student_id' => $student['student_id']]) ?>
              <?php endif; ?>
            <?php else: ?>
              <button
                class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold mr-2"
                data-student_number="<?= esc($student['student_number']) ?>"
                data-first_name="<?= esc($student['first_name']) ?>"
                data-middle_name="<?= esc($student['middle_name']) ?>"
                data-last_name="<?= esc($student['last_name']) ?>"
                data-sex="<?= esc($student['sex']) ?>"
                data-course="<?= esc($student['course']) ?>"
                data-year_level="<?= esc($student['year_level']) ?>"
                data-email="<?= esc($student['email']) ?>"
                data-organization="<?= esc($student['organization']) ?>"
                data-url="/students/update/<?= esc($student['student_id']) ?>"
                data-form_title="Edit Student Profile"
                onclick="openEditProfile(this)">
                Edit
              </button>
              <?php if (empty($student['is_enrolled'])): ?>
                <form action="/students/activate/<?= esc($student['student_id']) ?>" method="post" style="display:inline;">
                  <button
                    class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-bold"
                    onclick="return confirm('Are you sure you want to re-activate this student?');"
                    type="submit">
                    Re-Activate
                  </button>
                </form>
              <?php else: ?>
                <form action="/students/deactivate/<?= esc($student['student_id']) ?>" method="post" style="display:inline;">
                  <button
                    class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-bold"
                    onclick="return confirm('Are you sure you want to deactivate this student?');"
                    type="submit">
                    Deactivate
                  </button>
                </form>
              <?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>