 ## <center> **How to run E-Library System (An offline Web-based Software for Borrowing Books)** </center> ## 
 ---

 ### **First step:** ###
 Fork the repository in the given link for E-Library or you can Directly get the link for it and.

 ### **Second step:** ###
 Clone the fork repository by copying the link and go to command line and type git clone and paste the link copied ex:
```
git clone (https://)
```

### **Third step:** ###
Make sure you have a localhost server like xampp if none you download here [xampp download](https://www.apachefriends.org/download.html)

### **Fourt step:** ###
After cloning the repository it will become a folder in local machine within specific path, copy the folder and paste on xampp/htdocs/ path 

### **Fifth step:** ###
Import the elibrary_db sql file in phpmyadmin by doing this open the xampp and click start the apache and MSQL module and go to apache admin. Set your username as localhost only and no password. Now you can create database and make sure that the name of the databse is elibrary_db, after rename and save import the elibrary_db sql file from the folder paste in htdocs.

### **sixth step:** ###
You can now access in our admin login by typing:
```
localhost/elibrary/login.php
```
 **Note!** you can't go to other pages even you type the specific path because we used session function here. To enter, use the username "admin" and password "admin123"


### **seventh step:** ###
After login you are now in the full access features where you can able to preview, add, retrieve and delete entities within the database.


 
