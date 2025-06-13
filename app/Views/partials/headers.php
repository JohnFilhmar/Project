<header class="flex items-center justify-between p-2 md:p-3 lg:p-4 bg-[#99e999] shadow-md fixed top-0 left-0 right-0 z-50">
  <div class="flex items-center">
    <a href="/" class="font-bold flex items-center justify-center">
      <img src="/logo.jpg" alt="E-Ballot Logo" class="size-10 md:size-16 lg:size-20 inline-block mr-2">
      <p class="text-lg md:text-xl text-nowrap font-black">E-Ballot System</p>
    </a>
    <?php $url = $_SERVER['REQUEST_URI']; ?>
    <nav class="ml-6 hidden md:block">
      <ul class="flex space-x-4">
        <li>
          <a href="/<?= esc(session()->get('role')) ?>" class="hover:underline font-bold px-2 py-1 rounded-md <?= active_link('/campaigns', $url); ?>">
            Campaigns
          </a>
        </li>
        <li>
          <a href="/results" class="hover:underline font-bold px-2 py-1 rounded-md <?= active_link('/results', $url); ?>">
            Results
          </a>
        </li>
        <li>
          <a href="/candidate" class="hover:underline font-bold px-2 py-1 rounded-md <?= active_link('/candidate', $url); ?>">
            Candidates
          </a>
        </li>
        <li>
          <a href="/ballots" class="hover:underline font-bold px-2 py-1 rounded-md <?= active_link('/ballots', $url); ?>">
            Ballots
          </a>
        </li>
        <?php if(esc(session()->get('role')) != 'student'): ?>
          <li>
            <a href="/campaigns/campaign_lists" class="hover:underline font-bold px-2 py-1 rounded-md <?= active_link('/campaigns/campaign_lists', $url); ?>">
              Campaign Lists
            </a>
          </li>
          <li>
            <a href="/candidate/candidate_lists" class="hover:underline font-bold px-2 py-1 rounded-md <?= active_link('/candidate/candidate_lists', $url); ?>">
              Candidate Lists
            </a>
          </li>
          <li>
            <a href="/students/student_lists" class="hover:underline font-bold px-2 py-1 rounded-md <?= active_link('/students', $url); ?>">
              Student Lists
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
  <div class="flex items-center relative">
    <nav class="block md:hidden mr-2">
      <button id="mobileMenuButton" class="text-gray-700 hover:text-gray-900 focus:outline-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </nav>
    <div id="mobileMenu" class="hidden absolute right-[-1rem] bg-white top-14 w-64 shadow-2xl z-50 transition-all duration-300 opacity-0 translate-y-[-10px]">
      <ul class="flex flex-col gap-2 p-4">
        <li class="border-b-2 border-[#99e999]">
          <a href="/<?= esc(session()->get('role')) ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-800 font-semibold hover:bg-green-100 transition">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M3 7h18M3 12h18M3 17h18" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Campaigns
          </a>
        </li>
        <li class="border-b-2 border-[#99e999]">
          <a href="/results" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-800 font-semibold hover:bg-green-100 transition">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Results
          </a>
        </li>
        <li class="border-b-2 border-[#99e999]">
          <a href="/candidate" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-800 font-semibold hover:bg-green-100 transition">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Candidates
          </a>
        </li>
        <li class="border-b-2 border-[#99e999]">
          <a href="/ballots" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-800 font-semibold hover:bg-green-100 transition">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M9 12h6m-6 4h6m-6-8h6M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Ballots
          </a>
        </li>
        <li class="border-b-2 border-[#99e999]">
          <a href="/campaigns/campaign_lists" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-800 font-semibold hover:bg-green-100 transition">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Campaign Lists
          </a>
        </li>
        <li class="border-b-2 border-[#99e999]">
          <a href="/candidate/candidate_lists" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-800 font-semibold hover:bg-green-100 transition">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Candidate Lists
          </a>
        </li>
        <li>
          <a href="/students/student_lists" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-800 font-semibold hover:bg-green-100 transition">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Student Lists
          </a>
        </li>
      </ul>
    </div>
    <button onclick="handleProfile()">
      <?php $image_url = esc(session()->get('image_url')); ?>
      <img src="<?= !empty($image_url) ? $image_url : "/no-profile.png" ?>" alt="Profile Picture" class="size-12 rounded-full border-2 border-gray-900">
    </button>
    <div id="profileDialog" class="hidden absolute top-14 md:top-17 lg:top-20 right-[-1rem] w-64 shadow-2xl bg-white z-50 transition-all duration-300 opacity-0 translate-y-[-10px]">
      <div class="flex flex-col items-center p-6">
        <div class="relative mb-3">
          <?php $profile_image = esc(session()->get('image_url')); ?>
          <img src="<?= !empty($profile_image) ? $profile_image : "/no-profile.png" ?>" alt="Profile Picture" class="w-20 h-20 rounded-full border-4 border-green-300 shadow">
        </div>
        <h2 class="text-lg font-semibold text-gray-800 mb-1"><?= esc(session()->get('first_name')) ?>!</h2>
        <span class="text-xs text-gray-500 mb-4"><?= esc(session()->get('role')) ?>!</span>
        <div class="flex flex-col w-full gap-2">
          <a href="/<?= esc(session()->get('role')) ?>/profile" class="w-full text-center py-2 px-4 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">View Profile</a>
          <form action="/logout" method="post" class="w-full">
            <button type="submit" class="w-full text-center py-2 px-4 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition">
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

</header>