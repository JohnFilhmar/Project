// Expose profile handler globally
export function handleProfile() {
  const profileDiv = document.getElementById("profileDialog");
  if (!profileDiv) return;

  function closeDialog() {
    profileDiv.classList.remove("opacity-100", "translate-y-0");
    profileDiv.classList.add("opacity-0", "translate-y-[-10px]");
    setTimeout(() => {
      profileDiv.classList.add("hidden");
    }, 300);
    document.removeEventListener("mousedown", handleOutsideClick);
  }

  function handleOutsideClick(event) {
    if (
      !profileDiv.classList.contains("hidden") &&
      !profileDiv.contains(event.target)
    ) {
      closeDialog();
    }
  }

  if (profileDiv.classList.contains("hidden")) {
    profileDiv.classList.remove("hidden");
    setTimeout(() => {
      profileDiv.classList.remove("opacity-0", "translate-y-[-10px]");
      profileDiv.classList.add("opacity-100", "translate-y-0");
    }, 10);
    document.addEventListener("mousedown", handleOutsideClick);
  } else {
    closeDialog();
  }
}
window.handleProfile = handleProfile;

export function toggleImageInputs() {
  const imageUrl = document.getElementById("image_url");
  const imageFile = document.getElementById("image_file");
  const removeBtn = document.getElementById("removeImageFileBtn");
  // If image_url has value, disable image_file
  if (imageUrl && imageUrl.value.trim() !== "") {
    imageFile.disabled = true;
    removeBtn.style.display = "none";
    imageFile.value = "";
  } else {
    if (imageUrl) {
      imageFile.disabled = false;
    }
    if (imageFile.files.length > 0) {
      if (imageUrl) {
        imageUrl.disabled = true;
      }
      removeBtn.style.display = "";
    } else {
      if (imageUrl) {
        imageUrl.disabled = false;
      }
      removeBtn.style.display = "none";
    }
  }
}
window.toggleImageInputs = toggleImageInputs;

export function removeImageFile() {
  const imageFile = document.getElementById("image_file");
  const removeBtn = document.getElementById("removeImageFileBtn");
  imageFile.value = "";
  document.getElementById("image_url").disabled = false;
  removeBtn.style.display = "none";
  toggleImageInputs();
}
document.addEventListener("DOMContentLoaded", function () {
  toggleImageInputs();
});
window.removeImageFile = removeImageFile;

// Campaigns modal edit toggle
export function openEditCampaign(button) {
  const modal = document.getElementById("addCampaignModal");
  const form = document.getElementById("addCampaignForm");
  const title = document.getElementById("campaignFormTitle");
  document.getElementById("partylist").value = button.dataset.partylist || "";
  document.getElementById("campaign_name").value =
    button.dataset.campaign_name || "";
  document.getElementById("description").value =
    button.dataset.description || "";
  document.getElementById("image_url").value = button.dataset.image_url || "";
  document.getElementById("image_file").value = "";
  title.textContent = button.dataset.form_title || "Add New Campaign";
  toggleImageInputs();
  if (button.dataset.url) {
    form.action = button.dataset.url;
  } else {
    form.action = "/campaigns/create";
  }
  modal.showModal();
}
window.openEditCampaign = openEditCampaign;

// Profile Modal Edit Toggle
export function openEditProfile(button) {
  const modal = document.getElementById("addStudentModal");
  const form = document.getElementById("addStudentForm");
  const title = document.getElementById("studentFormTitle");
  document.getElementById("student_number").value =
    button.dataset.student_number || "";
  document.getElementById("first_name").value = button.dataset.first_name || "";
  document.getElementById("middle_name").value =
    button.dataset.middle_name || "";
  document.getElementById("last_name").value = button.dataset.last_name || "";
  document.getElementById("sex").value = button.dataset.sex || "";
  document.getElementById("course").value = button.dataset.course || "";
  document.getElementById("year_level").value = button.dataset.year_level || "";
  document.getElementById("email").value = button.dataset.email || "";
  document.getElementById("organization_id").value =
    button.dataset.organization || "";
  title.textContent = button.dataset.form_title || "Add Student Profile";
  toggleImageInputs();
  form.action = button.dataset.url || "/students/create";
  modal.showModal();
}
window.openEditProfile = openEditProfile;

