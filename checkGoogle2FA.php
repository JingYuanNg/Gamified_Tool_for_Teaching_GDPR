<!DOCTYPE html>

<?php
    //start session 
    session_start();
    
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Google Two Factor Authentication Checkpoint</title>
    <link href="css/styles.css" rel="stylesheet"/>
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
    require_once './validation.php'; 
    require_once 'vendor/autoload.php';
    ?>
<br/><br/> 
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label class="text-left txt font-weight-bold fs-5">Two-Factor Authentication Required</label>
                <br/>
                <div>
                    <label class="txt text-left">You’ve asked us to require a 6-digit login code when anyone tries to access your account from a new device or browser.
Enter the 6-digit code from your Google Authentication App</label>
                </div>
                <div>
                    <label class="txt text-center">Two-Factor Authentication Required</label>
                </div>
                <br/>
                <div class="d-flex justify-content-center"> 
                <?php 
                    $cipher = 'AES-128-CBC';
                    $key = 'thebestsecretkey'; 
 
                    if($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        if(empty($_GET['email']))
                        {
                           $location = "login.php";
                           echo "<script type='text/JavaScript'>alert('Please login and enable Google Two Factor Authentication to continue');window.location='$location'</script>"; 
                           exit();
                        }
                        elseif(!empty($_GET['email']))
                        { 
                            $email = trim($_GET['email']);
                            $_SESSION['email'] = $email;

                            $cipher = 'AES-128-CBC';
                            $key = 'thebestsecretkey';
                    
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                            $sql = "SELECT * FROM players WHERE email = '$email'";
                            $result = $con -> query($sql);

                            if($row = $result -> fetch_object())
                            { 
                                $iv = hex2bin($row -> iv); 

                                //google2FA_secretKey 
                                $google2FA_secretKey_bin = hex2bin($row -> google2FA_secretKey);
                                $google2FA_secretKey = openssl_decrypt($google2FA_secretKey_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
                                
                                $_SESSION['secretKey'] = $google2FA_secretKey;
                            }

                        }
                    } 
                    elseif($_SERVER['REQUEST_METHOD'] == 'POST')
                    { 
                        $secret_key = $_SESSION['secretKey']; 
                        
                        $user_provided_code = trim($_POST['loginCode']);

                        $google2fa = new \PragmaRX\Google2FA\Google2FA();

                        if ($google2fa->verifyKey($secret_key, $user_provided_code)) 
                        {
                            // Code is valid
                            echo "<script type='text/JavaScript'>alert('Code is valid');</script>"; 
                        
                            //store the email into session 
                            $_SESSION["pName"] = $_SESSION['email']; 

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
                                        $location = "home.php"; 
                                        echo "<script type='text/javascript'>alert('Login successfully');window.location='$location'</script>";
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
                        else 
                        {
                            // Code is NOT valid
                            echo "<script type='text/JavaScript'>alert('Code is invalid');</script>"; 
                        }
                        
                    }
                     
                ?>
                </div>
                <form id="check2FACodeForm" method="post" action="">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control txt" id="loginCode" placeholder="Login Code" name="loginCode" required="required">
                        <label for="loginCode" class="txt">Login Code</label>
                    </div> 
                    <div class="mb-3"> 
                        <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="login" name="submit" value="submit"/>
                    </div>
                </form> 
            </div>
        </div> 
    </div>
    <br>
    <!-- <input type="button" value="Logout" name="logout" class="profile-btn" onclick="location = 'logout.php'; alert('You have successfully been logout!');"/> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script> -->
</body>
</html> 