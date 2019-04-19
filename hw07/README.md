# Homework 7: SQL and PHP

In this assignment, you further will refine the library application you've worked on in the last several assignments.
You will rework the library application to make use of a database instead of a CSV file and add several new features to take advantage of the flexible queries that are possible in an SQL database.
As before, a [reference](http://cptr220.cs.wallawalla.edu/chapter06/library/) implementation is available for examination.
Use it as a starting point, but make the application your own by styling with CSS or adding additional features not included in the reference.
Here are the specific things your implementation must include.

## Assignment Specifications

All library data that was previously drawn from the three CSV files must now be queried from your MySQL database.

You must add the following new features:

* The ability to sort your lists on a particular column by clicking on the column title. +++
* The ability to filter your lists based on the new "collection" field.
* An expanded search form that allows for searching by book or author name, and filtering by collection.

Additional notes:

* Be sure to utilize appropriate web standards and validate your HTML and CSS.
* Before you begin the assignment, estimate the time you believe it will take you to complete the assignment.
    Then log your time and submit both your initial estimate and the final time that it took.

Because this assignment requires that you write PHP code  and use a database, you will need use your local web server (from Vagrant) and deploy on your public CS web server.

## Setup Instructions

For both your local copy and your production VM will need the database loaded into the _library_ table.
The instructions are for Vagrant, but are similar for your production VM.

Now load the library database into your MySQL workspace by completing the following.
Make sure your vagrant VM is running.
Open up [phpmyadmin](http://192.168.33.220/phpmyadmin) log in using your database user (dbuser) and password (test123).
Navigate to _library_ database and import the following file:

* public/homework/hw07/library.sql

Repeat the process for your production VM.

**Questions?**

Ask your instructor right away so that you don't waste time going down a dead end.