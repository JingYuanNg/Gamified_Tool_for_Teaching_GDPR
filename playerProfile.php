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
</style>

<body>
    <?php 
        
    include './headerFooterClient.php'; 
    //badge 
    //streak 

    $email = $_SESSION["pName"]; 

    $cipher = 'AES-128-CBC';
    $key = 'thebestsecretkey';

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    $sql = "SELECT * FROM players WHERE email = '$email'";
    $result = $con -> query($sql); 

    if($row = $result -> fetch_object())
    {
 
      //get playerID 
      $playerID = $row -> playerID; 

      //get iv 
      $iv = hex2bin($row -> iv); 
 
      //points 
      $points_bin = hex2bin($row -> points); 
      $points = openssl_decrypt($points_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
    
    }

    //badge  
    //bronze (90 - 99) badgeVal = 1 
    //silver (100 - 199) badgeVal = 2 
    //gold (200 and above) badgeVal = 3  
    if($points < 90)
    {
        $badgeVal = 0; 
        $imgVar = "img/sad.png";
        $badgeTxt = "At least 90 points to get a badge";
    }
    elseif($points >= 90 && $points <= 100)
    {
        //bronze 
        $badgeVal = 1; 
        $imgVar = "img/BadgeBronze.png"; 
        $badgeTxt = "Bronze";
    }
    elseif($points >= 100 & $points<= 199)
    {
        //silver 
        $badgeVal = 2; 
        $imgVar = "img/BadgeSilver.png"; 
        $badgeTxt = "Silver";
    }
    elseif($points >= 500)
    {
        //gold 
        $badgeVal = 3; 
        $imgVar = "img/BadgeGold.png"; 
        $badgeTxt = "Gold";
    }

    echo '$badgeVal: ' . $badgeVal . '<br/>';
    //encrypted_badge
    $encrypted_badgeVal = openssl_encrypt($badgeVal, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    //encrypted_badge_hex 
    $encrypted_badgeVal_hex = bin2hex($encrypted_badgeVal);

    $con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "UPDATE players SET badge = ? WHERE email = ?";
    $stmt = $con ->prepare($sql);
    $stmt -> bind_param('ss', $encrypted_badgeVal_hex, $email);

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

    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Player Profile</h1>
                
                <table align="center" width="500px" height="170px"> 
                    <tr>
                        <td style="width: 30%;font-size:23px;"></td>
                    </tr>
                    <tr>
                        <td><label for="email" class="txt">Email</label></td>
                        <td style="height:100px;"><input type="email" class="form-control" id="email" value="<?php echo $email ?>" disabled/></td>
                    </tr>
                    <tr>
                        <td><label for="points" class="txt">Points</label></td>
                        <td style="height:100px;"><input type="points" class="form-control" id="points" value="<?php echo $points ?>" disabled/></td>
                    </tr> 
                    <tr>
                        <td><label for="badge" class="txt">Badge</label></td>
                        <td class="text-center" style="height:100px;">
                        <div class="shadow p-3 mb-5 bg-body rounded bg-white"><img src="<?php echo $imgVar ?>" class="img-size p-3"/><br/> 
                        <label for="badge" class="txt"><?php echo $badgeTxt ?></label></div>
                        </td>
                    </tr> 
                    <tr>
                        <td><label for="streak" class="txt">Streak</label></td>
                        <td class="text-center" style="height:100px;">
                        <div class="shadow p-3 mb-5 bg-body rounded bg-white"><img src="img/Celebrate.png" class="img-size"/>
                        <label for="streak" class="txt"><?php echo 'Streak'; ?></label></div>
                        </td>
                    </tr>
                </table> 
 
                <div class="mb-3">
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