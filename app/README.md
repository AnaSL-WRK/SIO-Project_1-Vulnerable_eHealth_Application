# APP Folder

## Description

This folder contains the insecure version of the application eHealth.

## How to run it

Inside the directory ```app/``` use the command ```docker-compose up``` to build the container and run it.  
In order to access the database info, import the file [SIO.sql](app/SIO.sql) into PHPMyAdmin


## Ports

### **Database:**  

**phpMyAdmin:**   http://localhost:8080  
**Server:** db  
**Username:**  root  
**Password:**  root

<br>

### **Application:**

**Host**: http://localhost:8000 

<br>

## Login information for Created Users and Uploaded Exam Codes

### Admin:
**Email:** eHealth@ies.com  
**NHS:** 111111111  
**Password:** admin



### User:
**Email:** mdl123@gmail.com  
**NHS:** 987654321  
**Password:** mdl123  
**Exam Codes:** - 999999999 (already downloaded) (a Lorem Ipsum pdf)  
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;- 123123123 (malicious.pdf.php, does nothing)  
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;- 666666666 (to download) (script.bat) (when executed, opens cmd and loops the tree command)

