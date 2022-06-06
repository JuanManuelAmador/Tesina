<?php
require_once 'vendor/autoload.php';
use Google\Auth\Credentials\UserRefreshCredentials;
use Google\Auth\OAuth2;
$client = new Google\Client();
$ini = parse_ini_file('photoslibrary-sample.ini');
$client->setAuthConfig('client_secret.json');
$client->addScope(['https://www.googleapis.com/auth/photoslibrary.readonly']);
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']."/loggedin";
$client->setRedirectUri($ini['filters_authentication_redirect_url']);
// $httpClient = $client->authorize();
// echo "<pre>";
// var_dump($client);
use Google\Photos\Library\V1\PhotosLibraryClient;
function connectWithGooglePhotos()
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

    // The UserRefreshCredentials will use the refresh token to 'refresh' the credentials when
    // they expire.
    $_SESSION['credentials'] = new UserRefreshCredentials(
        $scopes,
        [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refreshToken' => $refreshToken,
        ]
    );
    $photosLibraryClient = new PhotosLibraryClient(['credentials' => $_SESSION['credentials']]);
}

return $photosLibraryClient;
}
connectWithGooglePhotos();
