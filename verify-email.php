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
    <title>INSHIELD | Verify Email</title>
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
       if(!empty($msg))
       {
            echo "<script>alert('$msg')</script>";
       }
    ?>
<br/><br/><br/><br/><br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Verify Email</h1>
                
                <?php 
                    $cipher = 'AES-128-CBC';
                    $key = 'thebestsecretkey';
                    $exist = 0; 

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
                            $_SESSION['token'] = $token;

                            //Establish connection
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                            //SQL statement
                            $stmt = $con->prepare("SELECT * FROM verify_email WHERE token = ?");
                            $stmt->bind_param("s", $token);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if($row = $result->fetch_object())
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
                                    //delete from players 
                                        //Establish connection
                                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                        //SQL statement
                                        $sql="DELETE FROM players WHERE email ='". $email . "'";
             
                                        echo '$sql: ' . $sql . '<br/>';

                                        if($con -> query($sql))
                                        { 
                                            // delete from verify_email so the player can reverify 
                                            //Establish connection
                                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                            //SQL statement
                                            $sql="DELETE FROM verify_email WHERE token ='". $token . "'";
             
                                            echo '$sql: ' . $sql . '<br/>';

                                            if($con -> query($sql))
                                            { 
                                                $location = "home.php";
                                                echo "<script type='text/JavaScript'>alert('Token expired');window.location='$location'</script>";
                                            } 
                                        } 
                                }
                                else //if same 
                                {
                                    //intval() = convert min in time to int 
                                    $now_minutes = intval($now->format('i'));
                                    $timestamp_minutes = intval($timestamp->format('i'));

                                    //abs() = return absolute value (num without sign (-/+))
                                    $diff_minutes = abs($now_minutes - $timestamp_minutes); 

                                    //when over 30 minutes
                                    if($diff_minutes > 30) 
                                    {
                                        //delete from players 
                                        //Establish connection
                                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                        //SQL statement
                                        $sql="DELETE FROM players WHERE email ='". $email . "'";
             
                                        echo '$sql: ' . $sql . '<br/>';

                                        if($con -> query($sql))
                                        { 
                                            // delete from verify_email so the player can reverify 
                                            //Establish connection
                                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                            //SQL statement
                                            $sql="DELETE FROM verify_email WHERE token ='". $token . "'";
             
                                            echo '$sql: ' . $sql . '<br/>';

                                            if($con -> query($sql))
                                            { 
                                                $location = "home.php";
                                                echo "<script type='text/JavaScript'>alert('Token expired');window.location='$location'</script>";
                                            } 
                                        } 

                                        
                                    }
                                    else
                                    {
                                        //delete record from verify_email
                                        //Establish connection
                                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                        //SQL statement
                                        $sql="DELETE FROM verify_email WHERE token ='". $token . "'";
             
                                        echo '$sql: ' . $sql . '<br/>';

                                        if($con -> query($sql))
                                        { 
                                            $location = "login.php";
                                            echo "<script type='text/JavaScript'>alert('Email verified successfully');window.location='$location'</script>"; 
                                        } 
                                    }
                                } 
                            }
                            else 
                            {
                                $location = "home.php";
                                echo "<script type='text/JavaScript'>alert('Invalid token');window.location='$location'</script>";
                            }
                        }
                    }
                     
                ?>
                
                 
            </div>
        </div> 
    </div> 
</body>
</html> 