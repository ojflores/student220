```
WILL NOT GRADE

Please focus on studing the Document Object Model (DOM) and preparing for the practical portion of the final exam which will be given to you on Monday.
```

# Homework 9: The Document Object Model (DOM)

Your task in this assignment is to modify your JavaScript wheel-of-fortune game to make use of JavaScript for styling and pop-up windows via the DOM.
Here are the specific things your implementation must include.

## Assignment Specifications

You must have the following files:

* **index.html** -- homepage for your application that is the only page the user accesses directly.
* **javascript_data.php** -- this file should contain your JavaScript and the PHP code that generates an array of puzzles based on the CSV file.
* **javascript.js** -- this file should contain your JavaScript and main program except the data coming from **javascript_data.php**.
* **puzzles.csv** -- this is the CSV file with puzzles which you will download as described below.
* **index.css** -- this is your CSS file to style your game.

You should implement the following new features in JavaScript and/or CSS:

* The player must be able to adjust the size of the letters on the game board in real time via a form control.
* You must display the results of each move in a div (not an input box).
    For example, if the player spins, report the amount he or she will receive for each letter in your div.
* At the end of the game, you must pop-up a div with either a congratulatory message if the player won (including the amount), or condolences if they went bankrupt.

Additional Notes:

* Use unobtrusive styling wherever possible.
    That is, create classes in your CSS file and use JavaScript to set the class of a group of elements in the DOM instead of interacting with the elements' styles directly.
* If you do not yet have the game fully functional for the last assignment, you can still implement these parts of the game and turn it in for full credit.
* Be sure to utilize appropriate web standards and validate your HTML, CSS, and JavaScript.
* Before you begin the assignment estimate the time you believe it it will take you to complete the assignment.
    Then log your time and submit both your initial time estimate and the final time that it took you using an assignment submission template.
