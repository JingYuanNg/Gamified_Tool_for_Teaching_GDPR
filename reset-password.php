<!DOCTYPE html> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Reset Password</title>
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
                <h1 class="text-center txt">Reset Password</h1>
                
                <?php 
                    $cipher = 'AES-128-CBC';
                    $key = 'thebestsecretkey';
                    $exist = 0; 

                    // Generate a unique token for the user session
                    if (!isset($_SESSION['csrf_token'])) 
                    {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
                    }

                    $csrf_token = $_SESSION['csrf_token'];  

                    if($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        if(empty($_GET['token']))
                        {
                            $location = "home.php";
                            echo "<script type='text/JavaScript'>alert('You are not valid to visit this page');window.location='$location'</script>";
                        }
                        elseif(!empty($_GET['token']))
                        {
                            //retrieve token from URL
                            $token = trim($_GET['token']);

                            $error['token'] = validateString($token);

                            //Remove null value in $error when there is no error
                            $error = array_filter($error);
        
                            if(empty($error))
                            {
                                
                            $_SESSION['token'] = $token;
                            //Establish connection
                            //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                            //SQL statement 
                            $sql = "SELECT * FROM password_reset WHERE token = ?";

                            // Create a prepared statement object
                            $stmt = $con->prepare($sql);

                            // Bind the token parameter to the prepared statement
                            $stmt->bind_param("s", $token);

                            // Execute the prepared statement and store the result in $result
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Check if there is a row in the result set
                            if ($row = $result->fetch_object())
                            { 
                                //eventID 
                                //iv 
                                $iv =  hex2bin($row -> iv); 

                                //email 
                                $email = $row -> email;

                                //timestamp 
                                $timestamp_bin = hex2bin($row -> timestamp);  
                                $timestamp_b4formatting = decrypting($timestamp_bin, $iv);

                                $timestamp = new DateTime($timestamp_b4formatting); 
                                
                                $_SESSION['email'] = $email; 

                                date_default_timezone_set('Europe/Dublin');
                                $now = new DateTime(); 
                                
                                //make sure the year, month, day, hour are the same 
                                //if diff 
                                if($now->format('Y-m-d H') != $timestamp->format('Y-m-d H')) 
                                {   
                                    //Establish connection
                                    //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                    //SQL statement
                                    $sql="DELETE FROM password_reset WHERE token ='". $token . "'";
         
                                    echo '$sql: ' . $sql . '<br/>';

                                    if($con -> query($sql))
                                    {  
                                        $location = "home.php";
                                        echo "<script type='text/JavaScript'>alert('Token expired');window.location='$location'</script>";
                                    } 
                                   
                                }
                                else //if same 
                                {
                                    //intval() = convert min in time to int 
                                    $now_minutes = intval($now->format('i'));
                                    $timestamp_minutes = intval($timestamp->format('i'));

                                    //abs() = return absolute value (num without sign (-/+))
                                    $diff_minutes = abs($now_minutes - $timestamp_minutes); 

                                    //when over 15 minutes
                                    if($diff_minutes > 15) 
                                    {
                                        $location = "home.php";
                                        echo "<script type='text/JavaScript'>alert('Token expired');window.location='$location'</script>";
                                    }
                                    else
                                    {
                                        echo '<form class="user" action="reset-password.php" method="post" enctype="multipart/form-data">';
                                        echo '<br/>';
                     
                                        echo '<div class="mb-3 form-floating">';
                                        echo '    <input type="password" class="form-control txt" id="password" placeholder="New Password" name="password" required="required">';
                                        echo '    <label for="password" class="txt">New Password</label>';
                                        echo '</div>';
                                        echo '<div class="mb-3 form-floating">';
                                        echo '    <input type="password" class="form-control txt" id="confirmPassword" placeholder="Confirm New Password" name="confirmPassword" required="required">';
                                        echo '    <label for="confirmPassword" class="txt">Confirm New Password</label>';
                                        echo '</div>';
                                        echo '<input type="hidden" name="csrf_token" value="'.$csrf_token.'">';
                                        echo '<div class="mb-3">';
                                        echo '    <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="submit" name="submit" value="Submit"/>';
                                        echo '</div>';
                                        echo '</form>';
                                    }
                                }
                                 
                                
                            }
                            else 
                            {
                                $location = "home.php";
                                echo "<script type='text/JavaScript'>alert('Invalid token');window.location='$location'</script>";
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
                                exit();
                            } 
                        }//end 
                        }
                    }
                    elseif($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        if(isset($_POST['submit']))
                        {
                            if ($_POST['csrf_token'] !== $_SESSION['csrf_token'])
                            {  
                                die('CSRF attack detected!');
                            }
                            else
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
                            
                            //store in session to get the email from the if statement above 
                            $email = $_SESSION['email'];

                            //store in session to get the token from the if statement above 
                            $token = $_SESSION['token']; 

                            //select from player table
                            //Establish connection
                            //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                            //SQL statement
                            $sql = "SELECT * FROM players WHERE email = '$email'";

                            //Execute SQL and store record in $result
                            $result = $con -> query($sql);

                            if($row = $result -> fetch_object())
                            {
                                $exist = 1; 

                                //player forgot pass 
                                //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                                //SQL statement
                                $sql = "UPDATE players SET password = '$hashed_password_hex' WHERE email = '$email'"; 
                            
                                // if($stmt -> execute())
                                if($con -> query($sql) === TRUE)
                                {   
                                    //Establish connection
                                    //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                    //SQL statement
                                    $sql="DELETE FROM password_reset WHERE token ='". $token . "'";
             
                                    echo '$sql: ' . $sql . '<br/>';

                                    if($con -> query($sql))
                                    { 
                                        $location = "login.php";
                                        echo "<script type='text/JavaScript'>alert('Password reset successfully');window.location='$location'</script>"; 
                                    } 
                                }
                                else 
                                {
                                    echo 'uh-oh' . $stmt->error;
                                } 
                            }
 
                            if($exist == 0)
                            {
                                //select from admin table 
                                //Establish connection
                                //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                //SQL statement
                                $sql = "SELECT * FROM admin WHERE email = '$email'";

                                //Execute SQL and store record in $result
                                $result = $con -> query($sql);

                                if($row = $result -> fetch_object())
                                {
                                    $exist = 1; 

                                    //player forgot pass 
                                    //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                                    //SQL statement
                                    $sql = "UPDATE admin SET password = '$hashed_password_hex' WHERE email = '$email'"; 
                            
                                    // if($stmt -> execute())
                                    if($con -> query($sql) === TRUE)
                                    {   
                                        //Establish connection
                                        //$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                        //SQL statement
                                        $sql="DELETE FROM password_reset WHERE token ='". $token . "'";
             
                                        echo '$sql: ' . $sql . '<br/>';

                                        if($con -> query($sql))
                                        { 
                                            $location = "login.php";
                                            echo "<script type='text/JavaScript'>alert('Password reset successfully');window.location='$location'</script>"; 
                                        } 
                                    }
                                    else 
                                    {
                                        echo 'uh-oh' . $stmt->error;
                                    } 
                                }
                            } 

                            //$con -> close();
                        }
                        elseif(!empty($error))
                        {
                            //display error msg 
                           echo "<ul class=‘error’>";
                           foreach ($error as $value)
                           {
                           echo "<li style='color: black;'>$value</li>";
                           echo "</ul>";
                           }

                           echo '<form class="user" action="reset-password.php" method="post" enctype="multipart/form-data">';
                           echo '<br/>';
        
                           echo '<div class="mb-3 form-floating">';
                           echo '    <input type="password" class="form-control txt" id="password" placeholder="New Password" name="password" required="required">';
                           echo '    <label for="password" class="txt">New Password</label>';
                           echo '</div>';
                           echo '<div class="mb-3 form-floating">';
                           echo '    <input type="password" class="form-control txt" id="confirmPassword" placeholder="Confirm New Password" name="confirmPassword" required="required">';
                           echo '    <label for="confirmPassword" class="txt">Confirm New Password</label>';
                           echo '</div>';
                           echo '<input type="hidden" name="csrf_token" value="'.$token.'">';
                           echo '<div class="mb-3">';
                           echo '    <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="submit" name="submit" value="Submit"/>';
                           echo '</div>';
                           echo '</form>';   
                        }
                        }//csrf end  
                        }
                        
                    }
                ?>
                 
 
            </div>
        </div> 
    </div>
     
</body>
</html> 