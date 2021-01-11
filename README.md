# PhpSecureLogin
This project complement secure login and registration for a web admin panel template made with php and js.

# Description

This template give the possibility to create different types of admin with personal panels, the admin data is saved on a database.
The script implement a secure registration: when the registration in submitd the password in the form begin cripted with the an hash512 algorithm made with javascript. Then the user in created and saved on the db
The login page show all different types of panel that the admin can access, the following controlls are implemented during login:

 - Check for correct admin type and password
 - Check for brute force attack
 - Protection from sql injection with prepared login query
 - Protection from XXS attack with preg_replace of the admin data

All failed login attemps are saved on a specifi table.
