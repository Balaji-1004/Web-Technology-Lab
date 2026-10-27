# Exercise 10: Using jQuery AJAX and JSON to Display Books

## Aim

To use jQuery AJAX to request book data in JSON format and display the book ID, title, and price on a webpage without reloading it.

## Technologies Used

- HTML5
- CSS3
- JavaScript
- jQuery 3.7.1
- AJAX
- JSON

## Project Folder Structure

```text
exercise-10-jquery-ajax-books/
├── index.html    # Webpage structure and jQuery CDN
├── style.css     # Responsive page and book-card styling
├── script.js     # jQuery AJAX request and display logic
├── books.json    # Sample book data in JSON format
└── README.md     # Exercise details and run instructions
```

## How to Run

1. Open the `exercise-10-jquery-ajax-books` folder in Visual Studio Code.
2. Install the **Live Server** extension in VS Code, or use it if it is already installed.
3. Open `index.html` and select **Go Live** (or right-click the file and choose **Open with Live Server**).
4. In the browser, click **Load Books**.
5. Verify that at least 10 book cards appear, each showing its book ID, title, and price.
6. Open the browser Developer Tools, select the **Network** tab, and confirm the GET request for `books.json`.

Use Live Server rather than double-clicking `index.html`. Browsers can restrict AJAX requests to local files opened with a `file://` URL.

## Expected Output

The page displays the **Book Library** heading, a short description, and a **Load Books** button. After the button is clicked, the loading message appears while the request runs. On success, 12 book cards appear, each containing only:

- Book ID
- Title
- Price formatted with the Indian rupee symbol (₹)

If the file cannot be loaded or its JSON is invalid, a useful error message is displayed.

## How jQuery AJAX Works

AJAX lets the webpage request data in the background without reloading the whole page. When **Load Books** is clicked, `script.js` uses jQuery's `$.ajax()` method to send an asynchronous GET request to `books.json`. The button is disabled and the existing results are cleared during the request to avoid duplicate or confusing output.

### JSON

JSON (JavaScript Object Notation) is a text format for representing structured data. In this practical, `books.json` contains an array of book objects. Each object has only the `id`, `title`, and `price` fields. jQuery converts the JSON response to JavaScript values for the success callback.

`books.json` simulates the response from a hypothetical book API and does not contain live external API data.

### `$.ajax()` and `dataType`

The request is configured in `script.js` as follows:

```javascript
$.ajax({
  url: "books.json",
  method: "GET",
  dataType: "json",
  success: function (books) {
    // Display the returned books.
  },
  error: function (jqXHR, textStatus) {
    // Display a useful error message.
  }
});
```

- `url: "books.json"` points to the local JSON file.
- `method: "GET"` requests the data without changing it.
- `dataType: "json"` tells jQuery to parse the response as JSON.
- The `success` callback receives the parsed book array and creates a card for every book.
- The `error` callback displays a message if the request fails or the response cannot be parsed. The `complete` callback hides the loading message and re-enables the button after the request finishes.
