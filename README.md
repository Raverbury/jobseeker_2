# Jobseeker 2 - postgres boogaloo
## Setting up (Windows)

### 1. Install xampp if you haven't

If xampp asks for anything, make sure to always say yes

### 2. Go to C:\xampp\htdocs, clone this repo

It should look like this
```
xampp
  |-----htdocs
          |------jobseeker
                     |-------core
                     |-------public
          |------other folders
```

### 2. Install postgreSQL, set up your account (or if you know an already running postgreSQL server somewhere, you can use that instead)

### 3. Navigate to /jobseeker/core/models/PostgresModel.php and modify the database credentials as needed

It looks like this
```
define('DB_HOST', 'YOUR_HOST');
define('DB_DATABASE', 'jobseeker'); // don't modify unless needed
define('DB_USERNAME', 'YOUR_USERNAME');
define('DB_PASSWORD', 'YOUR_PASSWORD');
define('DB_PORT', '5432'); // don't modify unless needed
```
### 5. Go to C:\xampp\apache\conf\extra, open httpd-vhosts.conf, add this to the end of the file
```
<VirtualHost *:80>
  ServerName localhost
  DocumentRoot "C:/xampp/htdocs/"
</VirtualHost>

<VirtualHost *:80>
  ServerName jobseeker.localhost
  DocumentRoot "C:/xampp/htdocs/jobseeker/public/"
</VirtualHost>
```
### 6. Go to C:\Windows\System32\drivers\etc, open hosts (the file with no extension), add this to the end of the file

You need administrator privilege for this action
```
127.0.0.1 jobseeker.localhost
```

### 7. Go to C:\xampp\php, open php.ini and uncomment the line with
```
;extension=pdo_pgsql
```
by removing the semi-colon

### 8. In xampp control panel, stop apache (if it's already running), close the control panel, restart (your pc preferably, and) the apache service

### 9. Open any web browser, go to [jobseeker.localhost](http://jobseeker.localhost/), pray that it works
