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
    <title>INSHIELD | Leaderboard</title>
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

    //select * from players - ID, email, points 
    //decrypt points 
    //store in array according to ID 
    //arsort() - sort array descending according to the value in the array 
    //display top 5  
    
    ?>

    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Leaderboard</h1>
                
                <table width="70%" height="170px"> 
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
                                        if($consecutive_login_days == 0)
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