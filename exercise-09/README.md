# Exercise 9: Using AJAX with JSON for Weather Information

## Aim

To use AJAX and JSON to fetch weather information and display it dynamically on a webpage without refreshing the page.

## Technologies Used

- HTML
- CSS
- JavaScript
- XMLHttpRequest (traditional AJAX)
- JSON

## Description

This project is a simple weather information webpage. The user enters a city name and clicks **Get Weather**. JavaScript sends an AJAX GET request for the local `weather.json` file. When the response is received, the JSON text is parsed and the matching weather details are displayed in a weather card.

The local JSON response contains weather data for multiple cities:

```json
{
  "city": "Chennai",
  "temperature": 32,
  "condition": "Sunny",
  "humidity": 65,
  "wind": 12
}
```

## How AJAX Works in This Project

1. The user enters a city name and submits the form.
2. JavaScript prevents the normal page refresh.
3. An `XMLHttpRequest` object sends a GET request to `weather.json`.
4. A `Loading...` message is shown while the request is running.
5. The `onreadystatechange` handler waits until the request is complete.
6. The response status is checked for an HTTP error.
7. The JSON response is parsed using `JSON.parse()`.
8. JavaScript updates the HTML weather card using DOM manipulation.

## How JSON Is Used

The `weather.json` response is received as JSON text. `JSON.parse()` converts that text into a JavaScript array of weather objects. JavaScript searches the array for the entered city, and the values such as `temperature` and `humidity` are placed into the webpage using `textContent`.

There is no database in Exercise 9. The `weather.json` file acts as the hypothetical API response for this local demonstration.

## Project Structure

```text
exercise-09-ajax-json-weather/
├── index.html    # Webpage structure and weather card
├── style.css     # Simple webpage styling
├── script.js     # AJAX request, JSON parsing, search, and DOM updates
├── weather.json   # Local sample weather data
└── README.md     # Exercise explanation and instructions
```

## How to Run

1. Open a terminal in the `exercise-09-ajax-json-weather` folder.
2. Start a simple local server. For example, if Python is installed, run:

  ```text
  python -m http.server 8000
  ```

3. Open `http://localhost:8000` in a web browser.
4. Enter a city name, such as `Chennai`, and click **Get Weather**.

The local server is only needed because browsers may block `XMLHttpRequest` when an HTML file is opened directly with the `file://` URL. No PHP, database, Node.js, framework, or API key is required.

## Expected Output

For a successful JSON response, the weather card displays:

- City: Chennai
- Temperature: 32 °C
- Condition: Sunny
- Humidity: 65%
- Wind Speed: 12 km/h

The page also displays `Loading...` during the request and a friendly error message when the input is empty, the response is invalid, a city is not found, or the local file cannot be loaded.
