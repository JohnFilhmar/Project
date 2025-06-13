<div id="votersDropdown" class="absolute right-0 p-2 mt-2 w-64 bg-white border border-gray-200 rounded shadow-lg opacity-0 pointer-events-none translate-y-[-10px] transition-all duration-300 z-10">
  <canvas id="votersPieChart" width="250" height="250"></canvas>
  <script>
    // Example values; replace with your actual data
    const voted = 120;
    const notVoted = 80;

    const ctx = document.getElementById('votersPieChart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Voted', 'Not Voted'],
        datasets: [{
          data: [voted, notVoted],
          backgroundColor: ['#4ade80', '#f87171'],
        }]
      },
      options: {
        responsive: false,
        plugins: {
          legend: {
            display: true,
            position: 'bottom'
          }
        }
      }
    });
  </script>
</div>