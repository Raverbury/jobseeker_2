# Setting up

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
### 3. Go to C:\xampp\apache\conf\extra, open httpd-vhosts.conf, add this to the end of the file
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
### 4. Go to C:\Windows\System32\drivers\etc, open hosts (the file with no extension), add this to the end of the file

You need administrator privilege for this action
```
127.0.0.1 jobseeker.localhost
```

### 5. In xampp control panel, stop apache (if it's already running), close the control panel, restart (your pc preferably, and) the apache service

### 6. Open any web browser, go to [jobseeker.localhost](http://jobseeker.localhost/)
