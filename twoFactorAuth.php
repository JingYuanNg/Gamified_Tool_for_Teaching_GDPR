<!DOCTYPE html> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Google Two Factor Authentication </title>
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
    require_once 'vendor/autoload.php';
    if(empty($_SESSION["pName"]) || empty($_SESSION['aftLoggedIn']))
    {
        $location = "login.php";
        echo "<script type='text/JavaScript'>alert('Please log in to continue');window.location='$location'</script>"; 
        exit();
    } 
    ?>
<br/><br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Enable Google Two Factor Authentication</h1>
                <br/>
                <div>
                    <label class="txt text-center"><label class="font-weight-bold">Scan the QR Code</label> below using Google Authenticator App to enable Google Two Factor Authentication</label>
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
                            $location = "playerProfile.php";
                            echo "<script type='text/JavaScript'>alert('Please click on the Enable Google Two Factor Authentication Button from Player Profile to continue');window.location='$location'</script>";
                        }
                        elseif(!empty($_GET['id']))
                        {
                            //select from player table 
                            //retrieve id from URL
                            $id = trim($_GET['id']);  

                            $error['id'] = validateInteger($id);

                            //Remove null value in $error when there is no error
                            $error = array_filter($error);
        
                            if(empty($error))
                            {
                                //Establish connection
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                //SQL statement with placeholder
                                $sql = "SELECT COUNT(google2FA_secretKey) as count FROM players WHERE playerID = ?";

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
                                    $location = "playerProfile.php";
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

                                    //SQL statement players
                                    $sql = "SELECT * from players WHERE playerID = '$id'"; 

                                    //get result from sql 
                                    $result = $con -> query($sql); 

                                    if($row = $result -> fetch_object())
                                    {
                                        //get iv 
                                        $iv = hex2bin($row -> iv);

                                        //email 
                                        $email = $row -> email;
                                    }
                                
                                    $google2fa = new \PragmaRX\Google2FA\Google2FA();
                                    $secret_key = $google2fa->generateSecretKey();
                                         
                                    $encrypted_secret_key_hex = encrypting($secret_key, $iv);

                                    //retrieve id from URL
                                    $id = trim($_GET['id']);  

                                    //Establish connection
                                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                    //SQL statement
                                    $sql = "UPDATE players SET google2FA_secretKey = '$encrypted_secret_key_hex' WHERE playerID = '$id'";

                                    if($con -> query($sql) === TRUE)
                                    {
                                        $text = $google2fa->getQRCodeUrl(
                                        'Inshield',
                                        $email,
                                        $secret_key
                                        );
                                           
                                        $image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$text;
                                        echo '<img src="'.$image_url.'" />'; 
                                    }
                                    else 
                                    {
                                        echo 'uh-oh' . $stmt->error;
                                    }
                            
                                    $con -> close();
                                }
                            }
                            

                        }
                    }
                     
                ?>
                </div> 
            </div>
        </div> 
    </div>
    <br> 
</body>
</html> 