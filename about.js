
function toggleBio(button) {
  const bio = button.nextElementSibling;
  bio.classList.toggle("hidden");
  button.textContent = bio.classList.contains("hidden") ? "View Bio" : "Hide Bio";
}


document.getElementById("year").textContent = new Date().getFullYear();
