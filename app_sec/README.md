# APP_SEC Folder

## Description

This folder contains the secure version of the application eHealth.

## How to run it

Inside the directory ```app_sec/``` use the command ```docker-compose up``` to build the container and run it.

In order to access the database info, import the file [SIO.sql](app_sec/SIO.sql) into PHPMyAdmin

## Ports

### **Database:**  

**phpMyAdmin:**   http://localhost:7080  
**Server:** db  
**Username:**  root  
**Password:**  root

<br>

### **Application:**

**Host**: http://localhost:4000 

<br>

## Login information for Created Users and Uploaded Exam Codes

### Admin:
**Email:** eHealth@ies.com  
**NHS:** 111111111   
**Password:** Admin-000



### User:
**Email:** mdl123@gmail.com  
**NHS:** 987654321  
**Password:** MariaDL123!  
**Exam Codes:** - 888888888 (already downloaded) (a Lorem Ipsum pdf)  
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;- 999999999 (to download) (a Lorem Ipsum pdf)

