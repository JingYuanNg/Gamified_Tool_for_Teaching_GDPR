<!DOCTYPE html> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Questions</title>
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<head>
<script> 
      document.getElementById("csrf_form").submit(); 
</script>
</head>
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
    elseif($_SERVER['REQUEST_METHOD'] == 'GET')
    { 
        if(empty($_GET['id']))
        {
            $location = "adminQuestions.php";
            echo "<script type='text/JavaScript'>alert('Please select a question to continue');window.location='$location'</script>"; 
        }
        elseif(!empty($_GET['id']))
        {
            //retrieve questionID from URL 
            $questionID = trim($_GET['id']); 

            //Establish connection
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            //SQL statement with placeholder
            $sql = "DELETE FROM questions WHERE questionID = ?";

            //Prepare statement
            $stmt = $con->prepare($sql);

            //Bind questionID to the statement
            $stmt->bind_param("i", $questionID);

            //Execute statement
            if($stmt->execute())
            {
                $location = "adminQuestions.php";
                echo "<script type='text/JavaScript'>alert('Question with ID " . $questionID . " is deleted');window.location='$location'</script>";
            }
             
            $con -> close();
        }
    }
?>
<body>
    <form id="csrf_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
    </form>
</body>
</html> 