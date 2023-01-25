<!DOCTYPE html>

<?php
    //session_start(); 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Player Details</title>
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>    
    .txt
    {
        font-family: "Strait"; 
        color: #000000 !important; 
    }
 
    .btn-design
    { 
        border-color: #000000 !important;
        background-color: #F5F5DC !important;
    }
     
    .text-center a:hover
    {
        text-decoration: underline;
        color: #365194;
    }

    .txt-resize 
    {
        font-size: 20px !important;
    }

    .btn-txt 
    {
        vertical-align: middle !important;
        padding-top:10px !important;
        padding-bottom:10px !important;
    }
 
    .edit-delete-btn
    {
        background-color: white;
        border:none;
    }  
</style>

<body id="page-top">
    <!-- Page Wrapper --> 
    <div id="wrapper">
        <?php 
            include './headerFooterAdmin.php';
            require_once './validation.php'; 
            if(empty($_SESSION["aName"]))
            {
                $location = "login.php";
                echo "<script type='text/JavaScript'>alert('Please log in as admin to continue');window.location='$location'</script>"; 
            } 
        ?>
        
        <div class="container-fluid ps-5"> 
            <?php 

            $cipher = 'AES-128-CBC';
            $key = 'thebestsecretkey';

            //retrieve from db 
            if($_SERVER['REQUEST_METHOD'] == 'GET')
            { 
                if(empty($_GET['id']))
                {
                    $location = "adminPlayers.php";
                    echo "<script type='text/JavaScript'>alert('Please select a player to continue');window.location='$location'</script>"; 
                }
                elseif(!empty($_GET['id']))
                {
                    //retrieve playerID from URL 
                    $playerID = trim($_GET['id']); 

                    //Establish connection
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    //SQL statement with placeholder
                    $sql = "SELECT * FROM players WHERE playerID = ?";

                    //Prepare statement
                    $stmt = $con->prepare($sql);

                    //Bind playerID to the statement
                    $stmt->bind_param("i", $playerID);

                    //Execute statement
                    $stmt->execute();

                    //Store result
                    $result = $stmt->get_result();

                    if($row = $result -> fetch_object())
                    {
                        //playerID 
                        $playerID = $row -> playerID;

                        //iv 
                        $iv = hex2bin($row -> iv); 

                        //email
                        $email = $row -> email;
                        
                        //points
                        $points_bin = hex2bin($row -> points); 
                        $points = openssl_decrypt($points_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
                        
                        //leaderboard_position
                        $leaderboard_position_bin = hex2bin($row -> leaderboard_position); 
                        $leaderboard_position = openssl_decrypt($leaderboard_position_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                       
                        //streak
                        $streak_bin = hex2bin($row -> streak); 
                        $streak = openssl_decrypt($streak_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        
                        //last_login_time
                        $last_login_time_bin = hex2bin($row -> last_login_time); 
                        $last_login_time = openssl_decrypt($last_login_time_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        
                        //latest_login_time
                        $latest_login_time_bin = hex2bin($row -> latest_login_time); 
                        $latest_login_time = openssl_decrypt($latest_login_time_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        
                        //badge
                        $badge_bin = hex2bin($row -> badge); 
                        $badge = openssl_decrypt($badge_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                       
                        //ranking_category1
                        $ranking_category1_bin = hex2bin($row -> ranking_category1); 
                        $ranking_category1 = openssl_decrypt($ranking_category1_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        
                        //ranking_category2
                        $ranking_category2_bin = hex2bin($row -> ranking_category2); 
                        $ranking_category2 = openssl_decrypt($ranking_category2_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                
                        //ranking_category3
                        $ranking_category3_bin = hex2bin($row -> ranking_category3); 
                        $ranking_category3 = openssl_decrypt($ranking_category3_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
  
                        //ranking_category4
                        $ranking_category4_bin = hex2bin($row -> ranking_category4); 
                        $ranking_category4 = openssl_decrypt($ranking_category4_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);

                        //levels
                        $levels_bin = hex2bin($row -> levels); 
                        $levels = openssl_decrypt($levels_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);
 
                    }
                }
            }

            ?> 

            <h1 class="text-left txt fw-bold"><?php echo $email?></h1> 
            <div class="d-flex flex-row-reverse">
                <a href="adminPlayers.php" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg" role="button">Back</a> 
            </div>  

            <form class="container-fluid" action="" method="post" enctype='multipart/form-data'>
            
                <table class="container-fluid"> 
                    <tr>
                        <td style="width: 30%;font-size:23px;"></td>
                    </tr>

                    <!-- points -->  
                    <tr>
                        <td><label for="points" class="txt fs-5">Points</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="points" value="<?php echo $points ?>" disabled/></td>
                    </tr>

                    <!-- leaderboard_position --> 
                    <tr>
                        <td><label for="leaderboard_position" class="txt fs-5">Leaderboard Position</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="leaderboard_position" value="<?php echo $leaderboard_position ?>" disabled/></td>
                    </tr>

                    <!-- streak --> 
                    <tr>
                        <td><label for="streak" class="txt fs-5">Streak</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="streak" value="<?php echo $streak ?>" disabled/></td>
                    </tr>

                    <!-- last_login_time --> 
                    <tr>
                        <td><label for="last_login_time" class="txt fs-5">Last Login Time</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="last_login_time" value="<?php echo $last_login_time ?>" disabled/></td>
                    </tr>

                    <!-- latest_login_time --> 
                    <tr>
                        <td><label for="latest_login_time" class="txt fs-5">Latest Login Time</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="latest_login_time" value="<?php echo $latest_login_time ?>" disabled/></td>
                    </tr>

                    <!-- badge --> 
                    <tr>
                        <td><label for="badge" class="txt fs-5">Badge</label></td>
                        <td class="text-center" style="height:100px;">
                        <div class="shadow p-3 mb-5 bg-body rounded bg-white">
                            <img src="<?php 
                                        if($points < 90)
                                        {
                                            echo "img/sad.png";
                                        }
                                        elseif($points >= 90 && $points <= 100)
                                        {
                                            //bronze 
                                            echo "img/BadgeBronze.png";
                                        }
                                        elseif($points >= 100 & $points<= 199)
                                        {
                                            //silver 
                                            echo "img/BadgeSilver.png";
                                        }
                                        elseif($points >= 200)
                                        {
                                            //gold  
                                            echo "img/BadgeGold.png";  
                                        }
                                        ?>" 
                                        class="img-size p-3"/><br/> 
                                        <label for="badge" class="txt fs-5">
                                        <?php 
                                         if ($badge == 0)
                                         {
                                            echo 'No badge';
                                         } 
                                         elseif ($badge == 1)
                                         {
                                            echo 'Bronze';
                                         }
                                         elseif ($badge == 2)
                                         {
                                            echo 'Silver';
                                         }
                                         elseif ($badge == 3)
                                         {
                                            echo 'Gold';
                                         }?></label> 
                        </div>
                        </td>
                    </tr>

                    <!-- ranking_category1 --> 
                    <tr>
                        <td><label for="ranking_category1" class="txt fs-5">Ranking Category 1</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="ranking_category1" value="<?php echo $ranking_category1 ?>" disabled/></td>
                    </tr>

                    <!-- ranking_category2 --> 
                    <tr>
                        <td><label for="ranking_category2" class="txt fs-5">Ranking Category 2</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="ranking_category2" value="<?php echo $ranking_category2 ?>" disabled/></td>
                    </tr>

                    <!-- ranking_category3 --> 
                    <tr>
                        <td><label for="ranking_category3" class="txt fs-5">Ranking Category 3</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="ranking_category3" value="<?php echo $ranking_category3 ?>" disabled/></td>
                    </tr>

                    <!-- ranking_category4 --> 
                    <tr>
                        <td><label for="ranking_category4" class="txt fs-5">Ranking Category 4</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="ranking_category4" value="<?php echo $ranking_category4 ?>" disabled/></td>
                    </tr>

                    <!-- levels --> 
                    <tr>
                        <td><label for="levels" class="txt fs-5">Levels</label></td>
                        <td style="height:100px;"><input type="text" class="form-control" id="levels" value="<?php echo $levels ?>" disabled/></td>
                    </tr>
  
                </table>   
            </form>

            <br/><br/>
    	</div>
    </div> 
    

 <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>   -->
</body>
</html> 