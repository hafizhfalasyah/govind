document.addEventListener("DOMContentLoaded", function () {
  // Inisialisasi map Leaflet
  const map = L.map("leafletMap", {
    center: [-7.9797, 112.6304], // Malang
    zoom: 13,
    scrollWheelZoom: false,
  });

  // Tile layer
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
  }).addTo(map);

  // Marker
  L.marker([-7.9797, 112.6304])
    .addTo(map)
    .bindPopup("Malang, Indonesia")
    .openPopup();
});

  document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("navbarToggle");
    const menu = document.getElementById("mobileMenu");

    if (toggle && menu) {
      toggle.addEventListener("click", () => {
        menu.classList.toggle("hidden");
      });
    }
  });