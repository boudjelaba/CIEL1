// Descriptions météo
const descriptions = {
  0: "Clair",
  1: "Plutôt clair",
  2: "Partiellement nuageux",
  3: "Nuageux",
  61: "Pluie légère",
  63: "Pluie",
  80: "Averses",
  95: "Orages"
};

// Icônes simples
const icons = {
  0: "https://img.icons8.com/fluency/96/sun.png",
  1: "https://img.icons8.com/fluency/96/partly-cloudy-day.png",
  2: "https://img.icons8.com/fluency/96/clouds.png",
  3: "https://img.icons8.com/fluency/96/cloud.png",
  61: "https://img.icons8.com/fluency/96/rain.png",
  95: "https://img.icons8.com/fluency/96/storm.png"
};

// Affiche l’heure locale
function formatLocalTime(timezone) {
  return new Date().toLocaleTimeString("fr-FR", {
    hour: "2-digit",
    minute: "2-digit",
    timeZone: timezone
  });
}

// Affichage météo
async function afficherMeteo(lat, lon, cityName) {
  const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true&daily=temperature_2m_max,temperature_2m_min,weathercode&forecast_days=4&timezone=auto`;

  const res = await fetch(url);
  const data = await res.json();

  const meteo = data.current_weather;
  document.getElementById("city-name").textContent = cityName;
  document.getElementById("time").textContent = formatLocalTime(data.timezone);

  // Météo actuelle
  document.getElementById("temp").textContent = meteo.temperature + "°C";
  document.getElementById("wind").textContent = meteo.windspeed + " km/h";
  document.getElementById("weather-description").textContent =
    descriptions[meteo.weathercode] || "Indisponible";
  document.getElementById("weather-icon").src =
    icons[meteo.weathercode] || icons[3];

  // Prévisions
  const forecastEl = document.getElementById("forecast");
  forecastEl.innerHTML = "";

  const daily = data.daily;
  for (let i = 0; i < 4; i++) {
    const date = new Date(daily.time[i]);
    const dayName = date.toLocaleDateString("fr-FR", { weekday: "long" });
    const code = daily.weathercode[i];

    const div = document.createElement("div");
    div.textContent =
      `${dayName} : ${daily.temperature_2m_max[i]}° / ${daily.temperature_2m_min[i]}° - ` +
      (descriptions[code] || "Description non programmée dans le code");

    forecastEl.appendChild(div);
  }
}

// Affichage pour Paris
afficherMeteo(48.8566, 2.3522, "Paris");
