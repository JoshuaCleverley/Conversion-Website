document.getElementById("hamburger").addEventListener("click", function () {
  // Get the hamburger and mobile nav elements
  let hamburger = document.getElementById("hamburger");
  let mobileNav = document.getElementById("mobile-nav");

  // Toggle the hamburger and mobile nav classes to change how they display
  hamburger.classList.toggle("hamburger-active");
  mobileNav.classList.toggle("mobile-nav-active");

  // Change the hamburger icon to an X when the mobile nav is open
  if (hamburger.classList.contains("hamburger-active")) {
    hamburger.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" width="24" height="24" viewBox="0 0 16 16">
      <path d="M 2.75 2.042969 L 2.042969 2.75 L 2.398438 3.101563 L 7.292969 8 L 2.042969 13.25 L 2.75 13.957031 L 8 8.707031 L 12.894531 13.605469 L 13.25 13.957031 L 13.957031 13.25 L 13.605469 12.894531 L 8.707031 8 L 13.957031 2.75 L 13.25 2.042969 L 8 7.292969 L 3.101563 2.398438 Z"></path>
    </svg>`;
  } else {
    hamburger.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" width="24" height="24"viewBox="0 0 16 16">
      <path d="M 1 2 L 1 3 L 14 3 L 14 2 Z M 1 7 L 1 8 L 14 8 L 14 7 Z M 1 12 L 1 13 L 14 13 L 14 12 Z"></path>
    </svg>`;
  }
});
