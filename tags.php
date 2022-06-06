<!DOCTYPE html>
<?php include_once("db.php");
require_once 'vendor/autoload.php';
use Google\Auth\Credentials\UserRefreshCredentials;
use Google\Auth\OAuth2;
session_start();
    function connectWithGooglePhotos($db)
    {
    $clientSecretJson = json_decode(
        file_get_contents('client_secret.json'),
        true
    )['web'];
    $clientId = $clientSecretJson['client_id'];
    $clientSecret = $clientSecretJson['client_secret'];
    $tokenUri = $clientSecretJson['token_uri'];
    $redirectUri = $clientSecretJson['redirect_uris'][0];
    $scopes = ['https://www.googleapis.com/auth/photoslibrary'];
    
    $oauth2 = new OAuth2([
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
        'authorizationUri' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'redirectUri' => $redirectUri,
        'tokenCredentialUri' => 'https://www.googleapis.com/oauth2/v4/token',
        'scope' => $scopes,
    ]);
    
    // The authorization URI will, upon redirecting, return a parameter called code.
    if (!isset($_GET['code'])) {
        $authenticationUrl = $oauth2->buildFullAuthorizationUri(['access_type' => 'offline']);
        header('Location: ' . $authenticationUrl);
    } else {
        // With the code returned by the OAuth flow, we can retrieve the refresh token.
        $oauth2->setCode($_GET['code']);
        $authToken = $oauth2->fetchAuthToken();
        $refreshToken = $authToken['access_token'];
        $_SESSION['credentials'] = new UserRefreshCredentials(
            $scopes,
            [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'refresh_token' => $refreshToken,
            ]
        );
        $_SESSION['client_id']=$clientId;
        $_SESSION['client_secret']=$clientSecret;
        $_SESSION['refresh_token']=$refreshToken;
        //Checking the user data;
        $userdata=$_SESSION['userdata'];
        $sql="SELECT * FROM users where email='$userdata[email]'";
        $res=$db->query($sql);
        if(mysqli_num_rows($res)){
            // if the user is found
            header("location: verify.php");
        }else{
            $sql1="INSERT INTO `users`( `email`) VALUES ('$userdata[email]')";
            $db->query($sql1);
            //redirect to set_tags.php
            header("location: set_tags.php");
        }
    }
}
    connectWithGooglePhotos($db);
    
?>
