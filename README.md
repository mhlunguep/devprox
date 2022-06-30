
# Devprox: PHP Developer e-commerce platform Skills Assessment
### To set up this project on your local match you will need the following:
1.	Composer, you don’t have it you can download it here https://getcomposer.org/
2.	Latest version of  Node Js https://nodejs.org/en/ , LTS will do.
3.	PHP local server, I use XAMPP but you can use any i.e WAMP as long as you have PHP 8.1.6 and Apache 
4.	Download or clone this project to your machine. 
5.	On your server create a virtual host, my is devprox.test
a.	Your virtual server must point to the public folder of of this project i.e …\devprox\public 
6.	Login to phpmyadmin
a.	Create a database name i.e devprox
b.	Open the project files, go to resources/assets/sql
c.	Import those empty tables to your database you have created. 
7.	Go back to the files on the root folder of the project look for the "env example" rename so that it reads .env without ‘example’
a.	Open this file and update the #database details section to match what you have created in step 6
i.	DB_NAME = database name 
ii.	DB_USERNAME = your username 
iii.	DB_PASSWORD = your password
###	8.	Now open this project with your text editor and run the following commands
			a.	Composer update
			b.	Npm install
9.	View this project on the browser
