<!DOCTYPE html>

<?php
    //session_start(); 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin Leaderboard</title>
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
 
    .edit-delete-btn
    {
        background-color: white;
        border:none;
    } 
</style>

<body id="page-top">
    <!-- Page Wrapper --> 
    <div id="wrapper">
        <?php 
            include './headerFooterAdmin.php';
            require_once './validation.php'; 
        ?>
        
        <div class="container-fluid ps-5">  
        <h1 class="text-left txt fw-bold">Players</h1> 
                
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/adminScripts.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.min.js"></script> 


        <form action="" method="POST">
        <div class="card shadow mb-4 txt">
            <!------Content Title------->
            <div class="card-header py-3">
                <h6 class="h6 m-0 font-weight-bold">All Players</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table txt" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="product-text fs-6">ID</th>
                                <th class="product-text fs-6">User</th> 
                                <th class="product-text fs-6">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                //Establish connection
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);   
                                //SQL statement
                                $sql = "SELECT * FROM players";

                                    //Getting connection object to process the sql command
                                if($result = $con ->query($sql))
                                { 
                                    //Check got record or not
                                    while($row = $result -> fetch_object())
                                    {
                                        printf('
                                            <tr id="%s">
                                                <td><input type="checkbox" name="checked[]" value="%s" /></td> 
                                                <td class="fs-6">%s</td> 
                                                <td class="fs-6">%s</td> 
                                                <td>
                                                    <a href="adminPlayersDetails.php?id=%d" class="edit-delete-btn fs-6"><i class="fas fa-edit"></i> Edit</a>&nbsp; &nbsp; &nbsp; &nbsp
                                                    <a href="javascript:delete_id(%d)" class="edit-delete-btn remove fs-6"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                </td>
                                            </tr>
                                                 ',$row->playerID, $row->playerID, $row->playerID, $row-> email, $row->playerID, $row->playerID);
                                    }
                                    
                                $result->free();
                                $con->close();
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="d-flex flex-row-reverse">
                        <input class="btn btn-design txt txt-resize h-auto btn-txt btn-lg" role="button" value="Delete Checked" type="submit" id="delete" name="delete" /> 
                    </div>
                </div>
            </div>
        </div>

        

    </form>
        <!-- Leaderboard -->
        <?php 
    
            //select * from players - ID, email, points 
            //decrypt points 
            //store in array according to ID 
            //arsort() - sort array descending according to the value in the array 
            //display top 5  
/* 
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
                $points = openssl_decrypt($points_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv); 

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

                   //add email to the array
                   $rank[$playerID] = array( 
                       'points' => $points,
                       'email' => $email, 
                       'leaderboard_position' => $leaderboard_position
                      );

                  //encrypt_leaderboard_position
                  $encrypted_leaderboard_position = openssl_encrypt($leaderboard_position, $cipher, $key, OPENSSL_RAW_DATA, $iv);
                  //encrypted_leaderboard_position_hex 
                  $encrypted_leaderboard_position_hex = bin2hex($encrypted_leaderboard_position);

                  $con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                  $sql = "UPDATE players SET leaderboard_position = ? WHERE email = ?";
                  $stmt = $con ->prepare($sql);
                  $stmt -> bind_param('ss', $encrypted_leaderboard_position_hex, $email);

                   if($stmt -> execute())
                   {
                       //update successful 
                      /* echo '$email: ' . $email . '<br/>';
                      //echo '$leaderboard_position: ' . $leaderboard_position . '<br/>';
                      //echo '$encrypted_leaderboard_position_hex: ' . $encrypted_leaderboard_position_hex . '<br/><br/>';  
                  }
                 else 
                  {
                      echo 'Uh-oh'. '<br/>'; 
                 } 
                  $leaderboard_position++; 
              } 
          } 

          $con -> close(); */
        ?>

          <!-- <br/>

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
              /* 
                     foreach($rank as $playerID => $values)
                     { 
                             // echo "PlayerID: $playerID, Email: {$values['email']}, Points: {$values['points']}, Leaderboard: {$values['leaderboard_position']}<br/>";
                             //display
                             echo '<tr>';
                            echo '<td class="pt-0 pb-0 ps-2 pe-2"><label for="rank" class="txt fs-6">'.$values['leaderboard_position'].'</label></td>';
                            echo '<td class="pt-0 pb-0 ps-2 pe-2 w-100"><label for="user" class="txt fs-6">'.$values['email'].'</label></td>';
                             echo '<td class="pt-0 pb-0 ps-2 pe-5"><label for="points" class="txt fs-6">'.$values['points'].'</label></td>';
                             echo '</tr>'; 
                    } */
               ?> 
               </tbody>
                
          </table>    -->
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