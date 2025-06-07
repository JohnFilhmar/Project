<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold my-6 md:my-8 lg:my-10">Ongoing Campaigns</h1>
<p class="text-base text-gray-700 italic mb-8 max-w-2xl mx-auto bg-yellow-50 rounded-lg shadow-md p-6 tracking-in-expand duration-700">
  Explore ongoing campaigns and learn more about each partylist's goals and objectives.
</p>
<button
  onclick="document.getElementById('addCampaignModal').showModal();"
  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded drop-shadow-lg transition duration-300 ease-in-out mb-6 animate-pulse"
  type="button">
  Add New Campaign
</button>

<!-- MODAL FOR ADDING NEW CAMPAIGN -->
<?= view('admin/campaigns_add_modal') ?>

<div class="mt-4 w-full max-w-9xl mx-auto">

  <div class="swiper campaigns-swiper">
    <div class="swiper-wrapper">
      <!-- Card 1 -->
      <div class="swiper-slide">
        <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
          <img class="w-full h-80 object-cover" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Campaign 1">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Clean City Initiative</div>
            <p class="text-gray-700 text-base">
              Join our mission to keep the city clean and green. Participate in community clean-up drives and awareness campaigns.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="swiper-slide">
        <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
          <img class="w-full h-80 object-cover" src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80" alt="Campaign 2">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Youth Empowerment</div>
            <p class="text-gray-700 text-base">
              Empowering the youth through education and skill-building workshops. Be part of the change for a brighter future.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="swiper-slide">
        <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
          <img class="w-full h-80 object-cover" src="https://ix-marketing.imgix.net/autotagging.png?auto=format,compress&w=1946" alt="Tree Planting Drive">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Tree Planting Drive</div>
            <p class="text-gray-700 text-base">
              Join our environmental initiative to plant trees and restore green spaces in urban communities for a sustainable future.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="swiper-slide">
        <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
          <img class="w-full h-80 object-cover" src="https://images.unsplash.com/photo-1593642634367-d91a135587b5?auto=format&fit=crop&w=400&q=80" alt="Tech for All">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Tech for All</div>
            <p class="text-gray-700 text-base">
              Bridging the digital divide by providing free access to technology and digital literacy programs for underserved communities.
            </p>
          </div>
        </div>
      </div>
      <!-- Card 5 -->
      <div class="swiper-slide">
        <div class="mx-auto max-w-lg rounded-lg overflow-hidden shadow-lg bg-white p-2">
          <img class="w-full h-80 object-cover" src="https://media.istockphoto.com/id/636362028/photo/friendly-nurse-checks-young-patients-temperature-at-free-clinic.webp?a=1&b=1&s=612x612&w=0&k=20&c=CPPMaGRKhqB-Pdez6d5sVnCe7mlWmlf1V_ELa1PUZxU=" alt="Community Health Fair">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Community Health Fair</div>
            <p class="text-gray-700 text-base">
              Promoting wellness by offering free health check-ups, consultations, and fitness activities to all members of the community.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>