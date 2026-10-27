var weatherForm = document.getElementById("weather-form");
var cityInput = document.getElementById("city");
var loadingMessage = document.getElementById("loading-message");
var errorMessage = document.getElementById("error-message");
var weatherCard = document.getElementById("weather-card");

weatherForm.addEventListener("submit", function (event) {
  event.preventDefault();

  var city = cityInput.value.trim();
  resetMessages();

  if (city === "") {
    showError("Please enter a city name.");
    return;
  }

  loadingMessage.hidden = false;

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "weather.json", true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) {
      return;
    }

    loadingMessage.hidden = true;

    if (xhr.status < 200 || xhr.status >= 300) {
      showError("Unable to fetch weather data.");
      return;
    }

    try {
      var weatherList = JSON.parse(xhr.responseText);
      var weatherData = findCity(weatherList, city);

      if (weatherData === null) {
        showError("City not found.");
        return;
      }

      displayWeather(weatherData);
    } catch (error) {
      showError("Unable to fetch weather data. The JSON response is invalid.");
    }
  };

  xhr.onerror = function () {
    loadingMessage.hidden = true;
    showError("Unable to fetch weather data. Please check the local file path.");
  };

  xhr.send();
});

function findCity(weatherList, cityName) {
  if (!Array.isArray(weatherList)) {
    throw new Error("The response is not a list of weather records.");
  }

  var requestedCity = cityName.toLowerCase();

  for (var index = 0; index < weatherList.length; index++) {
    if (weatherList[index].city.toLowerCase() === requestedCity) {
      validateWeatherData(weatherList[index]);
      return weatherList[index];
    }
  }

  return null;
}

function validateWeatherData(weatherData) {
  var requiredFields = ["city", "temperature", "condition", "humidity", "wind"];

  requiredFields.forEach(function (field) {
    if (!(field in weatherData)) {
      throw new Error("Missing weather field: " + field);
    }
  });
}

function displayWeather(weatherData) {
  document.getElementById("weather-city").textContent = weatherData.city;
  document.getElementById("weather-temperature").textContent = weatherData.temperature;
  document.getElementById("weather-condition").textContent = weatherData.condition;
  document.getElementById("weather-humidity").textContent = weatherData.humidity;
  document.getElementById("weather-wind").textContent = weatherData.wind;
  weatherCard.hidden = false;
}

function resetMessages() {
  loadingMessage.hidden = true;
  errorMessage.hidden = true;
  weatherCard.hidden = true;
}

function showError(message) {
  errorMessage.textContent = message;
  errorMessage.hidden = false;
}
