# Recipe Catalog
This is a web application written in PHP to manage a recipe catalog. The database used is MySQL, and the front-end framework is Bootstrap.

## Demonstration
A demo of the webapp is available [here](http://www.travisdsmith.com/demo.php?name=recipes).

## Installation Instructions
### Setup the database and connect it to the webapp
1. Begin by setting up a MySQL database. Run script.sql to create the tables and set up a user with a password.
2. Open up "config.php" in the "includes" directory to set the database information
   - `DB_SERVER`: MySQL Server Host
   - `DB_USER`: MySQL User Name
   - `DB_PASS`: MySQL User Password
   - `DB_NAME`: MySQL Database Schema

### Configure the application
1. Open up "initialize.php" in the "includes" directory
2. Edit the required settings
   - `SITE_ROOT` on line 5: This is the location on the web server where the application lives. (ex: `C:\inetpub\wwwroot\recipes\`)
   - `BASE_URL` on line 6: The URL to access the webapp. (ex: `myrecipecatalog.com`)
3. Optionally, edit these settings
   - `WHITELIST` on line 9: This is an array of allowed IP addresses. Populate this to restrict the application to certain IP addresses, or leave blank to allow anyone to connect to the webapp.
   - `IS_DEMO` on line 10: Set this to `false` to enable all features. If set to `true` it will turn off the password change functionality.

## Logging in for the first time.
A user is automatically created when you set up the database.
- Username: user
- Password: password

It's recommended that you change the password when you log on. Use the "Change Password" link at the left of the page.
