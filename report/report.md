# Security of Information and Organizations 2022/2023

# 1st Project - eHealth Corp

## Objective

The objective of this project was to explore and avoid software vulnerabilities, by creating two versions of a web project for a health clinic.  

The folder [app](/app) contains the insecure version of the application alongside with the instructions on how to run it. To comply with the goal of the project, it includes the mandatory vulnerabilities associated with [CWE-79](https://cwe.mitre.org/data/definitions/79.html) and [CWE-89](https://cwe.mitre.org/data/definitions/89.html) along with others (mentioned and explained later in the report), so that the sum of the [CVSS](https://www.first.org/cvss/calculator/3.1) is of at least 35.  

The folder [app_sec](/app_sec) contains the secure version of the application, containing its instructions as well.

The folder [analysis](/analysis) includes the files that will serve as a complement to this report, as it contains scripts and screenshots demonstrating the exploration of each vulnerability here described.

<br>


## Description of the Health Clinic Web Project

The eHealth website includes the possibility to Contact the clinic, Make an Appointment request and Download Clinical Exams via code without being logged in.

While logged in as a user (you have the possibility of sign-up within the page) not only you can access the previous features but also have the option to change your account information as well as download clinical exams via code and re-downloading previously downloaded exams.

When logged in as Admin, you are able to Upload clinical exams along with the associated code and patient NHS so they can be accessed later on, as well see as see the Contact requests and Appointment requests with all the associated information submited.

<br>

All these features are implemented using:  

- **HTML & CSS** for the front-end
- **PHP** for the back-end
- **MySQL** for the database
- **Docker** for the server

<br>

## Vulnerabilities covered

### **CWE-79**: Improper Neutralization of Input During Web Page Generation ('Cross-site Scripting')
### CVSS Base Score: 9.6

#### Description:

The software does not neutralize or incorrectly neutralizes user-controllable input before it is placed in output that is used as a web page that is served to other users

#### Where it can be seen:

- The user input can come from the "Contact" or "Make an Appointment" tab
- The script runs when the Admin account opens the "Contact Requests" or "Appointment Requests" tab


#### Prevention applied in app_sec:

All user inputs go through the **testInput** function (from phpFunctions/functions.inc.php) where the input goes through the functions **<u>trim()</u>**, **<u>stripslashes()</u>** and most importantly **<u>htmlspecialchars()</u>** where it treats any characters that have special significance in HTML (like ```<script>```) as normal content and not as an HTML object.

#### Demonstration:

[CWE-79.md](../analysis/CWE-79.md)



<br>



### **CWE-89**: Improper Neutralization of Special Elements used in an SQL Command ('SQL Injection')
### CVSS Base Score: 7.5

#### Description:

The software constructs all or part of an SQL command using externally-influenced input from an upstream component, but it does not neutralize or incorrectly neutralizes special elements that could modify the intended SQL command when it is sent to a downstream component.

#### Where it can be seen:

- The user input can come from the login modal.

#### Prevention applied in app_sec:

User login input goes through prepared statements (like ``` "SELECT * FROM users WHERE username = ?;" ```), and later treated using **<u>bind_param</u>**, thus avoiding inputs like ```anything' or '1'='1 ``` where a normal sql statement would transform from  ``` SELECT * FROM users WHERE username = '$username' AND password = '$pwd' ``` to  ``` SELECT * FROM users WHERE username = '$username' AND password = 'anything' or '1'='1' ```, enabling the login through the OR condition since the statement (1 = 1) is always true.

#### Demonstration:

[CWE-89.md](../analysis/CWE-89.md)


<br>

### **CWE-521**: Weak Password Requirements
### +
### **CWE-522**: Insufficiently Protected Credentials
### CVSS Base Score: 7.0 + 5.3

#### Description:

**CWE-521**: The product does not require that users should have strong passwords, which makes it easier for attackers to compromise user accounts.

<br>

**CWE-522**: The product transmits or stores authentication credentials, but it uses an insecure method that is susceptible to unauthorized interception and/or retrieval.


#### Where it can be seen:

- These vulnerabilities can be seen on the sign-up page.

#### Prevention applied in app_sec:


During the sign-up process it is applied the function 'weakPassword' from phpFunctions/functions.inc.php where the password provided is checked for:

- One uppercase letter
- One lowercase letter
- One number
- One special character
- Minimum length of 8 characters

After being declared valid, the password is stored in the database using the ```password_hash``` function.

#### Demonstration:

[CWE-521-522.md](../analysis/CWE-521-522.md)



<br>

### **CWE-200**: Exposure of Sensitive Information to an Unauthorized Actor 
### +
### **CWE-307**: Improper Restriction of Excessive Authentication Attempts
### CVSS Base Score: 3.7 + 7.7

#### Description:

**CWE-200**: The product exposes sensitive information to an actor that is not explicitly authorized to have access to that information.


<br>

**CWE-307**: The product does not implement sufficient measures to prevent multiple failed authentication attempts within a short time frame, making it more susceptible to brute force attacks.


#### Where it can be seen:

- These vulnerabilities can be seen on the login modal.

#### Prevention applied in app_sec:


Everytime the user tries an invalid login, his Ip address is saved on a mySQL table, along with the time of the attempt. After 3 unsuccessful tries (calculated by the amount of times his ip address shows up on the table during the defined time period) the login button is locked. After a successful login, the Ip address is deleted from the table.
Upon the unsuccessfull login attempt the only information given is that the login is invalid, not revealing if it was the email/NHS or password that were incorrect.

#### Demonstration:

[CWE-200-307.md](../analysis/CWE-200-307.md)


<br>

### **CWE-434**: Unrestricted Upload of File with Dangerous Type
### CVSS Base Score: 7.5

#### Description:

The software allows the attacker to upload or transfer files of dangerous types that can be automatically processed within the product's environment.

#### Where it can be seen:

- The user upload can come from the Upload Clinical Exams within the Admin login, and the download from Download your clinical exams tab from a visitor or a logged in user.

#### Prevention applied in app_sec:

Before the upload happens, the file is checked for its size and file type, preventing files bigger than 500kB of being uploaded, as well as files with a filetype different than 'application/pdf' (eliminating files with the extension '.pdf.php' as well since it checks for file type instead of scanning if it contains the .pdf extension).



#### Demonstration:

[CWE-434.md](../analysis/CWE-434.md)


<br>
<br>

## Bibliography:

[Common Weakness Enumeration](https://cwe.mitre.org)  
[Front-end template](https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/)  
[How to upload files with PHP correctly and securely](https://dev.to/einlinuus/how-to-upload-files-with-php-correctly-and-securely-1kng)  
[How to upload and download files PHP and MySQL](https://codewithawa.com/posts/how-to-upload-and-download-files-php-and-mysql)  
[How To Create A Login System In PHP For Beginners](https://www.youtube.com/watch?v=gCo6JqGMi30)
[Validating Age and Date of Birth](https://brainbell.com/php/validating-date-of-birth.html)
[How to limit login attempt Using PHP and MySQL](http://phpgurukul.com/how-to-limit-login-attempt-using-php-and-mysql/)