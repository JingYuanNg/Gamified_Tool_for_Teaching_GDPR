<!DOCTYPE html>

<?php
    //start session 
    session_start(); 
    require_once './validation.php';
 
    if(empty($_SESSION["pName"]))
    {
        $location = "login.php";
        echo "<script type='text/JavaScript'>alert('Please log in to continue');window.location='$location'</script>"; 
    } 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Player Profile</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>   

    .display-top
    {
        padding-top: 90px;
    }

    .display-inside
    {
        padding-top: 50px;
    }

    .txt
    {
        font-family: "Strait"; 
        color: #000000;
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

    a:hover 
    {
        text-decoration: none !important;
    }
</style>

<body>
    <?php 
        
    include './headerFooterClient.php'; 
    //badge 
    //streak 

    $email = $_SESSION["pName"]; 

    //hashed_email 
    $hashed_email = hash('sha3-256', $email, true);
    //hashed_email_hex
    $hashed_email_hex = bin2hex($hashed_email);

    $cipher = 'AES-128-CBC';
    $key = 'thebestsecretkey';

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    $sql = "SELECT * FROM players WHERE email = '$hashed_email_hex'";
    $result = $con -> query($sql); 

    if($row = $result -> fetch_object())
    {
 
      //get playerID 
      $playerID = $row -> playerID; 

      //get iv 
      $iv = hex2bin($row -> iv); 
 
      //displayName 
      $displayName_bin = hex2bin($row -> displayName); 
      $displayName = openssl_decrypt($displayName_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 

      //points 
      $points_bin = hex2bin($row -> points); 
      //$points = openssl_decrypt($points_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
      $points = decrypting($points_bin, $iv);
      echo $points. '<br/>';

      //last_login_time 
      $last_login_time_bin = hex2bin($row -> last_login_time); 
      $last_login_time = openssl_decrypt($last_login_time_bin,  $cipher, $key, OPENSSL_RAW_DATA, $iv);
      //echo '$last_login_time:' . $last_login_time . "<br/>";
      $date_last_login_time = new DateTime($last_login_time); 
      $day_last_login_time = $date_last_login_time -> format('d');
      $month_last_login_time = $date_last_login_time -> format('m'); 
      $year_last_login_time = $date_last_login_time -> format('Y');
      /* echo '$day_last_login_time: ' . $day_last_login_time . "<br/>"; 
      echo '$month_last_login_time: ' . $month_last_login_time . "<br/>";
      echo '$year_last_login_time: ' . $year_last_login_time . "<br/><br/>";  */

      //latest_login_time 
      $latest_login_time_bin = hex2bin($row -> latest_login_time); 
      $latest_login_time = openssl_decrypt($latest_login_time_bin,  $cipher, $key, OPENSSL_RAW_DATA, $iv);
      //echo '$latest_login_time:' . $latest_login_time . "<br/>";
      $date_latest_login_time = new DateTime($latest_login_time); 
      $day_latest_login_time = $date_latest_login_time -> format('d');
      $month_latest_login_time = $date_latest_login_time -> format('m'); 
      $year_latest_login_time = $date_latest_login_time -> format('Y');
      /* echo '$day_latest_login_time: ' . $day_latest_login_time . "<br/>"; 
      echo '$month_latest_login_time: ' . $month_latest_login_time . "<br/>";
      echo '$year_latest_login_time: ' . $year_latest_login_time . "<br/><br/>";  */

      //streak 
      $streak_bin = hex2bin($row -> streak);
      $streak = openssl_decrypt($streak_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
    }

    //badge  
    //bronze (90 - 99) badgeVal = 1 
    //silver (100 - 199) badgeVal = 2 
    //gold (200 and above) badgeVal = 3  
    if($points < 90)
    {
        $badgeVal = 0; 
        $badgeImgVar = "img/sad.png";
        $badgeTxt = "At least 90 points to get a badge";
    }
    elseif($points >= 90 && $points <= 100)
    {
        //bronze 
        $badgeVal = 1; 
        $badgeImgVar = "img/BadgeBronze.png"; 
        $badgeTxt = "Bronze";
    }
    elseif($points >= 100 & $points<= 199)
    {
        //silver 
        $badgeVal = 2; 
        $badgeImgVar = "img/BadgeSilver.png"; 
        $badgeTxt = "Silver";
    }
    elseif($points >= 200)
    {
        //gold 
        $badgeVal = 3; 
        $badgeImgVar = "img/BadgeGold.png"; 
        $badgeTxt = "Gold";
    } 

    if($streak == 0)
    {
        $streakImgVar = "img/sad.png";
        $streakTxt = "Login everyday to keep the streak";
    }
    else 
    {
        $streakImgVar = "img/fire.png"; 
        $streakTxt = $streak;
    }
 
    // echo '$badgeVal: ' . $badgeVal . '<br/>';
    //encrypted_badge
    $encrypted_badgeVal = openssl_encrypt($badgeVal, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    //encrypted_badge_hex 
    $encrypted_badgeVal_hex = bin2hex($encrypted_badgeVal);
 
    $con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "UPDATE players SET badge = ? WHERE email = ?";
    $stmt = $con ->prepare($sql);
    $stmt -> bind_param('ss', $encrypted_badgeVal_hex, $hashed_email_hex);

    if($stmt -> execute())
    {
        //update successful 
        //echo '$encrypted_badgeVal_hex: ' . $encrypted_badgeVal_hex . '<br/>';
    }
    else 
    {
        echo 'Uh-oh'. '<br/>'; 
    }

    $con -> close();
    
    ?>
<br/><br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Player Profile</h1>
                
                <table width="500px" height="170px"> 
                    <tr>
                        <td style="width: 30%;font-size:23px;"></td>
                    </tr>
                    <tr>
                        <td><label for="email" class="txt">Email</label></td>
                        <td style="height:100px;"><input type="email" class="form-control" id="email" value="<?php echo $displayName ?>" disabled/></td>
                    </tr>
                    <tr>
                        <td><label for="points" class="txt">Points</label></td>
                        <td style="height:100px;"><input type="points" class="form-control" id="points" value="<?php echo $points ?>" disabled/></td>
                    </tr> 
                    <tr>
                        <td><label for="badge" class="txt">Badge</label></td>
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
                                        class="img-size p-3"
                                        alt="<?php echo $badgeImgVar ?>"/><br/> 
                        <label for="badge" class="txt"><?php echo $badgeTxt ?></label></div>
                        </td>
                    </tr> 
                    <tr>
                        <td><label for="streak" class="txt">Streak</label></td>
                        <td class="text-center" style="height:100px;">
                        <div class="shadow p-3 mb-5 bg-body rounded bg-white">
                            <img src="<?php 
                                        if($streak == 0)
                                        {
                                            echo "img/sad.png"; 
                                        }
                                        else 
                                        {
                                            echo "img/fire.png";
                                        }
                                        ?>" class="img-size"
                                        alt="<?php echo $streakImgVar ?>"/><br/>
                        <label for="streak" class="txt"><?php echo $streakTxt ?></label></div>
                        </td>
                    </tr> 
                </table> 
 
                <div class="mb-3">
                <br/>
                <div class="text-center">
                    <?php 
                        $email = $_SESSION["pName"]; 

                        $cipher = 'AES-128-CBC';
                        $key = 'thebestsecretkey';
                    
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                        $sql = "SELECT * FROM players WHERE email = '$hashed_email_hex'";
                        $result = $con -> query($sql); 
                    
                        if($row = $result -> fetch_object())
                        { 
                          //get playerID 
                          $playerID = $row -> playerID; 
                    
                          //get iv 
                          $iv = hex2bin($row -> iv); 

                          printf('<a href="twoFactorAuth.php?id=%d" class="btn btn-block btn-design font-weight-bold txt txt-noDeco">Enable Google Two Factor Authentication</a>', $row -> playerID);
                        }
                        $result->free();
                        $con->close();
                    ?>
                    
                </div>
                <br/> 
                <div class="text-center">
                    <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="logout" name="logout" value="Logout" onclick="location = 'logout.php'; alert('You have successfully been logout!');"/>
                </div>
                </div> 
            </div>
        </div> 
    </div>
    <!-- <input type="button" value="Logout" name="logout" class="profile-btn" onclick="location = 'logout.php'; alert('You have successfully been logout!');"/> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script> -->
</body>
</html> 