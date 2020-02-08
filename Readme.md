# Description
This is a Beginer level project developed using PHP-7 and MySQL. You can configure it on your machine by following the below installation steps. Further more this project has two end-users, one for the **Customer** and one for the **Administrator**.

The **Customer** is able to do the following:
-	Browse through the categories and products available and should be able to add products to the shopping cart.
-	Customer should be able to specify the quantity of the products required.
-	Complete / Finalize the order.
-	The Customer should be able to search a product by name.

The **Administrator** is able to do the following:
-  Add/Delete categories and products into the website.
-	Update the information for the existing products.
-	Maintenance of the web site

# Installation
Follow These Steps to configure this project on your localhost.

## Step 0: (Initialize)
- open xampp control panel.
- start "Apache" and "MySql".
- open chrome and goto http://localhost/phpmyadmin/

## Step 1: (Database Import)
- In "phpmyadmin" create a new database. The name of the new database should be "hashtag".
- Import "hashtag.sql" file inside this newely created DB.  You can find the hashtag.sql file inside the "database" folder of this project.

## Step 2: (copy in htdocs)
- copy the **hashtag** folder with it's content inside your xampp's htdocs folder. The default location of xampp's htdocs is *C:\xampp\htdocs*.


## Step 3: (config)
If you followed the step 1 and step 2 as it is then you are good to go on step 4 , but if you have changed something like database name or folder name then follow along

open **config.php** inside "hashtag\config". and set the database name, username and password.

otherwise if you have changed the folder name from "hashtag" to something else then you should also change the $rootUrl too. for example you copied the content of hashtag folder and copied it into a folder named "newfolder" then $rootUrl should be like this
`$rootUrl = 'http://localhost/newfolder';`


## Step 4: (Preview)
- open chrome and goto http://localhost/hashtag/.
- open another tab in chrome and goto http://localhost/hashtag/dashboard/. on dashboard you will see a login screen. The Default Credentials are
   - **Email:** admin
   - **Password:** admin


# Tables
![picture alt](https://github.com/izhan25/Hashtag/blob/master/database/ERD.JPG?raw=true "Title is optional")
