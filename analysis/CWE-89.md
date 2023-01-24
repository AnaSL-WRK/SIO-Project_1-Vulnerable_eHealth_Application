# CWE-89: Improper Neutralization of Special Elements used in an SQL Command ('SQL Injection')

For the purpose of this demonstration, the passwords were uncovered.

When logging in with **Email/NHS**= anything' or '1'='1  and **password**= anything' or '1'='1, the 'hacker' is logged in into the Admin account, since this is the account with **userID=1** (primary attribute) in the users table  

<br>

**App Demonstration:**

https://user-images.githubusercontent.com/73437942/202058216-1414e7c9-161c-4340-ae5d-e8ed9eaa8479.mp4

<br>

**App_sec Demonstration:**


https://user-images.githubusercontent.com/73437942/202058254-82cd5650-b73c-45ed-adb7-44319b4873fa.mp4

