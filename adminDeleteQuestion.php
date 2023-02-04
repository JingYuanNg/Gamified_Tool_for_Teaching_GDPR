<?php 
    require_once './headerFooterAdmin.php'; 
    if(empty($_SESSION["aName"]) || empty($_SESSION['aftLoggedIn']))
    {
        $location = "login.php";
        echo "<script type='text/JavaScript'>alert('Please log in as an admin to continue');window.location='$location'</script>"; 
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'GET')
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