
const apiKey = "OraJntZ05UyOccA7L6E4";

const centers = {
  maharashtra: {
    andheri: ["Green Earth Center", "Eco Cycle"],
    dadar: ["Recycle Hub - Dadar"],
    pune: ["EcoPoint - Hinjewadi", "CleanZone - Shivajinagar"]
  },
  karnataka: {
    bangalore: ["GreenBin - Koramangala", "ReWaste - Whitefield"],
    mysore: ["WasteCare - VV Mohalla"]
  },
  delhi: {
    delhi: ["EcoDrop Center - Rohini", "GreenWay - Saket"]
  }
};

// --- Geocoding to fetch map coordinates ---
async function getCoordinates(location) {
  try {
    const response = await fetch(
      `https://api.maptiler.com/geocoding/${encodeURIComponent(location)}.json?key=${apiKey}`
    );
    const data = await response.json();
    if (data.features && data.features.length > 0) {
      return data.features[0].geometry.coordinates; // [lng, lat]
    }
  } catch (err) {
    console.error("Geocoding error:", err);
  }
  return [77.5946, 12.9716]; // Default (Bangalore)
}


document.getElementById("searchBtn").addEventListener("click", async function () {
  const state = document.getElementById("stateInput").value.toLowerCase().trim();
  const area = document.getElementById("areaInput").value.toLowerCase().trim();
  const results = document.getElementById("results");
  const mapDiv = document.getElementById("map");

  if (!state) {
    results.textContent = "Please enter a state name.";
    mapDiv.style.display = "none";
    return;
  }
  if (!area) {
    results.textContent = "Please enter an area name.";
    mapDiv.style.display = "none";
    return;
  }
  if (!centers[state]) {
    results.textContent = `State "${state}" not found.`;
    mapDiv.style.display = "none";
    return;
  }
  if (!centers[state][area]) {
    results.textContent = `Area "${area}" not found in state "${state}".`;
    mapDiv.style.display = "none";
    return;
  }

 
  const centersList = centers[state][area];
  results.innerHTML = `<strong>Centers in ${area}, ${state}:</strong><br><br>`;
  centersList.forEach(c => {
    results.innerHTML += `• ${c}<br>`;
  });

  
  const [lng, lat] = await getCoordinates(`${area}, ${state}`);
  showMap(lng, lat, `${area}, ${state}`);
});


let mapInstance = null;
function showMap(lng, lat, locationName) {
  const mapDiv = document.getElementById("map");
  mapDiv.style.display = "block";
  mapDiv.innerHTML = ""; 

  mapInstance = new maplibregl.Map({
    container: "map",
    style: `https://api.maptiler.com/maps/streets/style.json?key=${apiKey}`,
    center: [lng, lat],
    zoom: 12
  });

  mapInstance.addControl(new maplibregl.NavigationControl());

  new maplibregl.Marker({ color: "#e63946" })
    .setLngLat([lng, lat])
    .setPopup(new maplibregl.Popup({ offset: 25 }).setText(`📍 ${locationName}`))
    .addTo(mapInstance);

  mapInstance.addControl(
    new maplibregl.GeolocateControl({
      positionOptions: { enableHighAccuracy: true },
      trackUserLocation: true,
      showAccuracyCircle: false
    })
  );

  setTimeout(() => mapInstance.resize(), 600);
}
