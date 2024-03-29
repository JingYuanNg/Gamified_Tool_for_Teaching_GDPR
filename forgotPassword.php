<!DOCTYPE html>
<?php
ob_start();
?>
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
    <title>INSHIELD | Forgot Password</title>
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
       require_once './headerFooterClient.php';   
       if(!empty($msg))
       {
            echo "<script>alert('$msg')</script>";
       }
    ?>
<br/><br/><br/> 
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Forgot Password</h1>
                
                <?php 

                    $exist = 0;

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

                    function sendResetPasswordEmail($email, $token)
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
                       $mail->Subject = 'Reset Your Password';
                       $mail->Body = 'Click the link below to reset your password:<br><br>' .
                                    //  'http://localhost/Inshield/reset-password.php?token=' . $token . '<br>'. 
                                     'https://c00278713.candept.com/reset-password.php?token=' . $token . '<br>'. 
                                     'Please contact us immediately by replying to this email if you did not make this request';
                       $mail->AltBody = 'Click the link below to reset your password: ' .
                                        //'http://localhost/Inshield/reset-password.php?token=' . $token . '<br>'.
                                        'https://c00278713.candept.com/reset-password.php?token=' . $token . '<br>'. 
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

                    //check if submit btn is pressed 
                    if(isset($_POST['submit']))
                    {   
                        if ($_POST['csrf_token'] !== $_SESSION['csrf_token'])
                        { 
                            die('CSRF attack detected!');
                        }
                        else
                        { 

                        $email = trim($_POST['email']);  

                        $error['email'] = validateEmailFormat($email);

                        //Remove null value in $error when there is no error
                        $error = array_filter($error);

                        //hashed_email 
                        $hashed_email = hash('sha3-256', $email, true);
                        //hashed_email_hex
                        $hashed_email_hex = bin2hex($hashed_email);

                        if(empty($error))
                        { 
                            
 
                            //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
                            $sql = "SELECT * from players WHERE email = '$hashed_email_hex'";
                            $result = mysqli_query($con, $sql); 
                            $num_rows = mysqli_num_rows($result); 
    
                            //if email is in db, generate a unique token, store it in db 
                            if($num_rows > 0)
                            { 
                                $exist = 1;
                                $cipher = 'AES-128-CBC';
                                $key = 'thebestsecretkey';
    
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
                                $sql = "INSERT INTO password_reset (eventID, iv, email, token, timestamp) values (?, ?, ?, ?, ?)";
    
                                $stmt = $con -> prepare($sql); 

                                $eventID = NULL; 
                        
                                $stmt -> bind_param('issss', $eventID, $iv_hex, $hashed_email_hex, $token, $encrypted_current_timestamp_hex); 
                                
                                $stmt -> execute(); 

                                if($stmt -> affected_rows > 0)
                                { 
                                    sendResetPasswordEmail($email, $token);
                                      printf('<script>alert("Email with link to reset password sent.\nYou have 15 minutes to reset the password.")</script>');
                                      $location = "forgotPassword.php";
                                      echo "<script type='text/JavaScript'>window.location='$location'</script>"; 
                                }
                                else 
                                { 
                                    printf('<script>alert("Error: %s")</script>', $stmt->error);
                                }
    
                                $stmt -> close(); 
                                //$con -> close();
                                
                            } 
    
                            if($exist == 0)
                            {
                                //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
                               $sql = "SELECT * from admin WHERE email = '$hashed_email_hex'";
                               $result = mysqli_query($con, $sql); 
                               $num_rows = mysqli_num_rows($result); 
                            
                              //if email is in db, generate a unique token, store it in db 
                              if($num_rows > 0)
                               { 
                                  $exist = 1;
                                  $cipher = 'AES-128-CBC';
                                  $key = 'thebestsecretkey';
        
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
                                    
                                  $sql = "INSERT INTO password_reset (eventID, iv, email, token, timestamp) values (?, ?, ?, ?, ?)";
        
                                  $stmt = $con -> prepare($sql); 
                                  $eventID = NULL; 
                            
                                  $stmt -> bind_param('issss', $eventID, $iv_hex, $email, $token, $encrypted_current_timestamp_hex); 
                            
                                 $stmt -> execute(); 
                                  if($stmt -> affected_rows > 0)
                                  {
                                      sendResetPasswordEmail($email, $token);
                                      printf('<script>alert("Email with link to reset password sent.\nYou have 15 minutes to reset the password.")</script>');
                                      $location = "forgotPassword.php";
                                      echo "<script type='text/JavaScript'>window.location='$location'</script>"; 
                                  }
                                
                                  $stmt -> close(); 
                                  //$con -> close();
                                       
                              }
                            }
                           
                            if($exist == 0) 
                            { 
                               printf('<script>alert("Email entered is not registered.")</script>');
                               
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
                
                <form id="forgotPassForm" method="post" action="">
                    <br/>
                    <div><label class="txt text-center">Just enter your email address below and
we’ll send you a link to reset your password</label></div><br/>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control txt" id="email" placeholder="Email" name="email" required="required">
                        <label for="email" class="txt">Email</label>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $token?>"/>
                    <div class="mb-3"> 
                        <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="submit" name="submit" value="Submit"/>
                    </div>
                </form> 

                <div class="login-link">
                <hr>
                <div class="text-center">
                    <a class="txt" href="login.php">Back</a>
                </div> 
                </div> 
            </div>
        </div> 
    </div> 
</body>
</html> 