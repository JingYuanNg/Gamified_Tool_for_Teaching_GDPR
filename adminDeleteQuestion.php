<?php 
    require_once './validation.php'; 
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

             //SQL statement
             $sql="DELETE FROM questions WHERE questionID ='". $questionID . "'";
                        
             if($con -> query($sql))
                 {
                    $location = "adminQuestions.php";
                    echo "<script type='text/JavaScript'>alert('Question with ID " . $questionID . " is deleted');window.location='$location'</script>";
                 }
             
             $con -> close();
        }
    }
?>