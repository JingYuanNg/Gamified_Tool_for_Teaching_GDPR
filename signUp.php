<!DOCTYPE html>

<?php
    session_start(); 
    require_once './validation.php'; 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Sign Up</title>
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

    ?>

    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Sign Up</h1>
                <?php 
                    if(isset($_POST['signUp']))
                    {
                        $email = trim($_POST['email']); 
                        $password = trim($_POST['password']); 
                        $confirmPassword = trim($_POST['confirmPassword']); 
 
                        $error['email'] = validateEmail($email);
                        $error['password'] = validatePassword($password);
                        $error['confirmPassword'] = validateConfirmPassword($password, $confirmPassword);
                        
                        $error = array_filter($error); 

                        $cipher = 'AES-128-CBC';
                        $key = 'thebestsecretkey';

                        //iv_hex 
                        $iv = random_bytes(16); 
                        $iv_hex = bin2hex($iv);

                        //hashed_password 
                        $hashed_password = hash('sha3-256', $password, true);
                        //hashedPassword_hex 
                        $hashed_password_hex = bin2hex($hashed_password);

                        //points
                        $points = 0; 
                        //encrypted_points
                        $encrypted_points = openssl_encrypt($points, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_points_hex 
                        $encrypted_points_hex = bin2hex($encrypted_points);

                        //leader_position
                        $leader_position = 0; 
                        //encrypted_leaderboard_position
                        $encrypted_leaderboard_position = openssl_encrypt($leader_position, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_leaderboard_position_hex 
                        $encrypted_leaderboard_position_hex = bin2hex($encrypted_leaderboard_position);

                        //streak
                        $streak = 0; 
                        //encrypted_streak 
                        $encrypted_streak = openssl_encrypt($streak, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_streak_hex 
                        $encrypted_streak_hex = bin2hex($encrypted_streak);
                        
                
                        //last_login_time 
                        date_default_timezone_set('Europe/Dublin');
                        $date = date('d-F-Y H:i:s'); 
                        $last_login_time = $date;
                        //encrypted_last_login_time
                        $encrypted_last_login_time = openssl_encrypt($last_login_time, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_last_login_time_hex 
                        $encrypted_last_login_time_hex = bin2hex($encrypted_last_login_time);

                        //badge 
                        $badge = 0; 
                        //encrypted_badge
                        $encrypted_badge = openssl_encrypt($badge, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_badge_hex 
                        $encrypted_badge_hex = bin2hex($encrypted_badge);

                        //ranking_category1
                        $ranking_category1 = 0;
                        //encrypted_ranking_category1
                        $encrypted_ranking_category1 = openssl_encrypt($ranking_category1, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_ranking_category1_hex
                        $encrypted_ranking_category1_hex = bin2hex($encrypted_ranking_category1);
                        
                        //ranking_category2
                        $ranking_category2 = 0;
                        //encrypted_ranking_category2
                        $encrypted_ranking_category2 = openssl_encrypt($ranking_category2, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_ranking_category2_hex
                        $encrypted_ranking_category2_hex = bin2hex($encrypted_ranking_category2);

                        //ranking_category3
                        $ranking_category3 = 0;
                        //encrypted_ranking_category3
                        $encrypted_ranking_category3 = openssl_encrypt($ranking_category3, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_ranking_category3_hex
                        $encrypted_ranking_category3_hex = bin2hex($encrypted_ranking_category3);

                        //ranking_category4
                        $ranking_category4 = 0;
                        //encrypted_ranking_category4
                        $encrypted_ranking_category4 = openssl_encrypt($ranking_category4, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        //encrypted_ranking_category4_hex
                        $encrypted_ranking_category4_hex = bin2hex($encrypted_ranking_category4);

                        if(empty($error))
                        {
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                            
                            $sql = "INSERT INTO players (playerID, iv, email, password, points, leaderboard_position, streak, last_login_time, badge, ranking_category1, ranking_category2, ranking_category3, ranking_category4) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $con -> prepare($sql); 
                            $playerID = NULL; 
                    
                            $stmt -> bind_param('issssssssssss', $playerID, $iv_hex, $email, $hashed_password_hex, $encrypted_points_hex, $encrypted_leaderboard_position_hex, $encrypted_streak_hex, $encrypted_last_login_time_hex, $encrypted_badge_hex, $encrypted_ranking_category1_hex, $encrypted_ranking_category2_hex, $encrypted_ranking_category3_hex, $encrypted_ranking_category4_hex); 
                    
                            $stmt -> execute(); 

                            if($stmt -> affected_rows > 0)
                            {
                                printf('<script>alert("Sign Up successfully"); location.href = "./login.php"</script>');
                            }

                            $stmt -> close(); 
                            $con -> close();
                        }
                        else
                        {
                           //display error msg 
                           echo "<ul class=‘error’>";
                           foreach ($error as $value)
                           {
                           echo "<li>$value</li>";
                           echo "</ul>";
                           }
                        }
                    } 
                ?> 
                <form class="user" action="" method="post" enctype='multipart/form-data'>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control txt" id="email" name="email" placeholder="Email" autofocus="autofocus" required="required">
                        <label for="signUpEmail" class="txt">Email</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control txt" id="password" name="password" placeholder="Password" required="required">
                        <label for="signUpPassword" class="txt">Password</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control txt" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required="required">
                        <label for="signUpConfirmPassword" class="txt">Confirm Password</label>
                    </div>
                    <div class="mb-3"> 
                        <button type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="signUp" name="signUp">Sign Up</button>
                    </div>
                </form> 

                <div class="login-link">
                    <hr>
                    <div class="text-center">
                        <a class="txt" href="login.php">Login</a>
                    </div>
                </div> 
            </div>
        </div> 
    </div>
     
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script> -->
</body>
</html> 