<?php

function shib_is_logged_in() {
  return array_key_exists('REMOTE_USER',$_SERVER) && strlen($_SERVER['REMOTE_USER']) > 0;
}

function shib_internet_id() {
  return shib_get_attribute('internet_id');
}

function shib_get_attribute($which_one) {
  switch($which_one) {
    case 'internet_id':
      // From goggins@umn.edu, returns "goggins"
      $a=preg_split('/@/',$_SERVER['REMOTE_USER']);
      return $a[0];
    break;
    case 'tld': // Top level domain
      // From goggins@umn.edu, returns "umn.edu"
      $a=preg_split('/@/',$_SERVER['REMOTE_USER']);
      return $a[1];
    break;
    default:
      throw new Exception("shib_get_attribute goes not support a \"$which_one\" mode");
  }
}

function shib_login_and_redirect_url() { 
  return 'https://' . 
         $_SERVER['HTTP_HOST'] . 
         '/Shibboleth.sso/Login?' .
         'target=' . 
         urlencode(shib_get_current_url());
}

function shib_get_current_url() {
  $dest_url = $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"];
  $first = true;
  foreach ($_GET as $var_name => $var_val){
    if($first) {
      $dest_url .= '?';
      $first = false;
    }
    else {
      $dest_url .= '&';            
    }
    $dest_url .= $var_name.'='.$var_val;
  }
  return 'https://' . $dest_url;
}

function shib_logout_url() { 
  return 'https://' . 
         $_SERVER['HTTP_HOST'] . 
         '/Shibboleth.sso/Logout?' .
         'return=' . 
         urlencode(shib_get_current_url());

}
// If you except the web-server to protect a script, you can place this 
// at the top of the script to simply cause the script to exist if the user is not logged in
function shib_auth_required() { 
  if(!shib_is_logged_in()) {
    $msg="Sorry, an unexpected error has occurred (Shibboleth authentication credentials are not available).
          Please contact the administer of this page if this error persists.";

    echo $msg;
    throw new Exception($msg);
    exit;
  }
}

?>
