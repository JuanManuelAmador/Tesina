<?php  
require_once 'vendor/autoload.php';
$clientSecretJson = json_decode(
    file_get_contents('client_secret.json'),
    true
)['web'];
$clientId = $clientSecretJson['client_id'];
$clientSecret = $clientSecretJson['client_secret'];
$client = new Google_Client(['client_id' => $clientId]);  // Specify the CLIENT_ID of the app that accesses the backend
$payload = $client->verifyIdToken($_GET['data']);
if ($payload) {
    session_start();
    $_SESSION['userdata']=$payload;
    header("location: tags.php");
} else {
  // Invalid ID token
  header("location:index.php");
}


?>