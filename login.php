<!DOCTYPE html>

<?php
    //start session 
    session_start(); 
    require_once './validation.php';

    //check whether login btn is pressed 
    if(isset($_POST['login']))
    {
        $email = trim($_POST['email']);

        //Establish connection
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        //SQL statement
        $sql = "SELECT * FROM verify_email WHERE email = '$email'";

        //Execute SQL and store record in $result
        $result = $con -> query($sql);

        if($row = $result -> fetch_object())
        {
            $location = "login.php"; 
            echo "<script type='text/javascript'>alert('Please verify your email before login');window.location='$location'</script>";
            exit();
        }

        //Close connection
        $result -> free();
        $con -> close();

        //retrieve user input 
        $email = trim($_POST['email']); 
        $password = trim($_POST['password']);  

        //hashedPassword 
        $hashedPassword = hash('sha3-256', $password, true); 
        //hashedPassword_hex 
        $hashedPassword_hex = bin2hex($hashedPassword); 

        //check existence 
        $exist = 0; 

        //connect db 
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

        //SQL statement players
        $sql = "SELECT * from players"; 

        //get result from sql 
        $result = $con -> query($sql); 

        //get data from both side 
        while($row = $result -> fetch_object())
        {
            $pEmail = $row -> email;
            $pPassword = $row -> password; 
            $pName = $row -> email; 

           
            //compare email with pass 
            if(strcmp($pEmail, $email) == 0 && strcmp($pPassword, $hashedPassword_hex) == 0)
            {
                //If both data are correct then exist = 1 
                $exist = 1; 

                //Establish connection
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                $query = "SELECT COUNT(google2FA_secretKey) as count FROM players WHERE email = '$email'";
                
                $result = mysqli_query($con, $query);
                
                $row = mysqli_fetch_assoc($result);
                
                if ($row['count'] > 0) 
                {
                    $location = "checkGoogle2FA.php?email=" . $email;
                    echo "<script type='text/JavaScript'>window.location='$location'</script>"; 
                    exit();
                }
                else
                {
                    //store the email into session 
                    $_SESSION["pName"] = $pName; 

                    $email = $_SESSION["pName"]; 

                    $cipher = 'AES-128-CBC';
                    $key = 'thebestsecretkey';

                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                    $sql = "SELECT * FROM players WHERE email = '$email'";
                    $result = $con -> query($sql); 

                    if($row = $result -> fetch_object())
                    {
                    
                        //get iv 
                        $iv = hex2bin($row -> iv); 

                        //get latest_login_time 
                        $latest_login_time = hex2bin($row -> latest_login_time); 

                        //assign latest_login_time to last_login_time 
                        $last_login_time = $latest_login_time; 
                        $encrypted_last_login_time_hex = bin2hex($last_login_time);

                        //latest_login_time
                        date_default_timezone_set('Europe/Dublin');
                        $date_now = date('d-F-Y H:i:s'); 
                        $encrypted_latest_login_time = openssl_encrypt($date_now, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                        $encrypted_latest_login_time_hex = bin2hex($encrypted_latest_login_time);

                        $con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        $sql = "UPDATE players SET last_login_time = ? , latest_login_time = ? WHERE email = ?";
                        $stmt = $con ->prepare($sql);
                        $stmt -> bind_param('sss', $encrypted_last_login_time_hex, 
                                               $encrypted_latest_login_time_hex,
                                               $email);

                        if($stmt -> execute())
                        {
                            //echo $date_now . '<br/>' . $encrypted_date_now_hex; 
                        }
                        else
                        {
                        
                        }  

                        $cipher = 'AES-128-CBC';
                        $key = 'thebestsecretkey';
                
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                        $sql = "SELECT * FROM players WHERE email = '$email'";
                        $result = $con -> query($sql); 
                
                        if($row = $result -> fetch_object())
                        {
                            //get iv 
                            $iv = hex2bin($row -> iv);

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
                            echo '$year_last_login_time: ' . $year_last_login_time . "<br/><br/>"; 
 */
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
                            echo '$year_latest_login_time: ' . $year_latest_login_time . "<br/><br/>"; 
 */
                            //streak 
                            $streak_bin = hex2bin($row -> streak);
                            $streak = openssl_decrypt($streak_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
                        
                            //track number of consecutive login days
                            $consecutive_login_days = $streak; 

                            //if same year is same 
                            if($year_latest_login_time == $year_last_login_time)
                            {
                                //make sure month is same 
                                if($month_latest_login_time == $month_last_login_time)
                                {
                                    if($day_latest_login_time - $day_last_login_time === 0)
                                    {
                                        //$consecutive_login_days = $consecutive_login_days; 
                                    }
                                    elseif($day_latest_login_time - $day_last_login_time === 1)
                                    {
                                        $consecutive_login_days++; 
                                    } 
                                    else 
                                    {
                                        $consecutive_login_days = 0;
                                    }
                                }
                                else 
                                {
                                    $consecutive_login_days = 0; 
                                }
                            }
                            else 
                            {
                                $consecutive_login_days = 0; 
                            }

                            //encrypted_streak 
                           $encrypted_streak = openssl_encrypt($consecutive_login_days, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                           //encrypted_streak_hex 
                           $encrypted_streak_hex = bin2hex($encrypted_streak);

                          $con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                          $sql = "UPDATE players SET streak = ? WHERE email = ?";
                          $stmt = $con ->prepare($sql);
                          $stmt -> bind_param('ss', $encrypted_streak_hex, $email);
                    
                          if($stmt -> execute())
                          {
                              //update successful 
                              //echo '$consecutive_login_days: ' . $consecutive_login_days . '<br/>';
                         }
                          else 
                         {
                              echo 'Uh-oh'. '<br/>'; 
                         }
                    
                        }
                        $stmt -> close();
                        $con -> close();
                    
                    
                    }
                }

                

                $location = "home.php"; 
                echo "<script type='text/javascript'>alert('Login successfully');window.location='$location'</script>";
                
            }
        }

        //if no exists check admin site 
        if($exist == 0)
        {
            //admin SQL statement 
            $sql = "SELECT * FROM admin"; 

            //Get the result 
            $result = $con -> query($sql); 

            while($row = $result->fetch_object())
            {
                $aEmail = $row -> email; 
                $aPassword = $row -> password; 
                $aName = $row -> email; 

                if(strcmp($aEmail, $email) == 0 && strcmp($aPassword, $hashedPassword_hex) == 0)
                {
                    //If both data are correct then exist = 1 
                    $exist = 1; 
                        
                    //Establish connection
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    $query = "SELECT COUNT(google2FA_secretKey) as count FROM admin WHERE email = '$email'";
                
                    $result = mysqli_query($con, $query);
                
                    $row = mysqli_fetch_assoc($result);
                
                    if ($row['count'] > 0) 
                    {
                        $location = "adminCheckGoogle2FA.php?email=" . $email;
                        echo "<script type='text/JavaScript'>window.location='$location'</script>"; 
                        exit();
                    }
                    else
                    {
                        $location = "adminDashboard.php"; 
                        echo "<script type='text/javascript'>alert('Login successfully as admin');window.location='$location'</script>";
                    
                        //store the email into session 
                        $_SESSION["aName"] = $aName; 
                    }
                    
                }
            }
        }

        //check whether exists or not 
        if($exist === 1)
        {
            $successMsg = "Login successfully";
            echo "<script type='type/javascript'>alert('$successMsg'); window.location = '$location'</script>";
        }
        else 
        {
            $msg = "Your email and password are not match !";
        }
    }
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Login</title>
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
       if(!empty($msg))
       {
            echo "<script>alert('$msg')</script>";
       }
    ?>
<br/><br/><br/><br/><br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Login</h1>
                
                <form id="loginForm" method="post" action="">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control txt" id="email" placeholder="Email" name="email" required="required">
                        <label for="email" class="txt">Email</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control txt" id="password" placeholder="Password"  name="password" required="required">
                        <label for="password" class="txt">Password</label>
                    </div>
                    <div class="mb-3"> 
                        <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="login" name="login" value="Login"/>
                    </div>
                </form> 

                <div class="login-link">
                <hr>
                <div class="text-center">
                    <a class="txt" href="forgotPassword.php">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="txt" href="signUp.php">Create an Account</a>
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