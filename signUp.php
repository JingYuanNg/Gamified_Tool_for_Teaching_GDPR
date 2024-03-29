<!DOCTYPE html>

<?php
    include_once 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception;
    require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
    require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once 'vendor/phpmailer/phpmailer/src/SMTP.php'; 
    require_once 'vendor/phpmailer/phpmailer/src/POP3.php';
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
        require_once './headerFooterClient.php'; 

        //csrf 
        if(!isset($_SESSION['token']))
        {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

    ?>

    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Sign Up</h1>
                <?php 

                    // Generate a unique token for the user session
                    if (!isset($_SESSION['csrf_token'])) 
                    {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }

                    $token = $_SESSION['csrf_token']; 

                    function generateToken() 
                    {
                        return bin2hex(random_bytes(16));
                    }

                    function sendVerifyEmail($email, $token)
                    {  
                       $to = $email;

                       // create a new PHPMailer object
                       $mail = new PHPMailer();

                       // specify the SMTP server and port
                       $mail->IsSMTP();
                       $mail->Mailer = "smtp";
                       $mail->SMTPDebug  = 1; 
                       $mail->Host = 'smtp.gmail.com';
                       $mail->SMTPAuth = true;
                       $mail->Username = 'developerinshield@gmail.com';
                       $mail->Password = ''; //password not upload to github for security purpose
                       $mail->SMTPSecure = 'tls';
                       $mail->Port = 587;

                       // set the email address and name of the sender
                       $mail->setFrom('developerInshield@gmail.com', 'Inshield');

                        // set the email address and name of the recipient
                       $mail->addAddress($email);

                       // set the subject and message of the email
                       $mail->Subject = 'Verify Email';
                       $mail->Body = 'Click the link below to verify your email:<br><br>' .
                                     //'http://localhost/Inshield/verify-email.php?token=' . $token . '<br>'.
                                     'https://c00278713.candept.com/verify-email.php?token=' . $token . '<br>'. 
                                     'Please contact us immediately by replying to this email if you did not make this request';
                       $mail->AltBody = 'Click the link below to verify your email: ' .
                                        //'http://localhost/Inshield/verify-email.php?token=' . $token . '<br>'. 
                                        'https://c00278713.candept.com/verify-email.php?token=' . $token . '<br>'. 
                                        'Please contact us immediately by replying to this email if you did not make this request';

                       // send the email
                       if (!$mail->send()) 
                       {
                         echo 'Error: ' . $mail->ErrorInfo; 
                       } 
                       else 
                       {
                            
                       }
                    }

                    if(isset($_POST['signUp']))
                    {
                        if ($_POST['csrf_token'] !== $_SESSION['csrf_token'])
                        { 
                            die('CSRF attack detected!');
                        }
                        else
                        {
                        $email = trim($_POST['email']); 
                        $password = trim($_POST['password']); 
                        $confirmPassword = trim($_POST['confirmPassword']); 
 
                        $error['email'] = validateEmail($email);
                        $error['password'] = validatePassword($password);
                        $error['confirmPassword'] = validateConfirmPassword($password, $confirmPassword);
                        
                        //Remove null value in $error when there is no error
                        $error = array_filter($error); 

                        $exist = 0; 

                        if($exist == 0)
                        {
                            //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                            //admin SQL statement 
                            $sql = "SELECT * FROM admin"; 
                    
                            //Get the result 
                            $result = $con -> query($sql); 
                    
                            while($row = $result->fetch_object())
                            {
                              $exist = 1; 
                              $compareEmail = $row -> email; 
                    
                              //hashed_email 
                              $hashed_email = hash('sha3-256', $email, true);
                              //hashed_email_hex
                              $hashed_email_hex = bin2hex($hashed_email);

                              if(strcmp($compareEmail, $hashed_email_hex) == 0)
                              {  
                                $location = "signUp.php"; 
                                echo "<script type='text/javascript'>alert('Email already taken as an admin');window.location='$location'</script>";
                                exit();
                              }
                            }
                        } 
                        //iv_hex 
                        $iv = random_bytes(16); 
                        $iv_hex = bin2hex($iv);

                        //hashed_email 
                        $hashed_email = hash('sha3-256', $email, true);
                        //hashed_email_hex
                        $hashed_email_hex = bin2hex($hashed_email);

                        //hashed_password 
                        $hashed_password = hash('sha3-256', $password, true);
                        //hashed_password_hex 
                        $hashed_password_hex = bin2hex($hashed_password);

                        //displayEmail 
                        $displayEmail = $email; 
                        $encrypted_displayEmail_hex = encrypting($displayEmail, $iv); 

                        //displayName
                        //explode - spilt the string into 2 parts, using @ as the separator 
                        //list() - assign the 2 elements of the array to 2 separate variables 
                        list($displayName, $domain) = explode('@', $email);
                        $encrypted_displayName_hex = encrypting($displayName, $iv); 

                        //points
                        $points = 0;   
                        $encrypted_points_hex = encrypting($points, $iv); 
  
                        //leader_position
                        $leaderboard_position = 0;  
                        $encrypted_leaderboard_position_hex = encrypting($leaderboard_position, $iv);

                        //streak
                        $streak = 0;  
                        $encrypted_streak_hex = encrypting($streak, $iv);

                        //last_login_time  
                        date_default_timezone_set('Europe/Dublin');
                        $last_login_time = date('d-F-Y H:i:s');     
                        $encrypted_last_login_time_hex = encrypting($last_login_time, $iv);

                        //latest_login_time  
                        date_default_timezone_set('Europe/Dublin');
                        $latest_login_time = date('d-F-Y H:i:s');    
                        $encrypted_latest_login_time_hex = encrypting($latest_login_time, $iv);

                        //badge 
                        $badge = 0;  
                        $encrypted_badge_hex = encrypting($badge, $iv);

                        //ranking_category1
                        $ranking_category1 = 0; 
                        $encrypted_ranking_category1_hex = encrypting($ranking_category1, $iv);
                        
                        //ranking_category2
                        $ranking_category2 = 0; 
                        $encrypted_ranking_category2_hex = encrypting($ranking_category2, $iv);

                        //ranking_category3
                        $ranking_category3 = 0; 
                        $encrypted_ranking_category3_hex = encrypting($ranking_category3, $iv);

                        //ranking_category4
                        $ranking_category4 = 0; 
                        $encrypted_ranking_category4_hex = encrypting($ranking_category4, $iv);

                        //level 
                        $levels = 1;  
                        $encrypted_levels_hex = encrypting($levels, $iv);

                        if(empty($error))
                        {
                            //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                            
                            $sql = "INSERT INTO players (playerID, iv, email, displayEmail, displayName, password, points, leaderboard_position, streak, last_login_time, latest_login_time, badge, ranking_category1, ranking_category2, ranking_category3, ranking_category4, levels) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $con -> prepare($sql); 
                            $playerID = NULL; 
                    
                            $stmt -> bind_param('issssssssssssssss', $playerID, $iv_hex, $hashed_email_hex, $encrypted_displayEmail_hex, $encrypted_displayName_hex, $hashed_password_hex, $encrypted_points_hex, $encrypted_leaderboard_position_hex, $encrypted_streak_hex, $encrypted_last_login_time_hex, $encrypted_latest_login_time_hex,$encrypted_badge_hex, $encrypted_ranking_category1_hex, $encrypted_ranking_category2_hex, $encrypted_ranking_category3_hex, $encrypted_ranking_category4_hex, $encrypted_levels_hex); 
                    
                            $stmt -> execute(); 

                            if($stmt -> affected_rows > 0)
                            {
                                //printf('<script>alert("Sign Up successfully"); location.href = "./login.php"</script>');
                                  
                            //iv_hex 
                            $iv = random_bytes(16); 
                            $iv_hex = bin2hex($iv);
     
                            //generate a unique token 
                            $token = generateToken(); 
    
                            //current_timestamp  
                            date_default_timezone_set('Europe/Dublin');
                            $current_timestamp = date('d-F-Y H:i:s');    
                            $encrypted_current_timestamp_hex = encrypting($current_timestamp, $iv);
     
                            //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                                
                            $sql = "INSERT INTO verify_email (eventID, iv, email, token, timestamp) values (?, ?, ?, ?, ?)";
    
                            $stmt = $con -> prepare($sql); 
                            $eventID = NULL; 
                        
                            $stmt -> bind_param('issss', $eventID, $iv_hex, $hashed_email_hex, $token, $encrypted_current_timestamp_hex); 
                        
                            $stmt -> execute(); 
                            if($stmt -> affected_rows > 0)
                            {
                                sendVerifyEmail($email, $token);
                                //printf('<script>alert("Please verify your email before you log in. \nYou have 1 hour to verify the email.")</script>');
                                $location = "displayVerifyEmail.php";
                                echo "<script type='text/JavaScript'>window.location='$location'</script>"; 
                            }

                            $stmt -> close(); 
                            //$con -> close();
                            } 

                                
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
                    
                        }//csrf end 
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
                    <input type="hidden" name="csrf_token" value="<?php echo $token?>"/>
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
</body>
</html> 