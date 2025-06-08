export function handleProfile() {
  const profileDiv = document.getElementById("profileDialog");
  if (!profileDiv) return;

  // Helper to close the dialog with animation
  function closeDialog() {
    profileDiv.classList.remove("opacity-100", "translate-y-0");
    profileDiv.classList.add("opacity-0", "translate-y-[-10px]");
    setTimeout(() => {
      profileDiv.classList.add("hidden");
    }, 300);
    document.removeEventListener("mousedown", handleOutsideClick);
  }

  // Handler for outside clicks
  function handleOutsideClick(event) {
    if (
      !profileDiv.classList.contains("hidden") &&
      !profileDiv.contains(event.target)
    ) {
      closeDialog();
    }
  }

  // If dialog is hidden, open it and add listener
  if (profileDiv.classList.contains("hidden")) {
    profileDiv.classList.remove("hidden");
    setTimeout(() => {
      profileDiv.classList.remove("opacity-0", "translate-y-[-10px]");
      profileDiv.classList.add("opacity-100", "translate-y-0");
    }, 10);
    document.addEventListener("mousedown", handleOutsideClick);
  } else {
    // If dialog is open, close it and remove listener
    closeDialog();
  }
}
window.handleProfile = handleProfile;

const mobileMenu = document.getElementById("mobileMenu");
const mobileMenuButton = document.getElementById("mobileMenuButton");

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

mobileMenuButton.addEventListener("click", function (e) {
  e.stopPropagation();
  if (mobileMenu.classList.contains("hidden")) {
    showMobileMenu();
  } else {
    hideMobileMenu();
  }
});

document.addEventListener("click", function (event) {
  if (
    !mobileMenu.contains(event.target) &&
    !mobileMenuButton.contains(event.target)
  ) {
    if (!mobileMenu.classList.contains("hidden")) {
      hideMobileMenu();
    }
  }
});

document.addEventListener("DOMContentLoaded", () => {
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
      640: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1020: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1700: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
    },
  });
});

document.addEventListener("DOMContentLoaded", () => {
  new Swiper(".swiper.candidates-swiper", {
    loop: true,
    autoplay: {
      delay: 800,
      disableOnInteraction: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });
});

$(document).ready(function () {
  $("#studentsTable").DataTable({
    responsive: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search students...",
    },
    pageLength: 10,
  });
});
