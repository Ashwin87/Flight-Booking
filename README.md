Flight Booking Project

Technologies used
1.	Mysql Server Version 5.6
2.	Apache Web Server 2.4.7
3.	PHP 5.6.31

MySQL Server
MySQL Server is an RDBMS which stores flight data. It has 2 major tables – Airports and Routes 
Airports table lists all the airports in Canada. This table has the name, airport id, city and country details
Routes table has all the routes connecting the airports. This table has departure airport and arrival airport information with number of stops, flight duration, cost, start date and time and end date and time.

Apache Web Server
This is a light weight web application container which supports PHP for server-side scripting. PHP PDO framework is used to connect to the My SQL Server and access data. Apache Server is a multi-threaded web server and it can handle about 100 concurrent requests per second per server.

PHP
PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language. PHP code may be embedded into HTML code, or it can be used in combination with various web template systems, web content management systems, and web frameworks. PHP code is usually processed by a PHP interpreter implemented as a module in the web server or as a Common Gateway Interface (CGI) executable. The web server combines the results of the interpreted and executed PHP code, which may be any type of data, including images, with the generated web page. PHP code may also be executed with a command-line interface (CLI) and can be used to implement standalone graphical applications.

Installation steps:
1.	Unzip the flight.zip file. This will create flight.sql file.
2.	Load data from flight.sql into mysql using the command mysql –u<uid>  –p<pwd> -h<host> <flight.sql
3.	Copy flight-booking folder into wamp/www/ folder
4.	Index.php – This is the entry point of the application
5.	Db.php – this has the MySQL utilities
6.	Config.php – this has the database user name and password
//end of document