// DOM Ready block for all features
document.addEventListener("DOMContentLoaded", () => {
  // Swiper: Campaigns
  new Swiper(".swiper.campaigns-swiper", {
    loop: true,
    allowTouchMove: false,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
    speed: 10000,
    slidesPerView: "auto",
    spaceBetween: 32,
    breakpoints: {
      640: { slidesPerView: 1, spaceBetween: 30 },
      768: { slidesPerView: 2, spaceBetween: 30 },
      1020: { slidesPerView: 3, spaceBetween: 30 },
      1700: { slidesPerView: 4, spaceBetween: 30 },
    },
  });

  // Swiper: Candidates
  new Swiper(".swiper.candidates-swiper", {
    loop: true,
    autoplay: {
      delay: 800,
      disableOnInteraction: true,
    },
    breakpoints: {
      640: { slidesPerView: 1, spaceBetween: 30 },
      768: { slidesPerView: 2, spaceBetween: 30 },
      1024: { slidesPerView: 3, spaceBetween: 30 },
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });

  // DataTables config
  $.fn.dataTable.ext.errMode = "none";
  function styleDataTable(tableId, color = "green") {
    const $filterInput = $(`#${tableId}_filter input`);
    $filterInput
      .addClass(
        "form-input px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
      )
      .css({ width: "200px", marginLeft: "0.5em" });

    $(`#${tableId}_paginate`).addClass("flex gap-2 items-center mt-4");
    $(`#${tableId}_paginate .paginate_button`)
      .addClass(`px-3 py-1 rounded-md border bg-${color}-100 text-${color}-700`)
      .css({ margin: "0 2px" });
    $(`#${tableId}_paginate .paginate_button.current`)
      .removeClass(`bg-${color}-100`)
      .addClass(
        `text-${color}-700 bg-${color}-200 border-${color}-500 hover:bg-${color}-700 hover:text-${color}-200 border-2 border-${color}-700`
      );

    const $length = $(`#${tableId}_length`);
    const $filter = $(`#${tableId}_filter`);
    if ($length.parent(".dt-header-flex").length === 0) {
      $length
        .add($filter)
        .wrapAll(
          '<div class="dt-header-flex flex justify-between items-center mb-4"></div>'
        );
    }

    const $info = $(`#${tableId}_info`);
    const $paginate = $(`#${tableId}_paginate`);
    if ($info.parent(".dt-footer-flex").length === 0) {
      $info
        .add($paginate)
        .wrapAll(
          '<div class="dt-footer-flex flex justify-between items-center mt-2"></div>'
        );
    }
  }

  const tables = [
    { id: "studentsTable", placeholder: "Search students..." },
    { id: "organizationTable", placeholder: "Search organization..." },
    { id: "positionTable", placeholder: "Search positions..." },
    { id: "candidatesTable", placeholder: "Search candidates..." },
  ];

  tables.forEach(({ id, color = "green", placeholder }) => {
    if ($(`#${id}`).length) {
      $(`#${id}`).DataTable({
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: placeholder,
        },
        pageLength: 10,
        drawCallback: () => styleDataTable(id, color),
      });
    }
  });

  // Auto-hide notifications
  const notif = document.getElementById("notification");
  if (notif) {
    setTimeout(() => {
      notif.classList.add("opacity-0");
      setTimeout(() => notif.remove(), 300);
    }, 5000);
  }
});

// Mobile menu toggle
const mobileMenu = document.getElementById("mobileMenu");
const mobileMenuButton = document.getElementById("mobileMenuButton");

if (mobileMenu && mobileMenuButton) {
  function showMobileMenu() {
    mobileMenu.classList.remove("hidden");
    setTimeout(() => {
      mobileMenu.classList.remove("opacity-0", "translate-y-[-10px]");
      mobileMenu.classList.add("opacity-100", "translate-y-0");
    }, 10);
  }

  function hideMobileMenu() {
    mobileMenu.classList.remove("opacity-100", "translate-y-0");
    mobileMenu.classList.add("opacity-0", "translate-y-[-10px]");
    setTimeout(() => {
      mobileMenu.classList.add("hidden");
    }, 300);
  }

  mobileMenuButton.addEventListener("click", (e) => {
    e.stopPropagation();
    mobileMenu.classList.contains("hidden")
      ? showMobileMenu()
      : hideMobileMenu();
  });

  document.addEventListener("click", (event) => {
    if (
      !mobileMenu.contains(event.target) &&
      !mobileMenuButton.contains(event.target)
    ) {
      if (!mobileMenu.classList.contains("hidden")) {
        hideMobileMenu();
      }
    }
  });
}

// Voters dropdown
const btn = document.getElementById("toggleVotersBtn");
const dropdown = document.getElementById("votersDropdown");
let open = false;

