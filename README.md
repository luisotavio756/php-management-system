
<img src="https://res.cloudinary.com/luisotavio756/image/upload/v1590070452/0_9_cj4jwc.jpg"/>

[See a Demo](https://res.cloudinary.com/luisotavio756/image/upload/v1590021020/20200520_212423_hibys8.gif)
<h1 align="center">
   Dashboard Management System 
</h1>

<h4 align="center">
  A Dashboard for Management Companies. With modules to Front Box, management Tables and Product of Companies, management Users e Profile.  
</h4>
<p align="center">
  <a href="#rocket-technologies">Technologies</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#information_source-how-to-use">How To Use</a>&nbsp;&nbsp;&nbsp;
</p>

## :rocket: Technologies

This project was developed in Work Project in my Business from University, but i am allowing here, with the purpose of Open Source and that contributors can upgrade this :

-  [PHP](https://php.net)
-  [Bootstrap](https://getbootstrap.com)
-  [MySQL](https://mysql.com)

## :information_source: How To Use

To run this application, you'll need clone and modify some files, and after open in your Browser. Steps:

```bash
1 - Clone this repository
$ git clone https://github.com/luisotavio756/management-system.git

2 - Go into the repository
$ cd management-system

3 - Create database in your localhost and Import DataBase file:
$ cd app/config/config.php

<?php

	// Update your DB Params
	define('DB_HOST',  'localhost');
	define('DB_USER',  'root');
	define('DB_PASS',  '');
	define('DB_NAME',  'assakabrasa');

	// Update your URL Root
	define('URLROOT',  'http://localhost/Assakabrasa');

	// Update your Site Name
	define('SITENAME',  'Assakabrasa');

?>


4 - Update .htaccess in `cd public/.htaccess`:

<IfModule mod_rewrite.c>
  Options -Multiviews
  RewriteEngine On
  RewriteBase /Assakabrasa/public
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule  ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>

# Assakabrasa is default, but your can update from your folder name

5 - Start Apache and MySQL in Wampp, Xampp or other and open in your Browser:

`http://localhost/Assakabrasa`
# Now enjoy !
```

Made with ♥ by Luis Otávio :wave:<br />
✔ [Visit my LinkedIn](https://www.linkedin.com/in/lu%C3%ADs-ot%C3%A1vio-87851517a/)<br />
✔ [Visit my WhatsApp](https://api.whatsapp.com/send?phone=+5588997542399)<br />
✔ [Visit my Instagram](https://instagram.com/luisotaviioc)

