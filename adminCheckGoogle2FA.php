<!DOCTYPE html>
 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Google Two Factor Authentication Checkpoint</title>
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>   

    .display-top
    {
        padding-top: 20px;
    }

    .display-inside
    {
        padding-top: 50px;
    }

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
</style>

<body id="page-top">
    <!-- Page Wrapper --> 
    <div id="wrapper">
        <?php 
            include './headerFooterAdmin.php';
            require_once './validation.php';  
            require_once 'vendor/autoload.php';
        ?>
        <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <label class="text-left txt font-weight-bold fs-4">Two-Factor Authentication Required</label>
                <br/>
                <div>
                    <label class="txt text-left fs-5">You’ve asked us to require a 6-digit login code when anyone tries to access your account from a new device or browser.
Enter the 6-digit code from your Google Authentication App</label>
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
                            
                            $error['email'] = validateEmail($email);

                            //Remove null value in $error when there is no error
                            $error = array_filter($error);

                            if(empty($error))
                            {
                                $_SESSION['email'] = $email;

                                //hashed_email 
                      	        $hashed_email = hash('sha3-256', $email, true);
                                //hashed_email_hex
                                $hashed_email_hex = bin2hex($hashed_email);

                                $cipher = 'AES-128-CBC';
                                $key = 'thebestsecretkey';
                    
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                                //SQL statement with placeholder
                                $sql = "SELECT * FROM admin WHERE email = ?";

                                //Prepare statement
                                $stmt = $con->prepare($sql);

                                //Bind email to the statement
                                $stmt->bind_param("s", $hashed_email_hex);

                                //Execute statement
                                $stmt->execute();

                                $result = $stmt->get_result();

                                if($row = $result -> fetch_object())
                                { 
                                    $iv = hex2bin($row -> iv); 

                                    //google2FA_secretKey 
                                    $google2FA_secretKey_bin = hex2bin($row -> google2FA_secretKey); 
                                    $google2FA_secretKey = decrypting($google2FA_secretKey_bin, $iv);

                                    $_SESSION['secretKey'] = $google2FA_secretKey;
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

                        }
                    } 
                    elseif($_SERVER['REQUEST_METHOD'] == 'POST')
                    { 
                        $secret_key = $_SESSION['secretKey']; 

                        $email = $_SESSION['email'];
                        
                        //hashed_email 
                      	$hashed_email = hash('sha3-256', $email, true);
                        //hashed_email_hex
                        $hashed_email_hex = bin2hex($hashed_email);
                        
                        $user_provided_code = trim($_POST['loginCode']);

                        $google2fa = new \PragmaRX\Google2FA\Google2FA();

                        if ($google2fa->verifyKey($secret_key, $user_provided_code)) 
                        {
                            // Code is valid
                            echo "<script type='text/JavaScript'>alert('Code is valid');</script>"; 
                        
                            //store the email into session 
                            $_SESSION["aName"] = $_SESSION['email'];  

                            $cipher = 'AES-128-CBC';
                            $key = 'thebestsecretkey';

                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                            //SQL statement with placeholder
                            $sql = "SELECT * FROM admin WHERE email = ?";

                            //Prepare statement
                            $stmt = $con->prepare($sql);

                            //Bind email to the statement
                            $stmt->bind_param("s", $hashed_email_hex);

                            //Execute statement
                            $stmt->execute();

                            $result = $stmt->get_result();

                            if($row = $result -> fetch_object())
                            {
                                session_regenerate_id();
                                $_SESSION['aftLoggedIn'] = session_id();
                                $location = "adminDashboard.php"; 
                                echo "<script type='text/javascript'>alert('Login successfully as admin');window.location='$location'</script>";
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
                        <input type="text" class="form-control txt fs-5" id="loginCode" placeholder="Login Code" name="loginCode" required="required">
                        <label for="loginCode" class="txt fs-5">Login Code</label>
                    </div> 
                    <div class="mb-3"> 
                        <input type="submit" class="btn btn-block btn-design font-weight-bold txt fs-5" aria-pressed="true" id="login" name="submit" value="submit"/>
                    </div>
                </form> 
                </div> 
            </div> 
        </div> 
        </div>
    </div>  
</body>
</html> 