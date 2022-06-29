# Devprox: PHP Developer e-commerce platform Skills Assessment

### Setting up this project on your local machine you will need:
1. Composer installed in your computer, if you don't have it you can downnload it it here https://getcomposer.org/download/
2. Nodejs https://nodejs.org/en/, the LTS version 
3. PHP local server, I am using XAMPP (https://www.apachefriends.org/) but you can use Wampsever or any other php server, as long as you have Apache and MySQL
4. Set up Vhost to http://devprox.test/
5. Clone or download this project to your machine
6. Open it with your text editor

### Use your terminal to run
	1. composer update 
	2. npm update

### Now let's set up your database
1. Go to your phpmyadmin and create a database name, username, and password
2. On the root folder of this project, look for .env example rename this file to .env
3. Open it and update with the details you created on your phpmyadmin
4. Import the sql table on the database you have created, you can find it on resources/assets/sql

#### The project is now ready
On your browser type http://devprox.test/
