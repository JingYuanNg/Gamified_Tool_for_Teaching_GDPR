<!DOCTYPE html>
 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Admin Change Password</title>
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
            require_once './headerFooterAdmin.php'; 
            if(empty($_SESSION["aName"]) || empty($_SESSION['aftLoggedIn']))
            {
                $location = "login.php";
                echo "<script type='text/JavaScript'>alert('Please log in as an admin to continue');window.location='$location'</script>"; 
            }
        ?>
        <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt font-weight-bold">Change Password</h1> 
                <br/>
                <div class="mb-3"> 
                <div class="text-center">
                    <?php 
                        if($_SERVER['REQUEST_METHOD'] == 'GET')
                        {
                            if(empty($_GET['id']))
                            {
                                $location = "adminDetails.php";
                                echo "<script type='text/JavaScript'>alert('Please click on the Change Password Button from Player Profile to continue');window.location='$location'</script>";
                            }
                            elseif(!empty($_GET['id']))
                            {
                                //select from admin table 
                                //retrieve id from URL
                                $id = trim($_GET['id']);  
    
                                $error['id'] = validateInteger($id);
    
                                //Remove null value in $error when there is no error
                                $error = array_filter($error);
            
                                if(empty($error))
                                {
                                    echo '<form class="user" action="adminChangePass.php" method="post" enctype="multipart/form-data">';
                                    echo '<br/>';
                 
                                    echo '<div class="mb-3 form-floating">';
                                    echo '    <input type="password" class="form-control txt fs-5" id="password" placeholder="New Password" name="password" required="required">';
                                    echo '    <label for="password" class="txt fs-5">New Password</label>';
                                    echo '</div>';
                                    echo '<div class="mb-3 form-floating">';
                                    echo '    <input type="password" class="form-control txt fs-5" id="confirmPassword" placeholder="Confirm New Password" name="confirmPassword" required="required">';
                                    echo '    <label for="confirmPassword" class="txt fs-5">Confirm New Password</label>';
                                    echo '</div>';
                                    echo '<div class="mb-3">';
                                    echo '    <input type="submit" class="btn btn-block btn-design font-weight-bold txt fs-5" aria-pressed="true" id="submit" name="submit" value="Submit"/>';
                                    echo '</div>';
                                    echo '</form>';   
                                }
                                else
                                {
                                    //display error msg 
                                    echo "<ul class=‘error’>";
                                    foreach ($error as $value)
                                    {
                                        echo "<li style='color: black;'>$value</li>";
                                        echo "</ul>";
                                    }
    
                                    echo '<form class="user" action="adminChangePass.php" method="post" enctype="multipart/form-data">';
                                    echo '<br/>';
                 
                                    echo '<div class="mb-3 form-floating">';
                                    echo '    <input type="password" class="form-control txt fs-5" id="password" placeholder="New Password" name="password" required="required">';
                                    echo '    <label for="password" class="txt fs-5">New Password</label>';
                                    echo '</div>';
                                    echo '<div class="mb-3 form-floating">';
                                    echo '    <input type="password" class="form-control txt fs-5" id="confirmPassword" placeholder="Confirm New Password" name="confirmPassword" required="required">';
                                    echo '    <label for="confirmPassword" class="txt fs-5">Confirm New Password</label>';
                                    echo '</div>';
                                    echo '<div class="mb-3">';
                                    echo '    <input type="submit" class="btn btn-block btn-design font-weight-bold txt fs-5" aria-pressed="true" id="submit" name="submit" value="Submit"/>';
                                    echo '</div>';
                                    echo '</form>';   
                                }
                                
    
                            }
                        }
                        elseif($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            if(isset($_POST['submit']))
                            {
                                //POST method to reset pass 
                                //trim 
                                $password = trim($_POST['password']); 
                                $confirmPassword = trim($_POST['confirmPassword']); 
    
                                //validation
                                $error['password'] = validatePassword($password);
                                $error['confirmPassword'] = validateConfirmPassword($password, $confirmPassword);
                        
                                //Remove null value in $error when there is no error
                                $error = array_filter($error); 
    
                                if(empty($error))
                                {
                                    //trim 
                                    $password = trim($_POST['password']); 
                                    $confirmPassword = trim($_POST['confirmPassword']); 
    
                                    //Remove null value in $error when there is no error
                                    $error = array_filter($error); 
    
                                    //hashed_password 
                                    $hashed_password = hash('sha3-256', $password, true);
                                    //hashedPassword_hex 
                                    $hashed_password_hex = bin2hex($hashed_password);
                                
                                    //hashed_email 
                                    $hashed_email = hash('sha3-256', $email, true);
                                    //hashed_email_hex
                                    $hashed_email_hex = bin2hex($hashed_email);
                            
                                    //player forgot pass 
                                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
    
                                    //SQL statement
                                    $sql = "UPDATE admin SET password = '$hashed_password_hex' WHERE email = '$hashed_email_hex'"; 
                                    if($con -> query($sql) === TRUE)
                                    { 
                                        $location = "adminDetails.php";
                                        echo "<script type='text/JavaScript'>alert('Password changed successfully');window.location='$location'</script>"; 
                                    }
                                    else 
                                    {
                                        echo 'uh-oh' . $stmt->error;
                                    }
                                }
                                else
                                {
                                    //display error msg 
                                    echo "<ul class=‘error’>";
                                    foreach ($error as $value)
                                    {
                                        echo "<li style='color: black;'>$value</li>";
                                        echo "</ul>";
                                    }
    
                                    echo '<form class="user" action="adminChangePass.php" method="post" enctype="multipart/form-data">';
                                    echo '<br/>';
                 
                                    echo '<div class="mb-3 form-floating">';
                                    echo '    <input type="password" class="form-control txt fs-5" id="password" placeholder="New Password" name="password" required="required">';
                                    echo '    <label for="password" class="txt fs-5">New Password</label>';
                                    echo '</div>';
                                    echo '<div class="mb-3 form-floating">';
                                    echo '    <input type="password" class="form-control txt fs-5" id="confirmPassword" placeholder="Confirm New Password" name="confirmPassword" required="required">';
                                    echo '    <label for="confirmPassword" class="txt fs-5">Confirm New Password</label>';
                                    echo '</div>';
                                    echo '<div class="mb-3">';
                                    echo '    <input type="submit" class="btn btn-block btn-design font-weight-bold txt fs-5" aria-pressed="true" id="submit" name="submit" value="Submit"/>';
                                    echo '</div>';
                                    echo '</form>';   
                                }
                            }
                        } 
                    ?> 
            </div> 
        </div> 
        </div>
    </div> 
 
</body>
</html> 