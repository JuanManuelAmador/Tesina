<?php include_once("db.php");
    ob_start();
    session_start();
    require_once 'vendor/autoload.php';
    use Google\Auth\Credentials\UserRefreshCredentials;
    use Google\Photos\Library\V1\PhotosLibraryClient;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- <script src="https://accounts.google.com/gsi/client" async defer></script> -->
    
    <!--  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootsrap.min.css" rel="stylesheet">
</head>

<body>
    <div  class="container" >
        <div class="" >
        <div class="">
        <h2>Select 3 Tags for authentication</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Tags For you</div>
            <div class="panel-body">
                <div class="container" >
                <?php
                try {
    
                $_SESSION["credentials"] = new UserRefreshCredentials( ["https://www.googleapis.com/auth/photoslibrary"],
                [
                    'client_id' => $_SESSION['client_id'],
                    'client_secret' => $_SESSION['client_secret'],
                    'refresh_token' => $_SESSION['refresh_token']
                ]);
                // var_dump($_SESSION);
                $client = new Google_Client();
                $client->setAuthConfig('client_secret.json');
                $scopes = ['https://www.googleapis.com/auth/photoslibrary','https://www.googleapis.com/auth/userinfo.profile'];
                $client->addScope($scopes);
                $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
                // offline access will give you both an access and refresh token so that
                // your app can refresh the access token without user interaction.
                $client->setAccessType('offline');
                // Using "consent" ensures that your application always receives a refresh token.
                // If you are not using offline access, you can omit this.
                $client->setApprovalPrompt("consent");
                $client->setIncludeGrantedScopes(true);   // incremental auth
            }  catch (\Google\ApiCore\ValidationException $e) {
                // Error during client creation
                echo $exception;
            }

            ?>
                </div>
                <div style="border: 1px solid black;" class="container" >
                <p>
                    <h5 align="center" >Check only 3 names of tags<h5>
                </p>
                <form action="set_tags.php" method="post">
                <?php
                        $photosLibraryClient = new PhotosLibraryClient(['credentials' => $_SESSION["credentials"]]);
                        $response = $photosLibraryClient->listAlbums();
                        $albums=$response->iterateAllElements();
                            foreach ($albums as $key => $album) {
                                $albumId = $album->getId();
                                $title = $album->getTitle();
                            ?>
                                            <div class="checkbox">
                                                <label> <?php echo $title ?>
                                                <input type="checkbox" style="padding-left:10px"  class="select-box" id="<?=$albumId?>" value="<?=$albumId?>" name="<?=$title?>" >
                                            </label>
                                            </div>
                            <?php
                            }
                        ?>
                        <div style="float:right; padding-right:100px" >
                            <span id="counts" >3</span>&nbsp;Remaining
                            <button type="submit" name="go" class="btn btn-info disabled" >Continue</button> <br>
                        </div>
                </form>

                </div>  
            </div>
        </div>
        </div
        </div>
    </div>
</body>
</html>
<style>
    .avatar-unselected > img{
        border: solid black 5px;
        /* margin-left: 1px; */
    }
    .avatar-selected > span{
        color:blue
    }
    .avatar-selected > img{
        border: solid blue 5px;
        /* margin-left: 1px; */
    }
    .avatar {
    vertical-align: middle;
    /* width: 250px;*/
    height: 250px; 
    border-radius: 50%;
    }
    .circle {
    height: 100px;
    width: 100px;

    border-radius: 50%;
    }
</style>
<script>
    var counts=0;
    $(document).ready(function (){
        $("body").on('change',".select-box",function(){
            let val=$(this ).prop('checked');
            if(val ){
                //if selected
                if(counts>=3){
                    $(this).prop("checked",false);
                }else{
                    counts+=1;
                }
                

            }else{
                //if unselected
                counts-=1;
            }
            let rem=3-counts
            $("#counts").text(rem)
            if(rem==0){
                $("button").removeClass("disabled");
            }else{
                $("button").addClass("disabled");
            }
        })
        
    })
</script>
<?php 
    if(isset($_POST['go'])){
        unset($_POST['go']);
        $user_id=rand(1,99);
        $email=$_SESSION['userdata']['email'];
        foreach($_POST as $key=> $selection){
            $sql="INSERT INTO `tags`( `user_id`, `image`,`albumid`) VALUES((SELECT id from users where email='$email'),'$key','$selection')";
            $res=$db->query($sql);
            if(!$res){
                var_dump(mysqli_error($db));exit();
            }
        }
        header("location: set_relation.php");
    }
?>