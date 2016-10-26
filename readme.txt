File: httpd-vhosts.conf
<VirtualHost *:80>
    ServerAdmin webmaster@rivulet.com
    DocumentRoot "D:/WebProjects/rivulet/"
    DirectoryIndex index.php
    ServerName rivulet
    ErrorLog "logs/rivulet-error.log"
    LogLevel alert rewrite:trace8
    CustomLog "logs/rivulet-access.log" common
</VirtualHost>


File: httpd-userdir.conf
<Directory "D:/WebProjects/rivulet">
    AllowOverride FileInfo AuthConfig Limit Indexes
    Options MultiViews Indexes SymLinksIfOwnerMatch IncludesNoExec
    Require all granted
</Directory>


File:.htaccess
DirectoryIndex index.php
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
    #RewriteRule ^(.*)$ index.php?s=$1 [QSA,PT,L]
</IfModule>
