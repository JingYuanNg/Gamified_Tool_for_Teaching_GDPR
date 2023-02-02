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
    <title>INSHIELD | Upload Profile Picture </title>
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
    if(empty($_SESSION["pName"]))
    {
        $location = "login.php";
        echo "<script type='text/JavaScript'>alert('Please log in to continue');window.location='$location'</script>"; 
    } 
    else 
    {
        $email = $_SESSION["pName"]; 
    }
    ?>
<br/><br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Upload Profile Picture</h1>
             
                <?php  
 
                    if($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        if(empty($_GET['id']))
                        {
                            $location = "playerProfile.php";
                            echo "<script type='text/JavaScript'>alert('Please click on the Upload New Profile Picture Button from Player Profile to continue');window.location='$location'</script>";
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
                                /* echo '<form class="user" action="uploadProfilePic.php" method="post" enctype="multipart/form-data">';
                                echo '<br/>';
             
                                echo '<div class="mb-3">';
                                echo '    <label class="txt">Choose a profile picture:</label>';
                                echo '     <input type="file" class="txt" id="img" name="img" accept="image/*" required="required"/>';
                                echo '</div>'; 
                                echo '<br/>';
                                echo '<div class="mb-3">';
                                echo '    <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="submit" name="submit" value="Submit"/>';
                                echo '</div>';
                                echo '</form>';    */
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

                                /* echo '<form class="user" action="uploadProfilePic.php" method="post" enctype="multipart/form-data">';
                                echo '<br/>';
             
                                echo '<div class="mb-3">';
                                echo '    <label class="txtBox">Choose a profile picture:</label>';
                                echo '     <input type="file" class="txtBox" id="img" name="img" accept="image/*" required="required"/>';
                                echo '</div>'; 
                                echo '<br/>';
                                echo '<div class="mb-3">';
                                echo '    <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="submit" name="submit" value="Submit"/>';
                                echo '</div>';
                                echo '</form>'; */     
                            }
                            

                        }
                    }
                    elseif($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        if(isset($_POST['submit']))
                        { 
                            $files = $_FILES['img']; 

                            //img 
                            $img = file_get_contents($files['tmp_name']); 
                         
                            //hashed_email 
                            $hashed_email = hash('sha3-256', $email, true);
                            //hashed_email_hex
                            $hashed_email_hex = bin2hex($hashed_email);

                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                            $sql = "SELECT * FROM players WHERE email = '$hashed_email_hex'";
                            $result = $con -> query($sql); 
                    
                            if($row = $result -> fetch_object())
                            { 
                              //get playerID 
                              $playerID = $row -> playerID; 
                    
                              //get iv 
                              $iv = hex2bin($row -> iv); 

                              $_SESSION['iv'] = $iv;
                             
                            }
                            $result->free();
                            $con->close();

                            //update statement  
                            
                            $cipher = 'AES-128-CBC';
                            $key = 'thebestsecretkey';

                            $iv = $_SESSION['iv']; 

                            //encryptedImg
                            $encrypted_img = openssl_encrypt($img, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                            //encryptedImg_hex
                            $encrypted_img_hex = bin2hex($encrypted_img);

                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                            $sql = "UPDATE players SET  profilePic = ? WHERE email = ?";
                
                            $stmt = $con -> prepare($sql);  
                
                            $stmt -> bind_param('ss', $encrypted_img_hex, $hashed_email_hex); 
                
                            if($stmt -> execute())
                            {
                                $location = "playerProfile.php"; 
                                echo "<script type='text/javascript'>alert('Successfully update profile picture');window.location='$location'</script>";
                            }
                            else 
                            {
                                echo 'uh-oh' . $stmt->error;
                            }
                            
                        }
                    } 
                ?> 

        <form class="user" action="" method="post" enctype='multipart/form-data'>
        <br/>
             
        <div class="mb-3">
            <label class="txt">Choose a profile picture:</label>
             <input type="file" class="txt" id="img" name="img" accept="image/*" required="required"/>
        </div> 
        <br/>
        <div class="mb-3">
            <input type="submit" class="btn btn-block btn-design font-weight-bold txt" aria-pressed="true" id="submit" name="submit" value="Submit"/>
        </div>
        </form> 
            </div>
        </div> 

        
    </div>
    
</body>
</html> 