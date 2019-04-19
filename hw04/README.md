# Homework 4: PHP

Your task for this assignment is to create a set of dynamic web pages to display the contents of a library stored in CSV files.
You will write PHP scripts to read those CSV files and display their contents in a nicely-formatted set of web pages.
A [bare-bones sample](http://cptr220.cs.wallawalla.edu/chapter05/library/) implementation of this assignment is provided, but don't let this limit your imagination!
Here are the specific things your implementation must include.

## Assignment Specifications

You must have the following pages:

* **index.php** -- homepage that gives the number of unique books, authors, and series in the library.
* **books.php** -- displays book information, including a list of authors for each book, and the series to which the book belongs if appropriate.
* **authors.php** -- displays a list of authors and some information (count, titles, etc) about the books they have written.
* **series.php** -- displays a list of series and some information (titles, numbers, authors, etc) about the books in that series.

Your implementation must:

* read the library data from the provided CSV files.
    You may not create an SQL database or hard-code this into your scripts.
* use include files for any duplicate PHP or HTML code.
    That is, don't cut-and-paste code between files.
* provide some form of navigation between pages, but you may not make use of the PHP _GET, _POST, or _REQUEST variables (no "form" input just yet).
* use CSS for layout and formatting to make your pages "look nice."

Additional notes:

* Be sure to utilize appropriate web standards and validate your HTML and CSS.
    Please include the validation link in your website footer.
* Before you begin the assignment, estimate the time you believe it will take you to complete the assignment.
    Then log your time and submit both your initial estimate and the final time that it took.

Because this assignment requires that you write PHP code that is interpreted on a web server, you will need use your local web server (from Vagrant) and deploy on your public CS web server.

**Questions?**

Ask your instructor right away so that you don't waste time going down a dead end.