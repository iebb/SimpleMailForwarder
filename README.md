A simple multi-domain / multi-user e-mail forwarder.


Install:
0) Create an A record pointing to your server, and two MX records pointing to the A record

1) Set up mysql server and exim server
apt-get install mysql-server exim4-daemon-heavy

2) Replace or Create these files (content is under __configs)
/etc/exim4/conf.d/main/01_exim4-config_listmacrosdefs (you need to change mysql password)
/etc/exim4/conf.d/router/233_forwarder
/etc/exim4/update-exim4.conf.conf

3) Create a file '/etc/exim4/virtual_domains' and set it writable

4) Import SQL (import.sql)


IF YOU NEED A FRONT-END

5) Set up PHP

6) Upload all files under /php-front-end to your webpage home

7) Modify db.php (need to change mysql password)


