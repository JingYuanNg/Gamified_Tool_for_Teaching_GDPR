<!DOCTYPE html> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Points I have</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<head>
<script> 
      document.getElementById("csrf_form").submit(); 
</script>
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
 
    .points_large
    {
        font-size: 65px;
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

    a:hover 
    {
        text-decoration: none !important;
    }

    .img-size
    {
        width:230px;
        height:300px;
    }

    .pp-size
    {
        width:250px;
        height:250px;
    }
</style>

<body>
    <?php 
        
    require_once './headerFooterClient.php'; 

    /* if(empty($_SESSION["pName"]) || empty($_SESSION['aftLoggedIn']))
    {
        $location = "login.php";
        echo "<script type='text/JavaScript'>alert('Please log in to continue');window.location='$location'</script>"; 
        exit();
    } */

    // Generate a unique token for the user session
    if (!isset($_SESSION['csrf_token'])) 
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    $csrf_token = $_SESSION['csrf_token'];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token'])
        { 
            die('CSRF attack detected!');
        }
    }
    else 
    {

     
    }
    ?>
<br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="container-fluid text-center pt-3">
                    <label class="text-center txt">I challenge you to beat me</label>
                </div>
                <h1 class="text-center txt">Points I have</h1>
                
                <form id="csrf_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                </form>

                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        if(empty($_GET['points']))
                        {
                            $location = "playerProfile.php";
                            echo "<script type='text/JavaScript'>alert('Join Inshield now to see the points I have');window.location='$location'</script>";
                        }
                        elseif(!empty($_GET['points']))
                        { 
                            //retrieve points from URL
                            $points = trim($_GET['points']);   

                            $error['points'] = validateInteger($points);

                            //Remove null value in $error when there is no error
                            $error = array_filter($error);
        
                            if(empty($error))
                            { 
                                $_SESSION['points'] = $points;
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
                            }
                        }
                    }

                ?> 
                <div class="container-fluid text-center pt-3">
                    <label class="points_large"><?php echo $_SESSION['points']?></label>
                </div>
                </div> 
            </div>
        </div> 
    </div>
     
    
</body>
</html> 