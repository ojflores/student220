# Homework 5: Forms

In this assignment you will build on the library application you wrote for the previous coding assignment.
You will rework the structure of your library application and add several new features utilizing query strings and form controls.
As before, a reference implementation is available for examination.
Use it as a starting point, but make the application your own by styling with CSS or adding additional features not included in the reference.
Here are the specific things your implementation must include.

## Assignment Specifications

You must consolidate the four pages you previously wrote into a single-page web application.
That is, instead of having a separate script for the homepage, list of books, author list, and series list, you must have a single index.php script that adapts to show each of these (and any new features added below) based on a parameter passed in the query string.

You must add the following new features:

* The ability to click on an item in a list (book, author, or series) and reload the page to bring up details about that item.
    For example:
  * clicking on a book would show all the information about that book contained in the CSV file.
  * clicking on an author would bring up a list of all books written by that author.
  * clicking on a series name would bring up a list of all books in the series.
* A search page that allows searching the list of books by title, publication date, number of pages, author, or ISBN.
* The ability for users to upload images of book covers (of limited file size) to your website.
    These images should be stored by book ID number in a subdirectory and displayed on the book detail page when available.

Additional notes:

* Be sure to utilize appropriate web standards and validate your HTML and CSS.
* Before you begin the assignment, estimate the time you believe it will take you to complete the assignment.
    Then log your time and submit both your initial estimate and the final time that it took.

Because this assignment requires that you write PHP code that is interpreted on a web server, you will need use your local web server (from Vagrant) and deploy on your public CS web server.

**Questions?**

Ask your instructor right away so that you don't waste time going down a dead end.