<?php include_once("db.php");
    ob_start();
    session_start();
    require_once 'vendor/autoload.php';
    use Google\Auth\Credentials\UserRefreshCredentials;
    use Google\Photos\Library\V1\PhotosLibraryClient;
    $api_key="563492ad6f91700001000001e26ae1663fa34ba080e4fd7892fb2127";
    $keywords=['smiles','pets','person','relax','woman','man','wallpaer','sky','old','young','wedding','ceremony','workers','dancers','students','landmarks'];
    $url="https://api.pexels.com/v1/search?query=".$keywords[rand(0,count($keywords)-1)]."&per_page=".rand(10,500);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Authorization:".$api_key,
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $resp=json_decode($resp,true)['photos'];
    shuffle($resp);
    shuffle($resp);
    shuffle($resp);
    $resp=array_slice($resp,0,6);
    $random_photos=[];
    foreach($resp as $img_res){
        array_push($random_photos,['id'=>$img_res['id'],'image'=>$img_res['src']['medium']]);
    }
    $email=$_SESSION['userdata']['email'];
    $sql="SELECT * FROM tags where user_id=(SELECT id from users where email='$email')";
    $res=$db->query($sql);
    $tags=mysqli_fetch_all($res);

    //Fetching images from Google
    $clientSecretJson = json_decode(
        file_get_contents('client_secret.json'),
        true
    )['web'];
    $clientId = $clientSecretJson['client_id'];
    $clientSecret = $clientSecretJson['client_secret'];

    $_SESSION["credentials"] = new UserRefreshCredentials( ["https://www.googleapis.com/auth/photoslibrary"],
    [
        'client_id' => $_SESSION['client_id'],
        'client_secret' => $_SESSION['client_secret'],
        'refresh_token' => $_SESSION['refresh_token']
    ]);
    // // // var_dump($_SESSION);
    $client = new Google_Client();
    $client->setAuthConfig('client_secret.json');
    $scopes = ['https://www.googleapis.com/auth/photoslibrary'];
    $client->addScope($scopes);
    $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
    // offline access will give you both an access and refresh token so that
    // your app can refresh the access token without user interaction.
    $client->setAccessType('offline');
    // Using "consent" ensures that your application always receives a refresh token.
    // If you are not using offline access, you can omit this.
    $client->setApprovalPrompt("consent");
    $client->setIncludeGrantedScopes(true);   // incremental auth
    $photosLibraryClient = new PhotosLibraryClient(['credentials' => $_SESSION["credentials"]]);
    $gphotos=[];
    foreach ($tags as $key => $tag) {
        $albumId=$tag[3];
        $response = $photosLibraryClient->searchMediaItems(['albumId' => $albumId,'pageSize'=>rand(5,100)]);
        $photoz=[];
        foreach($response as $photo){
            array_push($photoz,['image'=>$photo->getBaseUrl(),'id'=>$photo->getId()]);
        }
        shuffle($photoz);
        array_push($gphotos,$photoz[0]);
    }//og Photos
    array_push($random_photos,...$gphotos);
    shuffle($random_photos);

    //Fetching tags-relations
    $rel_sql="SELECT * FROM relations where user_id=(SELECT id from users where email='$email')";
    $rel_res=$db->query($rel_sql);
    $i=1;
    while($row=mysqli_fetch_assoc($rel_res)){
        ?>
            <input type="hidden" value="<?=$row['relation']?>" id="tag_rel_<?=$i?>" >
        <?php
        $i+=1;
    }

    // exit;
    
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
        <h2>Verify your account. <span id="attempts" >3</span> Attempts left</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Account verification</div>
            <div class="panel-body">
                <div class="container" >
                
                </div>
                <div style="border: 1px solid black;" class="container" >
                <div class="row">
                    <?php
                        for ($i=0; $i < 3; $i++) { 
                           $photo=$random_photos[$i];
                           ?>
                                <div class="col-md-4 picture-box pb-unselected" id="<?=$photo['id']?>">
                                    <div class="thumbnail">
                                        <img src="<?=$photo['image']?>" alt="Fjords" style="width:100%;height: 180px;">
                                    </div>
                                </div>
                           <?php
                        }
                    ?>
                </div>

                <div class="row">
                    <?php
                        for ($i=3; $i < 6; $i++) { 
                           $photo=$random_photos[$i];
                           ?>
                                <div class="col-md-4 picture-box pb-unselected" id="<?=$photo['id']?>">
                                    <div class="thumbnail">
                                        <img src="<?=$photo['image']?>" alt="Fjords" style="width:100%;height: 180px;">
                                    </div>
                                </div>
                           <?php
                        }
                    ?>
                </div>

                <div class="row">
                    <?php
                        for ($i=6; $i < 9; $i++) { 
                           $photo=$random_photos[$i];
                           ?>
                                <div class="col-md-4 picture-box pb-unselected" id="<?=$photo['id']?>">
                                    <div class="thumbnail">
                                        <img src="<?=$photo['image']?>" alt="Fjords" style="width:100%;height: 180px;">
                                    </div>
                                </div>
                           <?php
                        }
                    ?>
                </div>
                <br>
                <div class="form-group" >
                        <input type="submit" class="btn btn-danger disabled" value="Verify" style="float:right;margin-top: 10px;" name="" id="verify-btn">
                </div>
                </div>  
            </div>
        </div>
        </div
        </div>
    </div>
