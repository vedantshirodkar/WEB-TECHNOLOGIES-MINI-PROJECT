function showDetailsForm() {
  const state = document.getElementById("state").value;
  if (state === "") {
    alert("Please select a state before continuing.");
    return;
  }

  document.getElementById("detailsForm").style.display = "block";
  document.getElementById("stateForm").style.display = "none";
}

document.getElementById("detailsForm").addEventListener("submit", function(event) {
  event.preventDefault();

  alert("Pickup request submitted successfully!");
  window.location.href = "home.html"; 
});
