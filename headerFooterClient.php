
<?php
if (!isset($_SESSION)) 
{
    session_start();
}
require_once './validation.php';
?> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16"/>
    <title></title> 
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

</head>
<style>     

    html body
    {
        background-color: #FFFDE7; 
    }

    .logo
    {
        height : 100px;
    }

    .navbar-inverse
    {
        background: #F5F5DC;
    }

    .nav li a
    {
        font-family: "Strait";
        color: black;
        font-size: 20px; 
        padding: 13px 0;
        margin-right: 80px;
    }

    .nav li a:hover
    {
        cursor: pointer;
        border-bottom: 2px solid #365194;
        padding-bottom: 11px;
        color: #365194;    
    }

    .nav-box
    {
        margin-top: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
        margin-bottom: 0px
    }
             
    .navbar
    {
        margin-top:0px;
    } 

    .icon-size
    {
        width: 25px;
        height:25px;
    }
            
</style>

  
        <nav role="navigation" class="navbar navbar-expand-lg navbar-inverse fixed-top">

            <div class="container nav-box">
                <a class="navbar-brand js-scroll-trigger" href="home.php"><img src="img/logo.png" class="logo"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars ml-1"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item home-active"><a class="nav-link js-scroll-trigger" href="quiz.php">Quiz</a></li>
                        <li class="nav-item product-active"><a class="nav-link js-scroll-trigger" href="leaderboard.php">Leaderboard</a></li>    
                        <li class="nav-item"> 
                        <?php  
                            if(isset($_SESSION["pName"]))
                            { 
                                $email = $_SESSION["pName"];
 
                                //hashed_email 
                                $hashed_email = hash('sha3-256', $email, true);
                                //hashed_email_hex
                                $hashed_email_hex = bin2hex($hashed_email);
                                
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                $query = "SELECT COUNT(profilePic) as count FROM players WHERE email = '$hashed_email_hex'";
            
                                $result = mysqli_query($con, $query);
            
                                $row = mysqli_fetch_assoc($result);
            
                                if ($row['count'] > 0) 
                                {
                                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                                    $sql = "SELECT * FROM players WHERE email ='$hashed_email_hex'";
                
                                    $result = $con -> query($sql); 
                
                                    if($row = $result -> fetch_object())
                                    {
                                        $iv = hex2bin($row -> iv); 
                                        
                                        //img 
                                        $img_bin = hex2bin($row -> profilePic); 
                                        $img = decrypting($img_bin, $iv);  
         
                                        $_SESSION['img'] = $img; 
                                        $display_img = '<img class="icon-size rounded-circle" src="data:image/jpeg;base64,'.base64_encode( $_SESSION['img'] ).'" />';
                                        
                                    }

                                }
                                else 
                                { 
                                  $display_img = '<img class="icon-size rounded-circle" src="img/defaultProfilePic.png"/>';  
                                }
                                echo '<a href="playerProfile.php" class="nav-link js-scroll-trigger signin"><span> '. $display_img . ' ' . $_SESSION["pName"]. '</span></a>';
                                
                            }
                            else
                            {
                                echo '<a href="login.php" class="nav-link js-scroll-trigger signin"><span><i class="fa fa-user" aria-hidden="true"></i> Login </span></a>';
                            } 
                        ?></li>
                    </ul>
                </div>
            </div>      
        </nav>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>