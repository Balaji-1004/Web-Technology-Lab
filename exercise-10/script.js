$(function () {
  var $loadBooksButton = $("#load-books");
  var $loadingMessage = $("#loading-message");
  var $errorMessage = $("#error-message");
  var $booksList = $("#books-list");

  $loadBooksButton.on("click", function () {
    $loadBooksButton.prop("disabled", true);
    $loadingMessage.prop("hidden", false);
    $errorMessage.prop("hidden", true).text("");
    $booksList.empty();

    $.ajax({
      url: "books.json",
      method: "GET",
      dataType: "json",
      success: function (books) {
        if (!Array.isArray(books)) {
          showError("The response did not contain a valid list of books.");
          return;
        }

        if (books.length === 0) {
          showError("No books were found.");
          return;
        }

        var hasInvalidBook = books.some(function (book) {
          if (!book || !("id" in book) || !("title" in book) || !("price" in book)) {
            return true;
          }

          return false;
        });

        if (hasInvalidBook) {
          showError("A book record is missing its ID, title, or price.");
          return;
        }

        books.forEach(function (book) {
          $booksList.append(createBookCard(book));
        });
      },
      error: function (jqXHR, textStatus) {
        var message = "Unable to load books. Please check that books.json is available.";

        if (textStatus === "parsererror") {
          message = "Unable to load books because books.json contains invalid JSON.";
        }

        showError(message);
      },
      complete: function () {
        $loadingMessage.prop("hidden", true);
        $loadBooksButton.prop("disabled", false);
      }
    });
  });

  function createBookCard(book) {
    var $card = $("<article>").addClass("book-card");
    var $title = $("<h3>").text(book.title);

    $("<p>")
      .append($("<strong>").text("Book ID: "))
      .append(document.createTextNode(book.id))
      .appendTo($card);
    $title.appendTo($card);
    $("<p>")
      .append($("<strong>").text("Price: "))
      .append(document.createTextNode("\u20b9" + book.price))
      .appendTo($card);

    return $card;
  }

  function showError(message) {
    $errorMessage.text(message).prop("hidden", false);
  }
});
