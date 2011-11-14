About
=====

This repo is a simply a couple of PHP functions designed to work with the Shibboleth Apache SP setup created by Shibboleth's Lil helper.

It assumes your Shibboth Apache SP is already setup and exposing a
REMOTE_USER env variable.


Cheezy Example
==============
<?php require_once('php_shib_apache_auth_helpers/shib_functions.php');
if(shib_is_logged_in()) {
  echo 'logged in: ';
  echo shib_internet_id();
} else {
  echo 'not logged in';
  echo "<a href=\"" . shib_login_and_redirect_url() . "\">login</a>";
}
?>
