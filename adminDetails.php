<!DOCTYPE html>
 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Admin Details</title>
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

    a:hover 
    {
        text-decoration: none !important;
    }
</style>

<body id="page-top">
    <!-- Page Wrapper --> 
    <div id="wrapper">
        <?php 
            include './headerFooterAdmin.php';
            require_once './validation.php';  
            if(empty($_SESSION["aName"]))
            {
                $location = "login.php";
                echo "<script type='text/JavaScript'>alert('Please log in as admin to continue');window.location='$location'</script>"; 
            } 
        ?>
        <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt font-weight-bold"><?php echo $_SESSION["aName"] ?></h1> 
                <div class="mb-3">
                <br/>
                <div class="text-center">
                    <?php 
                        $email = $_SESSION["aName"]; 

                        //hashed_email 
                        $hashed_email = hash('sha3-256', $email, true);
                        //hashed_email_hex
                        $hashed_email_hex = bin2hex($hashed_email);


                        $cipher = 'AES-128-CBC';
                        $key = 'thebestsecretkey';
                    
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                        $sql = "SELECT * FROM admin WHERE email = '$hashed_email_hex'";
                        $result = $con -> query($sql); 
                    
                        if($row = $result -> fetch_object())
                        { 
                          //get adminID 
                          $adminID = $row -> adminID; 
                    
                          //get iv 
                          $iv = hex2bin($row -> iv); 

                          printf('<a href="adminTwoFactorAuth.php?id=%d" class="btn btn-block btn-design txt fs-5">Enable Google Two Factor Authentication</a>', $row -> adminID);
                        }
                        $result->free();
                        $con->close();
                    ?>
                    
                </div>
                <br/> 
                <div class="text-center">
                    <input type="submit" class="btn btn-block btn-design txt fs-5" aria-pressed="true" id="logout" name="logout" value="Logout" onclick="location = 'logoutAdmin.php'; alert('You have successfully been logout!');"/>
                </div>
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