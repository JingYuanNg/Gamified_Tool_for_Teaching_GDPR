<!DOCTYPE html>

<?php
    //session_start(); 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Add Admin</title>
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
        ?>
        <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Add Admin</h1> 
                <?php 
                    if(isset($_POST['addAdmin']))
                    {
                        $email = trim($_POST['email']);
                        $password = trim($_POST['password']); 
                        $confirmPassword = trim($_POST['confirmPassword']); 

                        $error['email'] = validateEmail($email);
                        $error['password'] = validatePassword($password);
                        $error['confirmPassword'] = validateConfirmPassword($password, $confirmPassword);
                        
                        $error = array_filter($error); 

                        $cipher = 'AES-128-CBC';
                        $key = 'thebestsecretkey';

                        //iv_hex 
                        $iv = random_bytes(16); 
                        $iv_hex = bin2hex($iv);  

                        //hashed_password 
                        $hashed_password = hash('sha3-256', $password, true);
                        //hashedPassword_hex 
                        $hashed_password_hex = bin2hex($hashed_password);

                        if(empty($error))
                        {
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                            $sql = "INSERT INTO admin (adminID, iv, email, password) values (?, ?, ?, ?)"; 

                            $stmt = $con -> prepare($sql); 

                            $adminID = NULL; 

                            $stmt -> bind_param('isss', $adminID, $iv_hex, $email, $hashed_password_hex);

                            $stmt -> execute(); 

                            if($stmt -> affected_rows > 0)
                            {
                                printf('<script>alert("Admin added successfully"); location.href="./login.php"</script>');
                            }

                            $stmt -> close(); 
                            $con -> close();
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
                ?> 
             <form class="user" action="" method="post" enctype='multipart/form-data'>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control txt txt-resize" id="email" name="email" placeholder="Email" autofocus="autofocus" required="required">
                    <label for="signUpEmail" class="txt txt-resize">Email</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" class="form-control txt  txt-resize" id="password" name="password" placeholder="Password" required="required">
                    <label for="signUpPassword" class="txt txt-resize">Password</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" class="form-control txt txt-resize" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required="required">
                    <label for="signUpConfirmPassword" class="txt txt-resize">Confirm Password</label>
                </div>
                <div class="mb-3"> 
                    <button type="submit" class="btn btn-block btn-design txt txt-resize h-auto btn-txt" aria-pressed="true" id="addAdmin" name="addAdmin">Add Admin</button>
                </div>
             </form> 

                <div class="login-link">
                    <hr>
                    <div class="text-center">
                        <a class="txt txt-resize" href="login.php">Login</a>
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