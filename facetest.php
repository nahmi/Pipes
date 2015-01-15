<?php
/*include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookSession.php' );
include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookRedirectLoginHelper.php' );
include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookRequest.php' );
include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookResponse.php' );
include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookSDKException.php' );
include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookRequestException.php' );
include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/FacebookAuthorizationException.php' );
include_once( 'facebook-php-sdk-v4-4.0-dev/src/Facebook/GraphObject.php' );

use ('Facebook\FacebookSession');
use ('Facebook\FacebookRedirectLoginHelper');
use ('Facebook\FacebookRequest');
use ('Facebook\FacebookResponse');
use ('Facebook\FacebookSDKException');
use ('Facebook\FacebookRequestException');
use ('Facebook\FacebookAuthorizationException');
use ('Facebook\GraphObject');
use ('Facebook\Entities\AccessToken');
use ('Facebook\HttpClients\FacebookCurlHttpClient');
use ('Facebook\HttpClients\FacebookHttpable');*/

include("facebook-php-sdk-v4-4.0-dev//autoload.php");


	FacebookSession::setDefaultApplication('1502848609958241', '7fb82751ccb8b875e593f112d259c8d4');
?>
<DOCTYPE! html>
<html>
<head>

<title>face!</title>

</head>

<?php
	
$helper = new FacebookJavaScriptLoginHelper();
try {
  $session = $helper->getSession();
} catch(FacebookRequestException $ex) {
  // When Facebook returns an error
} catch(Exception $ex) {
  // When validation fails or other local issues
}
if ($session) {
 try {

    $user_profile = (new FacebookRequest(
      $session, 'GET', '/me'
    ))->execute()->getGraphObject(GraphUser::className());

    echo "Name: " . $user_profile->getName() . $user_profile->LastName();

  } catch(FacebookRequestException $e) {

    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();

  }   
}
		?>

	<body>

		

	</body>
</html>