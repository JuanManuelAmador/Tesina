<!DOCTYPE html>
<?php 
session_start();
session_destroy();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="google_signin_client_id" content="832323097082-2t91b8m1bdkqc4mgac61sjbck8qkn695.apps.googleusercontent.com" >  
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!-- <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
             
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="#">About</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="jumbotron">
            <h1 class="text-left">Double Auth Lab Project</h1>
            <p class="text-left">Chose the account you wish to login with.</p>
            <p>
            <div id="g_id_onload"
                data-client_id="832323097082-o4q65b64rt2mtf7ppbo71ac6jb70gftf.apps.googleusercontent.com"
                data-context="signup"
                data-ux_mode="popup"
                data-callback="authenticated"
                data-auto_prompt="false">
            </div>

            <div class="g_id_signin"
                data-type="standard"
                data-shape="rectangular"
                data-theme="outline"
                data-text="signin_with"
                data-size="large"
                data-logo_alignment="left">
            </div>
            </p>
        </div>
        <div class="footer">
            
        </div>
    </div>
</body>
<script>
  function authenticated(user){
    let link="userdata.php?data="+user.credential;
    location.href=link;
  }
</script>

</html>
