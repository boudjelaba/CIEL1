let cityEl = document.querySelector(".city");
let iconEl = document.querySelector(".icon");
let descriptionEl = document.querySelector(".description");
let temperatureEl = document.querySelector(".temp");
/*
* * En suivant le même principe que les lignes de code ci-dessus, déclarer :
* - Humidité : à coder
* - Vitesse du vent : à coder
* - Direction du vent : à coder
* - Pression atmosphérique en hectopascals (hPa) : à coder
* - Coordonnées GPS de la ville de rodez (Latitude et Longitude) : à coder
* - Température ressentie en °C : à coder
* - Index UV : à coder
*/

let weatherEl = document.querySelector(".weather");

let weather = {
 "apikey": "a6f6fef1470f473cb0694459230605",

 fetchWeather: function (city) {
  fetch("http://api.weatherapi.com/v1/current.json?key=a6f6fef1470f473cb0694459230605%20&lang=fr&units=metric&q=Rodez&aqi=no").then((response) => response.json()).then((data) => this.displayWeather(data));
 },

 displayWeather: function (data) {
  const { name } = data.location;
  const { icon, text } = data.current.condition;
  const { temp_c } = data.current;
  /*
  * * En suivant le même principe que les 3 lignes de 
  * * code ci-dessus et en consultant le fichier JSON, 
  * * récupérer et Coder les différents données 
  * * météorologiques demandées
  */

  cityEl.innerText = `Météo à ${name}`;
  iconEl.src = `https:`+icon;
  descriptionEl.innerText = text;
  temperatureEl.innerText = `Température : ${temp_c}°C`;
  /*
  * * En suivant le même principe que les 4 lignes de 
  * * code ci-dessus, coder les champs qui seront 
  * * affichés dans le document HTML 
  */


  weatherEl.classList.remove("loading");
 },
};

weather.fetchWeather("Rodez");
