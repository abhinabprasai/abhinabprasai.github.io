const butons = document.getElementById("button");
butons.addEventListener("click", function () {
  var find = document.getElementById("search").value;

  fetch(
    // Fetch Wolverhampton weather data from API ('API link, city name and API Key')
    "https://localhost/weatherapp/2059372_prototype2.php?city=" + find
  )
    // Convert response string to json object
    .then((a) => a.json())
    .then((a) => {
      const weatherdscprtn = a["description"];
      const ttemperature = a["temp"];
      var temperature = parseInt(ttemperature - 273.15);
      const max = a["max_temp"];
      const maxtemp = (max - 273.15).toFixed(2);
      const min = a["min_temp"];
      const mintemp = (min - 273.15).toFixed(2);
      const humidity = a["humidity"];
      const windspeed = a["windspeed"];
      const winddrction = a["wind_dir"];
      const city_name = a["city"];
      const time = a["time"];
      const icon = a["icon"];

      //Display API response in browser console
      console.log(a);

      // Retrieving element of response to the HTML
      document.getElementById("zeroth").innerHTML = city_name;
      document.getElementById("first").innerHTML = temperature + "&#176C";
      document.getElementById("second").innerHTML = weatherdscprtn;
      document.getElementById("third").innerHTML =
        "Maximum Temperature: " + maxtemp + "&#176C";
      document.getElementById("fourth").innerHTML =
        "Minimum Temperature: " + mintemp + "&#176C";
      document.getElementById("fifth").innerHTML =
        "Humidity : " + humidity + "%";
      document.getElementById("sixth").innerHTML =
        "Windspeed : " + windspeed + "km/hr";
      document.getElementById("seventh").innerHTML =
        "Wind Direction : " + winddrction + "&#176";
      document.getElementById("eighth").innerHTML = time;
      document.getElementById("ninth").innerHTML =
        "<img src = 'http://openweathermap.org/img/wn/" + icon + "@2x.png'>";
    })

    .catch((err) => {
      // Display errors in console
      console.log(err);
    });
});
function reload() {
  fetch(
    // Fetch Wolverhampton weather data from API ('API link, city name and API Key')
    "https://localhost/weatherapp/2059372_prototype2.php?city=oxford"
  )
    // Convert response string to json object
    .then((a) => a.json())
    .then((a) => {
      const weatherdscprtn = a["description"];
      const ttemperature = a["temp"];
      var temperature = parseInt(ttemperature - 273.15);
      const max = a["max_temp"];
      const maxtemp = (max - 273.15).toFixed(2);
      const min = a["min_temp"];
      const mintemp = (min - 273.15).toFixed(2);
      const humidity = a["humidity"];
      const windspeed = a["windspeed"];
      const winddrction = a["wind_dir"];
      const city_name = a["city"];
      const time = a["time"];
      const icon = a["icon"];

      //Display API response in browser console
      console.log(a);

      // Retrieving element of response to the HTML
      document.getElementById("zeroth").innerHTML = city_name;
      document.getElementById("first").innerHTML = temperature + "&#176C";
      document.getElementById("second").innerHTML = weatherdscprtn;
      document.getElementById("third").innerHTML =
        "Maximum Temperature: " + maxtemp + "&#176C";
      document.getElementById("fourth").innerHTML =
        "Minimum Temperature: " + mintemp + "&#176C";
      document.getElementById("fifth").innerHTML =
        "Humidity : " + humidity + "%";
      document.getElementById("sixth").innerHTML =
        "Windspeed : " + windspeed + "km/hr";
      document.getElementById("seventh").innerHTML =
        "Wind Direction : " + winddrction + "&#176";
      document.getElementById("eighth").innerHTML = time;
      document.getElementById("ninth").innerHTML =
        "<img src = 'http://openweathermap.org/img/wn/" + icon + "@2x.png'>";
    })
    .catch((err) => {
      // Display errors in console
      console.log(err);
    });
}