</body>
</html>
<style>
    .picture-box{
        /* height: 200px;
        width: 200px;
        align-items: center; */
    }
    .pb-selected{
        border: 5px solid blue;
        opacity: 0.5;
    }
    .pb-unselected{
        /* border: dashed 1px black; */
        border: 5px solid #555;
        
    }
    .picture-box >img{
        /* height:100px; */
        border: 5px solid #555;
    }

</style>
<script>
    var counts=0;
    
    $(document).ready(function (){
        var images=[];
        $("body").on('click',".picture-box",function(){
            let url=$(this).attr("id");
            if(images.indexOf(url)>-1){
                images=images.filter(function(item){
                    if(item!=url) return item;
                })
                $(this).removeClass("pb-selected")
                $(this).addClass("pb-unselected")
            }else{
                if(images.length<3){
                    images.push(url);
                    $(this).removeClass("pb-unselected")
                    $(this).addClass("pb-selected")
                }
                
            }
            if(images.length==3){
            console.log($("#verify-btn").length)

                $("#verify-btn").addClass("btn-info");
                $("#verify-btn").addClass("verifiable");
                $("#verify-btn").removeClass("disabled")
                $("#verify-btn").removeClass("btn-danger")
            }else{
                $("#verify-btn").removeClass("btn-info");
                $("#verify-btn").addClass("disabled")
                $("#verify-btn").addClass("not-verifiable");
                $("#verify-btn").addClass("btn-danger")
            }
        });
        
        //Verify the selections
        $("body").on("click",".verifiable",function(){
            $(this).addClass("disabled");
            let status=true;
            images.forEach((image)=>{
                if(image.length<=70){
                  status=false
                }
            })
            if(status){
                alert("Verified");
                window.location.href="verify_p2.php";
            }else{
                alert("Failed");
                let attempts=localStorage.getItem("attempts_left");
                if(attempts==null){
                    localStorage.setItem("attempts_left",2);
                    window.location.reload()
                }else{
                    //attempts means is recorded earlier.
                    attempts=Number(attempts)-1;
                    if(attempts==0){
                        localStorage.removeItem("attempts_left")
                        window.location.href="logout.php";
                    }else{
                        localStorage.setItem("attempts_left",attempts);
                        window.location.reload();
                    }
                }
            }
        });
        function attempts(){
            let attempts=localStorage.getItem("attempts_left");
            if(attempts!=null){
                $("#attempts").text(Number(attempts));
            }
        }
        attempts()
    })
</script>
