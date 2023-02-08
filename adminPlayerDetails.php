<!DOCTYPE html> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Player Details</title>
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
 
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
        
        <div class="container-fluid ps-5"> 
            <?php 

            if($_SERVER['REQUEST_METHOD'] == 'GET')
            { 
                if(empty($_GET['id']))
                {
                    $location = "adminPlayers.php";
                    echo "<script type='text/JavaScript'>alert('Please select a player to continue');window.location='$location'</script>"; 
                }
                elseif(!empty($_GET['id']))
                {
                    //retrieve playerID from URL 
                    $playerID = trim($_GET['id']); 

                    $error['id'] = validateInteger($playerID);

                    //Remove null value in $error when there is no error
                    $error = array_filter($error);

                    if(empty($error))
                    {
                    
                        //Establish connection
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                        //SQL statement with placeholder
                        $sql = "SELECT * FROM players WHERE playerID = ?";

                        //Prepare statement
                        $stmt = $con->prepare($sql);

                        //Bind playerID to the statement
                        $stmt->bind_param("i", $playerID);

                        //Execute statement
                        $stmt->execute();

                        //Store result
                        $result = $stmt->get_result();

                        if($row = $result -> fetch_object())
                        {
                            //playerID 
                            $playerID = $row -> playerID;

                            //iv 
                            $iv = hex2bin($row -> iv); 

                            //email
                            $email = $row -> email;

                            //displayName 
                            $displayName_bin = hex2bin($row -> displayName);  
                            $displayName = decrypting($displayName_bin, $iv);

                            //points
                            $points_bin = hex2bin($row -> points);  
                            $points = decrypting($points_bin, $iv); 

                            //leaderboard_position
                            $leaderboard_position_bin = hex2bin($row -> leaderboard_position);  
                            $leaderboard_position = decrypting($leaderboard_position_bin, $iv);

                            //streak
                            $streak_bin = hex2bin($row -> streak);  
                            $streak = decrypting($streak_bin , $iv);

                            //last_login_time
                            $last_login_time_bin = hex2bin($row -> last_login_time);  
                            $last_login_time = decrypting($last_login_time_bin , $iv);

                            //latest_login_time
                            $latest_login_time_bin = hex2bin($row -> latest_login_time);  
                            $latest_login_time = decrypting($latest_login_time_bin , $iv);

                            //badge
                            $badge_bin = hex2bin($row -> badge);  
                            $badge = decrypting($badge_bin , $iv);

                            //ranking_category1
                            $ranking_category1_bin = hex2bin($row -> ranking_category1);  
                            $ranking_category1 = decrypting($ranking_category1_bin , $iv);

                            //ranking_category2
                            $ranking_category2_bin = hex2bin($row -> ranking_category2);  
                            $ranking_category2 = decrypting($ranking_category2_bin , $iv);

                            //ranking_category3
                            $ranking_category3_bin = hex2bin($row -> ranking_category3);  
                            $ranking_category3 = decrypting($ranking_category3_bin , $iv);

                            //ranking_category4
                            $ranking_category4_bin = hex2bin($row -> ranking_category4);  
                            $ranking_category4 = decrypting($ranking_category4_bin , $iv);

                            //levels
                            $levels_bin = hex2bin($row -> levels);  
                            $levels = decrypting($levels_bin , $iv);

                            echo '
                            <h1 class="text-left txt fw-bold">'. $displayName .'</h1> 
                            <div class="d-flex flex-row-reverse">
                                <a href="adminPlayers.php" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg" role="button">Back</a> 
                            </div>  

                            <form class="container-fluid" action="" method="post" enctype='."'multipart/form-data'".'>
            
                                <table class="container-fluid"> 
                                    <tr>
                                        <td style="width: 30%;font-size:23px;"></td>
                                    </tr>
 
                                    <tr>
                                        <td><label for="points" class="txt fs-5">Points</label></td>
                                        <td style="height:100px;"><input type="text" class="form-control" id="points" value="'. $points .'" disabled/></td>
                                    </tr>
 
                                    <tr>
                                        <td><label for="leaderboard_position" class="txt fs-5">Leaderboard Position</label></td>
                                        <td style="height:100px;"><input type="text" class="form-control" id="leaderboard_position" value="'. $leaderboard_position .'" disabled/></td>
                                    </tr>
 
                                    <tr>
                                        <td><label for="streak" class="txt fs-5">Streak</label></td>
                                        <td style="height:100px;"><input type="text" class="form-control" id="streak" value="'. $streak .'" disabled/></td>
                                    </tr>
 
                                    <tr>
                                        <td><label for="last_login_time" class="txt fs-5">Last Login Time</label></td>
                                        <td style="height:100px;"><input type="text" class="form-control" id="last_login_time" value="'. $last_login_time .'" disabled/></td>
                                    </tr>
 
                                    <tr>
                                        <td><label for="latest_login_time" class="txt fs-5">Latest Login Time</label></td>
                                        <td style="height:100px;"><input type="text" class="form-control" id="latest_login_time" value="'. $latest_login_time .'" disabled/></td>
                                    </tr>
 
                                    <tr>
                                        <td><label for="badge" class="txt fs-5">Badge</label></td>
                                        <td class="text-center" style="height:100px;">
                                        <div class="shadow p-3 mb-5 bg-body rounded bg-white">
                                            <img src="';
                                                    if($points < 90)
                                                    { 
                                                        echo 'img/sad.png';
                                                    }
                                                    elseif($points >= 90 && $points <= 100) 
                                                    {
                                                        //bronze 
                                                        echo "img/BadgeBronze.png";
                                                        $badgeVar = "Bronze";
                                                    } 
                                                    elseif($points >= 100 & $points<= 199)
                                                    {
                                                        //silver 
                                                        echo "img/BadgeSilver.png";
                                                        $badgeVar = "Silver";
                                                    } 
                                                    elseif($points >= 200) 
                                                    {
                                                        //gold  
                                                        echo "img/BadgeGold.png"; 
                                                        $badgeVar = "Gold"; 
                                                    }
                                                    echo '" 
                                                    class="img-size p-3"/><br/> 
                                                    <label for="badge" class="txt fs-5">';
                                                     if ($badge == 0) 
                                                     {
                                                        echo "No Badge";
                                                     } 
                                                     else 
                                                     {
                                                        echo $badgeVar;
                                                     }
                                                    echo 
                                                    '</label>
                                                    </div>
                                                </td>
                                            </tr>
                                             
                                            <tr>
                                                <td><label for="ranking_category1" class="txt fs-5">Ranking Category 1</label></td>
                                                <td style="height:100px;"><input type="text" class="form-control" id="ranking_category1" value="'.$ranking_category1.'" disabled/></td>
                                            </tr>
 
                                            <tr>
                                                <td><label for="ranking_category2" class="txt fs-5">Ranking Category 2</label></td>
                                                <td style="height:100px;"><input type="text" class="form-control" id="ranking_category2" value="'.$ranking_category2.'" disabled/></td>
                                            </tr>
 
                                            <tr>
                                                <td><label for="ranking_category3" class="txt fs-5">Ranking Category 3</label></td>
                                                <td style="height:100px;"><input type="text" class="form-control" id="ranking_category3" value="'.$ranking_category3.'" disabled/></td>
                                            </tr>
 
                                            <tr>
                                                <td><label for="ranking_category4" class="txt fs-5">Ranking Category 4</label></td>
                                                <td style="height:100px;"><input type="text" class="form-control" id="ranking_category4" value="'.$ranking_category4.'" disabled/></td>
                                            </tr> 

                                            <tr>
                                                <td><label for="levels" class="txt fs-5">Levels</label></td>
                                                <td style="height:100px;"><input type="text" class="form-control" id="levels" value="'.$levels.'" disabled/></td>
                                            </tr>
                                        </table> 
                                    </form>'; 


                        }
                    } 
                    else
                    {
                        //display error msg 
                        echo "<ul class=‘error’>";
                        foreach ($error as $value)
                        {
                            echo "<li>$value</li>";
                            echo "</ul>";
                        }
                    }
                }
                
            } 

            ?>  
</body>
</html> 