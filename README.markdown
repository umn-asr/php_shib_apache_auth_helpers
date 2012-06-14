About
=====
These stupid simple functions are designed to decouple the usage
of Shibboleth Native SP exposed $_SERVER variables from the apps that
use them.  The idea is that your app or higher level auth layer
integrate against these functions instead of pulling stuff directly
from the $_SERVER array. It assumes that the $_SERVER["REMOTE_USER"] var
is exposed by Shibboleth

If you need help getting the Shibboleth Native SP setup on Apache or
IIS, check out [Shibboleth's Lil Helper](https://github.com/umn-asr/shibboleths_lil_helper), more [context about this tool is here](http://thenerdings.blogspot.com/2012/05/integrating-shibboleth-native-sp-with.html).

Usage
=====

    <?php 
    require_once('php_shib_apache_auth_helpers/shib_functions.php');

    if(shib_is_logged_in()) {
      echo 'logged in: ';
      echo shib_internet_id();
    } else {
      echo 'not logged in';
      echo "<a href=\"" . shib_login_and_redirect_url() . "\">login</a>";
    }
    ?>
