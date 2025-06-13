<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="bg-gradient-to-br py-10 px-2 w-full">
  <div class="w-full rounded-xl shadow-2xl border border-green-200 bg-white bg-opacity-95">
    <!-- Header -->
    <div class="bg-green-800 rounded-t-xl px-8 py-6 flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-white text-3xl font-extrabold tracking-wide mb-1 drop-shadow">BALLOTS</h1>
        <p class="text-green-100 text-lg font-semibold leading-tight">YOUR VOTE COUNTS!<br>VOTE WISELY!</p>
      </div>
      <button id="openBallotModal" type="button" onclick="toggleBallotModal('open')" class="mt-4 md:mt-0 bg-green-900 text-white font-bold py-2 px-8 rounded-lg shadow-lg border-2 border-green-700 hover:bg-white hover:text-green-900 hover:border-green-900 transition text-lg">
        CAST VOTE
      </button>
      <?= view('student/ballot_vote_form', ['candidates' => $candidates]); ?>
    </div>
    <!-- Instructions -->
    <div class="px-8 py-8">
      <h2 class="text-green-700 text-2xl font-bold mb-4 text-center">Voting Instructions</h2>
      <ul class="list-disc list-inside text-gray-800 space-y-3 mb-6 text-start leading-relaxed">
        <li>Each student is allowed to vote only once. Multiple submissions or attempts to vote again will not be counted.</li>
        <li>You may only select one candidate per position, except for positions that allow multiple selections, such as Auditor, Liaison, Peace Officer, Planning Executive, and Public Information Officer.</li>
        <li>Once you submit your ballot, you cannot edit, withdraw, or change your vote. Make sure to review your selections carefully before submitting.</li>
        <li>Your vote is confidential. Do not share your login credentials or allow others to vote on your behalf. Any attempt to manipulate the voting system will be investigated.</li>
        <li>The voting system will only be available during the official election period. Votes cast before or after the designated timeframe will not be counted.</li>
        <li>All voters must respect the online voting process and not interfere with others while they cast their votes. Any act of disruption, intimidation, or spreading false information will not be tolerated.</li>
        <li>Any attempt to hack, manipulate, or disrupt the voting system will result in immediate disqualification and potential disciplinary action.</li>
        <li>It is the voter's responsibility to ensure they have a stable internet connection and a functioning device before voting. Election authorities are not liable for personal technical difficulties.</li>
        <li>Do not leave your voting session open or unattended on any device. After voting, make sure to log out to prevent unauthorized access.</li>
        <li>In case of any technical difficulties, immediately report the issue to the election officers or system administrator before the voting period ends.</li>
      </ul>
      <hr class="my-4 border-gray-300">
      <p class="text-gray-600 text-sm text-center">After submitting your vote, a confirmation message will appear. If you do not receive a confirmation, report the issue to election officials before the voting period ends.</p>
    </div>
  </div>
</div>

<!-- Make sure main.js is loaded -->
<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>