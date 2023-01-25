<!DOCTYPE html>
 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Enable Google Two Factor Authentication</title>
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
            if(empty($_SESSION["aName"]))
            {
                $location = "login.php";
                echo "<script type='text/JavaScript'>alert('Please log in as admin to continue');window.location='$location'</script>"; 
            } 
        ?>
        <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt font-weight-bold">Enable Google Two Factor Authentication</h1> 
                <br/>
                <div>
                    <label class="txt text-center fs-5"><label class="font-weight-bold">Scan the QR Code</label> below using Google Authenticator App to enable Google Two Factor Authentication</label>
                </div>
                <br/>
                <div class="d-flex justify-content-center"> 
                <?php 
                    $cipher = 'AES-128-CBC';
                    $key = 'thebestsecretkey'; 
 
                    if($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        if(empty($_GET['id']))
                        {
                            $location = "adminDetails.php";
                            echo "<script type='text/JavaScript'>alert('Please click on the Enable Google Two Factor Authentication Button to continue');window.location='$location'</script>";
                        }
                        elseif(!empty($_GET['id']))
                        {
                            //retrieve id from URL
                            $id = trim($_GET['id']);  

                            //Establish connection
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                            //SQL statement with placeholder
                            $sql = "SELECT COUNT(google2FA_secretKey) as count FROM admin WHERE adminID = ?";

                            //Prepare statement
                            $stmt = $con->prepare($sql);

                            //Bind id to the statement
                            $stmt->bind_param("i", $id);

                            //Execute statement
                            $stmt->execute();

                            $result = $stmt->get_result();

                            $row = mysqli_fetch_assoc($result);

                            if ($row['count'] > 0) 
                            {
                               $location = "adminDetails.php";
                               echo "<script type='text/JavaScript'>alert('Google Two Factor Authentication enabled before');window.location='$location'</script>"; 
                               exit();
                            } 

                            else 
                            {
                                //select iv encrypt - not yet
                                //check existence 
                                $exist = 0; 

                                //connect db 
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                                //SQL statement admin with placeholder
                                $sql = "SELECT * from admin WHERE adminID = ?"; 

                                //Prepare statement
                                $stmt = $con->prepare($sql);

                                //Bind id to the statement
                                $stmt->bind_param("i", $id);

                                //Execute statement
                                $stmt->execute();

                                $result = $stmt->get_result();

                                if($row = $result -> fetch_object())
                                {
                                    //get iv 
                                    $iv = hex2bin($row -> iv);

                                    //email 
                                    $email = $row -> email;
                                }

                                
                                $google2fa = new \PragmaRX\Google2FA\Google2FA();
                                $secret_key = $google2fa->generateSecretKey();
                                        
                                //encrypted_secret_key 
                                $encrypted_secret_key = openssl_encrypt($secret_key, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                                //encrypted_streak_hex 
                                $encrypted_secret_key_hex = bin2hex($encrypted_secret_key);
                                
                                //retrieve id from URL
                                $id = trim($_GET['id']);  

                                //Establish connection
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                //SQL statement
                                $sql = "UPDATE admin SET google2FA_secretKey = '$encrypted_secret_key_hex' WHERE adminID = '$id'";

                                if($con -> query($sql) === TRUE)
                                {
                                    $text = $google2fa->getQRCodeUrl(
                                    'Inshield',
                                    $email,
                                    $secret_key
                                    );
                                           
                                    $image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$text;
                                    echo '<img src="'.$image_url.'" />';
                                    //echo "<script type='text/JavaScript'>alert('Yayy');</script>"; 
                                }
                                else 
                                {
                                    echo 'uh-oh' . $stmt->error;
                                }
                            
                                $con -> close();
                            }

                        }
                    }
                     
                ?>
                </div> 
            </div> 
        </div> 
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