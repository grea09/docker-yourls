# docker-yourls
Yourls with DB driver support and LDAP

You need to define the following environement variables:

* `YOURLS_DB_USER`
* `YOURLS_DB_PASS`
* `YOURLS_DB_NAME`
* `YOURLS_DB_HOST`
* `YOURLS_DB_DRIVER`

All environement variables are defined within PHP. The web root is /var/www/html and the image uses Apache2 with PHP 7.2.

Also using the [ldap pluggin](https://github.com/k3a/yourls-ldap-plugin) for yourls.
