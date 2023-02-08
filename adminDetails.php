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
            require_once './headerFooterAdmin.php'; 
            if(empty($_SESSION["aName"]) || empty($_SESSION['aftLoggedIn']))
            {
                $location = "login.php";
                echo "<script type='text/JavaScript'>alert('Please log in as an admin to continue');window.location='$location'</script>"; 
            }
            else 
            {
                $email = $_SESSION["aName"]; 
            }

            
        ?>


        <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt font-weight-bold"><?php echo $_SESSION["aName"] ?></h1> 
                <br/>
                <div class="mb-3"> 
                <div class="text-center">
                    <?php 
                        $email = $_SESSION["aName"]; 

                        //hashed_email 
                        $hashed_email = hash('sha3-256', $email, true);
                        //hashed_email_hex
                        $hashed_email_hex = bin2hex($hashed_email); 

                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                        $sql = "SELECT * FROM admin WHERE email = '$hashed_email_hex'";
                        $result = $con -> query($sql); 
                    
                        if($row = $result -> fetch_object())
                        { 
                          //get adminID 
                          $adminID = $row -> adminID; 
                    
                          //get iv 
                          $iv = hex2bin($row -> iv); 

                          printf('<a href="adminTwoFactorAuth.php?id=%d" class="btn btn-block btn-design txt fs-5 d-flex align-items-center justify-content-center">Enable Google Two Factor Authentication</a>', $row -> adminID);
                        }
                        $result->free();
                        $con->close();
                    ?>
                    
                </div>
                </div>

                <div class="mb-3">
                    <div class="text-center">
                    <?php 
                        $email = $_SESSION["aName"]; 

                        //hashed_email 
                        $hashed_email = hash('sha3-256', $email, true);
                        //hashed_email_hex
                        $hashed_email_hex = bin2hex($hashed_email); 

                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                        $sql = "SELECT * FROM admin WHERE email = '$hashed_email_hex'";
                        $result = $con -> query($sql); 
                    
                        if($row = $result -> fetch_object())
                        { 
                          //get adminID 
                          $adminID = $row -> adminID; 
                    
                          //get iv 
                          $iv = hex2bin($row -> iv); 

                          printf('<a href="adminChangePass.php?id=%d" class="btn btn-block btn-design txt fs-5 d-flex align-items-center justify-content-center">Change Password</a>', $row -> adminID);
                        }
                        $result->free();
                        $con->close();
                    ?>
                    </div> 
                </div>

                <div class="mb-3">
                    <div class="text-center">
                        <input type="submit" class="btn btn-block btn-design txt fs-5 d-flex justify-content-center" aria-pressed="true" id="logout" name="logout" value="Logout" onclick="location = 'logoutAdmin.php'; alert('You have successfully been logout!');"/> 
                    </div> 
                </div>
            </div> 
        </div> 
        </div>
    </div> 
 
</body>
</html> 