<!DOCTYPE html> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Dashboard</title>
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>    
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

    .players-link:hover, .questions-link:hover, .noDeco-txt:hover 
    {
        text-decoration: none;
    } 

    .txt-aft-tb
    {
        color:blue !important;
    }

    tfoot th 
    {
    text-align: center;
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
            else 
            {
                $email = $_SESSION["aName"]; 
            }
        ?>
        <div class="container-fluid">
        <div class="row ps-3">
            <div class="">
                <h1 class="text-left txt fw-bold">Dashboard</h1> 
                
                <div class="d-flex flex-row gap-3">

                    <!-- Total players --> 
                    <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <a href="adminPlayers.php" class="players-link">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                         <div class="col-box fs-6 fw-semibold text-dark text-uppercase mb-1">Total Players</div>
                                         <div class="h5 mb-0 fw-semibold text-gray-800">
                                            <?php
                                                //Establish connection
                                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                                //SQL statement
                                                $sql="SELECT COUNT(*) as total FROM players";
                                                    
                                                $result=mysqli_query($con,$sql);
                                                    
                                                $data=mysqli_fetch_assoc($result);
                                                    
                                                echo $data['total'];
                                                    
                                                //Close connection
                                                $con -> close();
                                            ?>
                                         </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>

                    <!-- Total questions --> 
                    <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <a href="adminQuestions.php" class="questions-link">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                         <div class="col-box fs-6 fw-semibold text-dark text-uppercase mb-1">Total Questions</div>
                                         <div class="h5 mb-0 fw-semibold text-gray-800">
                                            <?php
                                                //Establish connection
                                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                                //SQL statement
                                                $sql="SELECT COUNT(*) as total FROM questions";
                                                    
                                                $result=mysqli_query($con,$sql);
                                                    
                                                $data=mysqli_fetch_assoc($result);
                                                    
                                                echo $data['total'];
                                                    
                                                //Close connection
                                                $con -> close();
                                            ?>
                                         </div>
                                    </div>
                                </div>
 
                    </div>
                    </div>
                </div>

            
            </div> 
        </div> 
        </div>

        <!-- Leaderboard -->
        <?php 
    
            //select * from players - ID, email, points 
            //decrypt points 
            //store in array according to ID 
            //arsort() - sort array descending according to the value in the array 
            //display top 5  

            $cipher = 'AES-128-CBC';
            $key = 'thebestsecretkey';

            //connect db 
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

            //SQL statement players
            $sql = "SELECT * from players"; 

            //get result from sql 
            $result = $con -> query($sql); 

            $playerID_i = 0; 
            //get data from both side 
            while($row = $result -> fetch_object())
            {
                //id 
                $playerID = $row -> playerID;

                //iv 
                $iv = hex2bin($row -> iv); 

                //email 
                $email = $row -> email;

                //points  
                $points_bin = hex2bin($row -> points); 
                //$points = openssl_decrypt($points_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
                $points = decrypting($points_bin, $iv);

                //store into array 
                $rank[$playerID] = $points; 
            }

           //arsort() - sort array descending according to the value in the array
           arsort($rank); 

           $leaderboard_position = 1; 

          foreach ($rank as $playerID => $points) 
          {  
              $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
              $sql = "SELECT * FROM players WHERE playerID = '$playerID'";
              $result = $con -> query($sql); 

              if($row = $result -> fetch_object())
              {
                  $email = $row -> email;

                  $iv = hex2bin($row -> iv);

                  //displayName 
                  $displayName_bin = hex2bin($row -> displayName);  
                  $displayName = decrypting($displayName_bin, $iv);
                   
                  //add email to the array
                   $rank[$playerID] = array( 
                       'points' => $points,
                       'displayName' => $displayName, 
                       'leaderboard_position' => $leaderboard_position
                      ); 

                  $encrypted_displayName_hex = encrypting($displayName, $iv);
 
                  $encrypted_leaderboard_position_hex = encrypting($leaderboard_position, $iv);

                  $con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                  $sql = "UPDATE players SET leaderboard_position = ? WHERE displayName = ?";
                  $stmt = $con ->prepare($sql);
                  $stmt -> bind_param('ss', $encrypted_leaderboard_position_hex, $encrypted_displayName_hex);

                   if($stmt -> execute())
                   {
                       //update successful 
                      /* echo '$email: ' . $email . '<br/>';
                      echo '$leaderboard_position: ' . $leaderboard_position . '<br/>';
                      echo '$encrypted_leaderboard_position_hex: ' . $encrypted_leaderboard_position_hex . '<br/><br/>'; */
                  }
                 else 
                  {
                      echo 'Uh-oh'. '<br/>'; 
                 } 
                  $leaderboard_position++; 
              } 
          } 

          $con -> close();
        ?>

        <a href="adminLeaderboard.php" class="noDeco-txt">
        <div class="container-fluid">  
         <h2 class="text-left txt">Leaderboard</h2> 
           <table class="bg-white rounded shadow table-bordered table-responsive-sm table">
            <thead>
                 <tr>
                     <th class="pt-0 pb-0 ps-2 pe-2"><label for="rank" class="txt fs-6">Rank</label></th>
                     <th class="pt-0 pb-0 ps-2 pe-2 w-100"><label for="user" class="txt fs-6">User</label></th>
                     <th class="pt-0 pb-0 ps-2 pe-5"><label for="points" class="txt fs-6">Points</label></th>
                 </tr>
            </thead>
            <tbody>
              <?php 
                   $counter = 0;
     
                     foreach($rank as $playerID => $values)
                     {
                         if($counter < 3)
                      {
                             // echo "PlayerID: $playerID, Email: {$values['email']}, Points: {$values['points']}, Leaderboard: {$values['leaderboard_position']}<br/>";
                             //display
                             echo '<tr>';
                            echo '<td class="pt-0 pb-0 ps-2 pe-2"><label for="rank" class="txt fs-6">'.$values['leaderboard_position'].'</label></td>';
                            echo '<td class="pt-0 pb-0 ps-2 pe-2 w-100"><label for="user" class="txt fs-6">'.$values['displayName'].'</label></td>';
                             echo '<td class="pt-0 pb-0 ps-2 pe-5"><label for="points" class="txt fs-6">'.$values['points'].'</label></td>';
                             echo '</tr>';
                             $counter++;
                         }
                         else
                         {
                           break;
                         }
                    }
               ?> 
               </tbody>
               <tfoot>
                 <tr>
                    <th colspan="3">
                    <a href="adminLeaderboard.php" class="txt fs-6 fw-semibold txt-aft-tb">View the whole leaderboard</a>
                    </th> 
                 </tr>
               </tfoot>
          </table>  
        </div>
        </a>
    </div>  
</body>
</html> 