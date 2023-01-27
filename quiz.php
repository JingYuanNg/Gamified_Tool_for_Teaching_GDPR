<!DOCTYPE html>

<?php
    //start session 
    session_start(); 
    require_once './validation.php';

    if(empty($_SESSION["pName"]))
    {
        $location = "login.php";
        echo "<script type='text/JavaScript'>alert('Please log in to continue');window.location='$location'</script>"; 
    } 
    
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Quiz</title>
    <link href="css/styles.css" rel="stylesheet" />
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

    .txt-ques
    {
        font-size: 20px;
    }

    .txt-ans
    {
        font-size: 15px;
    }
</style>

<body>
    <?php 
        
    include './headerFooterClient.php';  

    ?>
<br/><br/><br/> 
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
            
                <h1 class="text-center txt">Quiz</h1>
                
                <?php
                $categoryLimit = 4; 

                $ranking1 = 0; 
                $ranking2 = 0; 
                $ranking3 = 0; 
                $ranking4 = 0;

                for($i=1 ; $i<=$categoryLimit; $i++)
                {
                    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
                    $result = mysqli_query($con, "SELECT * FROM questions WHERE category = $i ORDER BY RAND() LIMIT 2;");
                    
                    while ($row = mysqli_fetch_assoc($result)) 
                    {                
                        $quesID[] = $row['questionID'];    
                        $questions[] = $row['question'];
                        $optionA[] = $row['optionA'];
                        $optionB[] = $row['optionB'];
                        $optionC[] = $row['optionC'];
                        $optionD[] = $row['optionD'];
                        $answers[] = $row['answer'];
                    
                        
                    }
                    
                    mysqli_free_result($result);
                    mysqli_close($con);
                }
                
                //check player lvl 
                $email = $_SESSION["pName"]; 

                //hashed_email 
                $hashed_email = hash('sha3-256', $email, true);
                //hashed_email_hex
                $hashed_email_hex = bin2hex($hashed_email);

                $cipher = 'AES-128-CBC';
                $key = 'thebestsecretkey';

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                $sql = "SELECT * FROM players WHERE email = '$hashed_email_hex'";
                $result = $con -> query($sql); 

                if($row = $result -> fetch_object())
                {
                    //get playerID 
                    $playerID = $row -> playerID; 

                    //get iv 
                    $iv = hex2bin($row -> iv); 

                    //levels 
                    $levels_bin = hex2bin($row -> levels); 
                    $levels = decrypting($levels_bin, $iv);
                
                    //ranking_category1 
                    $ranking_category1_bin = hex2bin($row -> ranking_category1);   
                    $ranking_category1 = decrypting($ranking_category1_bin, $iv);

                    //ranking_category2
                    $ranking_category2_bin = hex2bin($row -> ranking_category2); 
                    $ranking_category2 = decrypting($ranking_category2_bin, $iv);
                
                    //ranking_category3
                    $ranking_category3_bin = hex2bin($row -> ranking_category3);
                    $ranking_category3 = decrypting($ranking_category3_bin, $iv);

                    //ranking_category4
                    $ranking_category4_bin = hex2bin($row -> ranking_category4);  
                    $ranking_category4 = decrypting($ranking_category4_bin, $iv);
                }

                //get the smallest ranking_category(weakest) 
                $min = min($ranking_category1, $ranking_category2, $ranking_category3, $ranking_category4); 
                
                //to store variables with smallest value 
                $vars = array(); 

                //check which variables have the smallest value 
                if($ranking_category1 == $min)
                {
                    $vars[] = 1; 
                }
                elseif($ranking_category2 == $min)
                {
                    $vars[] = 2;
                }
                elseif($ranking_category3 == $min)
                {
                    $vars[] = 3;
                }
                elseif($ranking_category4 == $min)
                {
                    $vars[] = 4;
                }

                //if there are multiple variables with same value, pick one randomly 
                if(count($vars) > 1)
                {
                    $randomIndex = array_rand($vars); 
                    $weakestCategory = $vars[$randomIndex]; 
                }
                else 
                {
                    $weakestCategory = $vars[0];
                }
                 
                $con -> close(); 
                
                if($levels > 9)//highest lvl is 9 because only have 10 ques per category
                { 
                    $cipher = 'AES-128-CBC';
                    $key = 'thebestsecretkey';

                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                    $sql = "SELECT * FROM players WHERE email = '$hashed_email_hex'";
                    $result = $con -> query($sql); 

                    if($row = $result -> fetch_object())
                    {
 
                       //get playerID 
                       $playerID = $row -> playerID; 

                       //get iv 
                       $iv = hex2bin($row -> iv); 
                       
                    }

                    
                    //level 
                    $levels_reset = 1;  
                    $encrypted_levels_reset_hex = encrypting($levels_reset, $iv);
 
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $sql = "UPDATE players SET levels = ? WHERE email = ?";
                    $stmt = $con -> prepare($sql); 
                    $stmt -> bind_param('ss', $encrypted_levels_reset_hex, $hashed_email_hex);

                    echo 'encryped_levels_hex: ' . $encrypted_levels_reset_hex . '<br/>';
                    if($stmt -> execute())
                    { 
                        echo 'executed'. '<br/>';   
                        $location = "quiz.php";
                        echo "<script type='text/JavaScript'>alert('You have reached the highest level. Restarting level...');window.location='$location'</script>";
                         
                    }
                    else 
                    {
                        echo 'Uh-oh'. '<br/>'; 
                    } 

                    $stmt -> close();
                    $con -> close();
                    exit;

                }
                elseif($levels > 1 && $levels <= 9)
                {
                    $quesNumToTake = $levels - 1;  
                    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
                    $result = mysqli_query($con, "SELECT * FROM questions WHERE category = $weakestCategory ORDER BY RAND() LIMIT $quesNumToTake;"); 
                    
                    while ($row = mysqli_fetch_assoc($result)) 
                    {                
                        $quesID[] = $row['questionID'];    
                        $questions[] = $row['question'];
                        $optionA[] = $row['optionA'];
                        $optionB[] = $row['optionB'];
                        $optionC[] = $row['optionC'];
                        $optionD[] = $row['optionD'];
                        $answers[] = $row['answer'];
                    
                        
                    }
                    
                    mysqli_free_result($result);
                    mysqli_close($con);
                } 
                    // If the form has been submitted, check the answers
                    if (isset($_POST['submit'])) 
                    { 
                      $score = 0;
                      for ($i = 0; $i < count($questions); $i++) 
                      {  
                        if(empty($_POST['answer'][$i]))
                        {
                            $location = "quiz.php";
                            echo "<script type='text/JavaScript'>alert('Please make sure all questions are selected with answer !');window.location='$location'</script>"; 
                        }
                        else
                        {
                            
                            $id = $_POST['quesID'][$i]; 
                        
                            //connect db 
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                            //SQL stat 
                            $sql = "SELECT * from questions WHERE questionID = '$id'"; 

                            $result = $con -> query($sql); 

                            if($row = $result -> fetch_object())
                            {
                                $questionID = $row ->questionID;
                                $answer = $row ->answer; 
                                $category = $row ->category; 
                            
                                if ($_POST['answer'][$i] == $answer) 
                                {
                                    $score++;
                                    if($category == 1)
                                    {
                                        $ranking1++;  
                                    }
                                    elseif($category == 2)
                                    {
                                        $ranking2++;  
                                    }
                                    elseif($category == 3)
                                    {
                                        $ranking3++;  
                                    }
                                    elseif($category == 4)
                                    {
                                        $ranking4++;  
                                    }
                                } 

 
                            }
                        
                        }
                     } 

                     $email = $_SESSION["pName"]; 

                     //hashed_email 
                     $hashed_email = hash('sha3-256', $email, true);
                     //hashed_email_hex
                     $hashed_email_hex = bin2hex($hashed_email);

                     $cipher = 'AES-128-CBC';
                     $key = 'thebestsecretkey';

                     $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                     $sql = "SELECT * FROM players WHERE email = '$hashed_email_hex'";
                     $result = $con -> query($sql); 

                     if($row = $result -> fetch_object())
                     {
 
                        //get playerID 
                        $playerID = $row -> playerID; 

                        //get iv 
                        $iv = hex2bin($row -> iv); 
 
                        //points 
                        $points_bin = hex2bin($row -> points); 
                        $points = decrypting($points_bin, $iv); 
                        $points_new = $points + $score;  
                        $encrypted_points_new_hex = encrypting($points_new, $iv);

                        //time
                        date_default_timezone_set('Europe/Dublin');
                        $date_now = date('d-F-Y H:i');  
                        $encrypted_date_now_hex = encrypting($date_now, $iv);

                        //ranking_category1 
                        $ranking_category1_bin = hex2bin($row -> ranking_category1); 
                        $ranking_category1 = decrypting($ranking_category1_bin, $iv); 
                        $ranking_category1_new = $ranking_category1 + $ranking1;  
                        $encrypted_ranking_category1_new_hex = encrypting($ranking_category1_new, $iv);

                        //ranking_category2
                        $ranking_category2_bin = hex2bin($row -> ranking_category2); 
                        $ranking_category2 = decrypting($ranking_category2_bin, $iv); 
                        $ranking_category2_new = $ranking_category2 + $ranking2; 
                        $encrypted_ranking_category2_new_hex = encrypting($ranking_category2_new, $iv);

                        //ranking_category3
                        $ranking_category3_bin = hex2bin($row -> ranking_category3); 
                        $ranking_category3 = decrypting($ranking_category3_bin, $iv);
                        $ranking_category3_new = $ranking_category3 + $ranking3;  
                        $encrypted_ranking_category3_new_hex = encrypting($ranking_category3_new, $iv);

                        //ranking_category4
                        $ranking_category4_bin = hex2bin($row -> ranking_category4); 
                        $ranking_category4 = decrypting($ranking_category4_bin, $iv); 
                        $ranking_category4_new = $ranking_category4 + $ranking4; 
                        $encrypted_ranking_category4_new_hex = encrypting($ranking_category4_new, $iv);

                        //levels 
                        $addLevel = 1;
                        $levels_bin = hex2bin($row -> levels); 
                        $levels = decrypting($levels_bin, $iv); 
                        $levels_new = $levels + $addLevel;   
                        $encrypted_levels_new_hex = encrypting($levels_new, $iv);
                     }

                     $con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                     $sql = "UPDATE players SET points = ?, ranking_category1 = ?, ranking_category2 = ?, ranking_category3 = ?, ranking_category4 = ? , levels = ? WHERE email = ?";
                     $stmt = $con ->prepare($sql);
                     $stmt -> bind_param('sssssss', $encrypted_points_new_hex, 
                                                     $encrypted_ranking_category1_new_hex,
                                                     $encrypted_ranking_category2_new_hex,
                                                     $encrypted_ranking_category3_new_hex,
                                                     $encrypted_ranking_category4_new_hex,
                                                     $encrypted_levels_new_hex,
                                                     $hashed_email_hex);

                    if($stmt -> execute())
                    {
                        //update successful 
                        echo '<div class="txt text-center fs-3 fw-semibold p-3">Congratulations !</div>';
                        echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded">Score: ' . $score . '</div>';
                        echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded">Points: ' . $points_new . '</div>';
                    }
                    else 
                    {
                        echo 'Uh-oh'. '<br/>'; 
                    } 

                    $stmt -> close();
                    $con -> close();
                    exit;
                     
                    }

                    
                ?>
                  
                    <div class="txt text-center fs-3 fw-semibold p-3">Level <?php echo $levels ?></div>
                    <form method="post">
                    <?php 
                    for ($i = 0; $i < count($questions); $i++) 
                    {
                      /* echo '<p>' . $questions[$i] . '</p>'; */

                      $quesNum = $i + 1; 
                      echo '<div class="shadow p-3 mb-5 bg-body rounded bg-white txt"><div class="p-2 mb-2 bg-body rounded txt-ques">' . $quesNum . '. ' . $questions[$i] . '</div>'; 
                    
                      echo '<div class="border border-dark shadow p-1 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_a_' . $i . '\').checked = true;">
                            <label for="answerRadio_a_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_a_' . $i . '" value="a">
                            ' . $optionA[$i] . '
                            </label>

                            </div><br>';

                       echo '<div class="border border-dark shadow p-1 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_b_' . $i . '\').checked = true;">
                            <label for="answerRadio_b_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_b_' . $i . '" value="b">
                            ' . $optionB[$i] . '
                            </label>
                            
                            </div><br>';

                       echo '<div class="border border-dark shadow p-1 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_c_' . $i . '\').checked = true;">
                            <label for="answerRadio_c_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_c_' . $i . '" value="c">
                            ' . $optionC[$i] . '
                            </label>

                            </div><br>';

                        echo '<div class="border border-dark shadow p-1 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_d_' . $i . '\').checked = true;">
                            <label for="answerRadio_d_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_d_' . $i . '" value="d">
                            ' . $optionD[$i] . '
                            </label>

                            </div>';
 

                      echo '<div><input type="radio" name="quesID[' . $i . ']" value="' . $quesID[$i] . '" checked class="d-none"></div>';
                      
                    //echo 'Answer(system): ' . $answers[$i] . '<br/>'; 
                      /*echo 'questionID: ' . $quesID[$i] . '<br />';  */
                      echo '</div>';
                    }
                    ?>
                    <input type="submit" class="btn btn-block btn-design font-weight-bold txt mb-5" aria-pressed="true" name="submit" value="Submit">
                    </form>
 
                    
            </div>
        </div> 
    </div> 
</body>
</html> 