if (btn && dropdown) {
  btn.addEventListener("click", () => {
    open = !open;
    if (open) {
      dropdown.classList.remove(
        "opacity-0",
        "pointer-events-none",
        "translate-y-[-10px]"
      );
      dropdown.classList.add(
        "opacity-100",
        "pointer-events-auto",
        "translate-y-0"
      );
    } else {
      dropdown.classList.remove(
        "opacity-100",
        "pointer-events-auto",
        "translate-y-0"
      );
      dropdown.classList.add(
        "opacity-0",
        "pointer-events-none",
        "translate-y-[-10px]"
      );
    }
  });

  document.addEventListener("click", (e) => {
    if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.remove(
        "opacity-100",
        "pointer-events-auto",
        "translate-y-0"
      );
      dropdown.classList.add(
        "opacity-0",
        "pointer-events-none",
        "translate-y-[-10px]"
      );
      open = false;
    }
  });
}
const electionForm = document.getElementById("electionForm");
const organizationDropdown = document.getElementById("organization_id");

// Auto-fill form fields
function fillElectionForm(data) {
  document.getElementById("title").value = data.title || "";
  document.getElementById("start_date").value = data.start_date || "";
  document.getElementById("start_time").value = data.start_time || "";
  document.getElementById("end_date").value = data.end_date || "";
  document.getElementById("end_time").value = data.end_time || "";
  document.getElementById("submitElectionButton").textContent = data.title
    ? `Update ${data.title} Election Date and Time`
    : "Set Election Date and Time";
  electionForm.action = data.election_id
    ? `/admin/profile/election/update/${data.election_id}`
    : `/admin/profile/election/create`;
}

// Fetch all organizations and their IDs
async function getOrganizationIdByName(name) {
  try {
    const res = await fetch(
      `/admin/profile/organization/search/${encodeURIComponent(name)}`
    );
    const data = await res.json();
    return data.organization_id || "";
  } catch (err) {
    console.error("Error fetching organization ID:", err);
    return "";
  }
}

// Load organizations and populate dropdown
async function loadOrganizations() {
  try {
    const response = await fetch(
      "/admin/profile/organization/retrieve_organizations"
    );
    const orgData = await response.json();

    if (orgData.organizations && Array.isArray(orgData.organizations)) {
      for (const name of orgData.organizations) {
        const id = await getOrganizationIdByName(name);
        if (!id) continue;
        const option = document.createElement("option");
        option.value = id;
        option.textContent = name;
        organizationDropdown.appendChild(option);
      }
    }
  } catch (err) {
    console.error("Failed to load organizations:", err);
  }
}

// Fetch elections and autofill if matching org found
async function checkElectionSchedule(orgId) {
  try {
    const res = await fetch("/admin/profile/election/retrieve");
    const elections = await res.json();

    const match = elections.find((e) => e.organization_id == orgId);
    if (match) fillElectionForm(match);
    else fillElectionForm({}); // Clear if no schedule
  } catch (err) {
    console.error("Error retrieving elections:", err);
  }
}

if (organizationDropdown) {
  document.addEventListener("DOMContentLoaded", () => {
    loadOrganizations();
    organizationDropdown.addEventListener("change", async (e) => {
      const orgId = e.target.value;
      if (orgId) {
        await checkElectionSchedule(orgId);
      } else {
        fillElectionForm({});
      }
    });
  });
}

// Ballot modal toggle
export function toggleBallotModal(force) {
  const ballotModal = document.getElementById("ballotVoteModal");
  if (!ballotModal) return;
  if (force === "open") {
    ballotModal.showModal();
    return;
  }
  if (force === "close") {
    ballotModal.close();
    return;
  }
  if (typeof ballotModal.open === "boolean" && ballotModal.open) {
    ballotModal.close();
  } else {
    ballotModal.showModal();
  }
}
window.toggleBallotModal = toggleBallotModal;

// Partylist dropdown population and button enable/disable
function getPartylist() {
  fetch("/campaigns/retrieve_partylist")
    .then((response) => response.json())
    .then((data) => {
      const partylist = document.getElementById("partylist");
      const addNewCampaignBtn = document.getElementById("addNewCampaignBtn");
      if (partylist) {
        // Clear previous options except the first
        partylist.options.length = 1;
        if (data.partylists && Array.isArray(data.partylists)) {
          if (addNewCampaignBtn) {
            addNewCampaignBtn.disabled = data.partylists.length < 1;
            addNewCampaignBtn.textContent = addNewCampaignBtn.disabled ? "There are currently no partylists" : "Add new campaign"
          }
          data.partylists.forEach(function (pl) {
            const option = document.createElement("option");
            option.value = pl;
            option.textContent = pl;
            partylist.appendChild(option);
          });
        } else if (addNewCampaignBtn) {
          addNewCampaignBtn.disabled = true;
        }
      }
    });
}

document.addEventListener("DOMContentLoaded", function () {
  getPartylist();
});
