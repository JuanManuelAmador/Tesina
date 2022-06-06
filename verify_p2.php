<?php
include_once("db.php");
ob_start();
session_start();
//Fetching the tags
$email=$_SESSION['userdata']['email'];
$sql="SELECT * FROM tags where user_id=(SELECT id from users where email='$email')";
$res=$db->query($sql);
$tags=mysqli_fetch_all($res);
?>
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
<div class="container" >
    <div class="col-10" >
        <form class="form" action="" method="post" >
        <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">Choose Relation</div>
            <div class="panel-body">
                <h2><?= isset($_SESSION['attempts']) ? $_SESSION['attempts']:2 ?> Attempts Left</h2>
                <div style="border: 5px solid black ;" id="step1" >
                        <h4>Select Relation Between tag 1 VS 2 (<?php echo $tags[0][2] . " VS ".$tags[1][2] ?>) </h4>
                       <form method="post" >
                        <table class="table" >
                            <tr>
                                <!-- <th>Family</th> -->
                                <th>Relation</th>
                                <th>Love</th>
                                <td>Relation Status</td>
                            </tr>
                            <tr>
                                <td colspan="1" >
                                    <select required name="p1_relation" id="p1_relation" class="form-control">
                                        <option value="" selected disabled >Select Relation</option>
                                        <optgroup label="Farmiliar" >
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Son">Son</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="GrandFather">GrandFather</option>
                                            <option value="Grandmother">Grandmother</option>
                                            <option value="Uncle">Uncle</option>
                                            <option value="Aunt">Aunt</option>
                                            <option value="Cousin">Cousin</option>
                                            <option value="Nephew">Nephew</option>
                                            <option value="Niece">Niece</option>
                                        </optgroup>                                        
                                        <optgroup label="In Laws" >
                                            <option value="Sister in law">Sister in law</option>
                                            <option value="Brother in law">Brother in law</option>
                                            <option value="Son in law">Son in law</option>
                                            <option value="Daughter in law">Daughter in law</option>
                                            <option value="Father in law">Father in law</option>
                                            <option value="Mother in law">Mother in law</option>
                                        </optgroup>
                                        <optgroup label="Others" >
                                            <option value="Friends">Friends</option>
                                            <option value="None">None</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td rowspan="" >
                                    <input type="range" min="-3" max="3" name="p1_love" id="p1_love" class="range" >
                                    <span id="range">0</span>
                                </td>
                                <td>
                                    <label><input type="radio" required value="good" name="p1_status" id="p1_status"> Good</label>
                                    <label><input type="radio" required value="bad" name="p1_status" id="p1_status"> Bad</label>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" >
                                <h4>Select Relation Between tag 2 VS 3 (<?php echo $tags[1][2] . " VS ".$tags[2][2] ?>) </h4>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="1" >
                                    <select required name="p2_relation" id="" class="form-control">
                                        <option value="" selected disabled >Select Relation</option>
                                        <optgroup label="Farmiliar" >
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Son">Son</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="GrandFather">GrandFather</option>
                                            <option value="Grandmother">Grandmother</option>
                                            <option value="Uncle">Uncle</option>
                                            <option value="Aunt">Aunt</option>
                                            <option value="Cousin">Cousin</option>
                                            <option value="Nephew">Nephew</option>
                                            <option value="Niece">Niece</option>
                                        </optgroup>                                        
                                        <optgroup label="In Laws" >
                                            <option value="Sister in law">Sister in law</option>
                                            <option value="Brother in law">Brother in law</option>
                                            <option value="Son in law">Son in law</option>
                                            <option value="Daughter in law">Daughter in law</option>
                                            <option value="Father in law">Father in law</option>
                                            <option value="Mother in law">Mother in law</option>
                                        </optgroup>
                                        <optgroup label="Others" >
                                            <option value="Friends">Friends</option>
                                            <option value="None">None</option>
                                        </optgroup>
                                        
                                    </select>
                                </td>
                                <td rowspan="" >
                                    <input required type="range" name="p2_love" min="-3" max="3" class="range" >
                                    <span id="range">0</span>
                                </td>
                                <td>
                                    <label><input type="radio" value="good" required name="p2_status" id=""> Good</label>
                                    <label><input type="radio" value="bad" required name="p2_status" id=""> Bad</label>
                                </td>
                            </tr>
                        </table>

                </div>
                
            </form>
            </div>
            <div class="panel-footer" >
                <div style="padding-right: 0%;padding: left 100%;" >
                    <input type="submit" name="go" id="done" value="Done" class="btn btn-primary" >
                </div>
            </div>
        </div>
        
        </div>
        </form>
    </div>
</div>
<script>
   $("body").on("input",".range",function(){
        let val=$(this).val();
        $(this).parent().find("span").text(val);
    })
</script>
<?php
    if(isset($_POST['go'])){
        
        $id="(SELECT id from users where email='$email')";
        $tag1=($tags[0][0]." vs ".$tags[1][0]);
        $sql="SELECT * FROM `relations` WHERE `user_id`=$id and `tags`='$tag1' and `relation`='$_POST[p1_relation]' and `love_ratio`='$_POST[p1_love]' and `relation_status`='$_POST[p1_status]' ";
        $tag2=$tags[1][0]." vs ".$tags[2][0];
        $sql1="SELECT * FROM `relations` WHERE `user_id`=$id and `tags`='$tag2' and `relation`='$_POST[p2_relation]' and `love_ratio`='$_POST[p2_love]' and `relation_status`='$_POST[p2_status]' ";
        $res1=$db->query($sql);
        $res2=$db->query($sql1);
        if($res1->num_rows && $res2->num_rows){
            header("location: homepage.php");
        }else{
            if(isset($_SESSION['attempts'])){
                if($_SESSION['attempts']>0){
                    $_SESSION['attempts']-=1;
                    header("location: verify_p2.php");
                }else{
                    header("location:logout.php");
                }
            }else{
                $_SESSION['attempts']=1;
                header("location: verify_p2.php");
            }

        }

    }
?>