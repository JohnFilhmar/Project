<dialog id="addOrganizationForm" class="rounded-lg shadow-lg p-0 w-full max-w-md mx-auto my-auto text-green-900">
  <?php
  helper('form');
  ?>
  <?= form_open('admin/profile/organization/create', ['id' => 'addOrganizationForm', 'class' => 'space-y-4 p-6']) ?>
  <?= form_label('Create New Organization', 'title', ['class' => 'text-2xl font-bold text-center mb-10 border-b-2 border-green-500 w-full']) ?>
  <div>
    <?= form_label('Organization Name', 'organization_name', ['class' => 'block text-sm font-medium']) ?>
    <?= form_input('organization_name', '', [
      'type' => 'text',
      'id' => 'organization_name',
      'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 hover:scale-105',
      'required' => 'required',
      'pattern' => '^[A-Za-z0-9\s\-\'&.,]+$',
      'title' => 'Only letters, numbers, spaces, hyphens, apostrophes, ampersands, commas, and periods are allowed.'
    ]) ?>
  </div>
  <div>
    <?= form_label('Positions', 'positions_input', ['class' => 'block text-sm font-medium']) ?>
    <div id="positions-wrapper" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
      <div id="positions-list" class="flex flex-wrap gap-2 mb-2"></div>
      <div class="flex">
        <?= form_input('positions_input', '', [
          'type' => 'text',
          'id' => 'positions_input',
          'name' => 'positions_input',
          'class' => 'flex-1 border-none outline-none',
          'placeholder' => 'Add position and press Enter',
          'autocomplete' => 'off',
          'pattern' => '^[A-Za-z0-9\s\-\'&.,]+$',
          'title' => 'Only letters, numbers, spaces, hyphens, apostrophes, ampersands, commas, and periods are allowed.'
        ]) ?>
        <button type="button" id="add-position-btn" class="ml-2 bg-green-600 text-white px-2 rounded">Add</button>
      </div>
      <input type="hidden" name="positions" id="positions_hidden">
    </div>
  </div>
  <script>
    const positionsInput = document.getElementById('positions_input');
    const positionsList = document.getElementById('positions-list');
    const positionsHidden = document.getElementById('positions_hidden');
    const addPositionBtn = document.getElementById('add-position-btn');
    let positions = [];

    function updatePositions() {
      positionsList.innerHTML = '';
      positions.forEach((pos, idx) => {
        const tag = document.createElement('span');
        tag.className = 'bg-green-100 text-green-800 rounded flex items-center py-1 px-2';
        tag.innerHTML = `${pos} <button type="button" class="ml-1 text-red-500" onclick="removePosition(${idx})" aria-label="Remove">
          <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>`;
        positionsList.appendChild(tag);
      });
      positionsHidden.value = JSON.stringify(positions);
    }

    function addPosition() {
      const value = positionsInput.value.trim();
      if (value && !positions.includes(value)) {
        positions.push(value);
        updatePositions();
        positionsInput.value = '';
      }
    }

    function removePosition(idx) {
      positions.splice(idx, 1);
      updatePositions();
    }

    positionsInput.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        addPosition();
      }
    });

    addPositionBtn.addEventListener('click', addPosition);

    // Expose removePosition to global scope
    window.removePosition = removePosition;
  </script>

  <div class="w-full">
    <?= form_submit('submit', 'Create', ['class' => 'w-full bg-green-600 text-white px-4 py-2 rounded']) ?>
  </div>
  <?= form_button([
    'type' => 'button',
    'class' => 'w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded',
    'content' => 'Cancel',
    'onclick' => "document.getElementById('addOrganizationForm').close();"
  ]) ?>
  <?= form_close() ?>
</dialog>