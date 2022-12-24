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

    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Quiz</h1>
                
                <?php
                $categoryLimit = 4; 

                $rating1 = 0; 
                $rating2 = 0; 
                $rating3 = 0; 
                $rating4 = 0;

                for($i=1 ; $i<=$categoryLimit; $i++)
                {
                    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
                    $result = mysqli_query($con, "SELECT * FROM questions WHERE category = '$i' ORDER BY RAND() LIMIT 2;");
                    
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
                        /* echo 'questionID from POST :' .$_POST['quesID'][$i]. '<br/>'; 
                        echo 'answer from POST :' .$_POST['answer'][$i]. '<br/>';  */
                        /* if ($_POST['answer'][$i] == $answers[$i]) 
                        {
                          $score++;
                        } */

                     
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
                            
                            /* echo 'questionID from db: ' . $questionID . '<br />'; 
                            echo 'answer: ' . $answer . '<br />';  */
                            
                            if ($_POST['answer'][$i] == $answer) 
                            {
                                $score++;
                                if($category == 1)
                                {
                                    $rating1++; 
                                    echo 'rating1: ' . $rating1 . '<br /><br />'; 
                                }
                                elseif($category == 2)
                                {
                                    $rating2++; 
                                    echo 'rating2: ' . $rating2 . '<br /><br />'; 
                                }
                                elseif($category == 3)
                                {
                                    $rating3++; 
                                    echo 'rating3: ' . $rating3 . '<br /><br />'; 
                                }
                                elseif($category == 4)
                                {
                                    $rating4++; 
                                    echo 'rating4: ' . $rating4 . '<br /><br />'; 
                                }
                            } 

 
                        }
                     }
                     echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded">Score: ' . $score . '</div>';
                     exit;
                    }

                    
                ?>
                  
                    <form method="post">
                    <?php 
                    for ($i = 0; $i < count($questions); $i++) 
                    {
                      /* echo '<p>' . $questions[$i] . '</p>'; */

                      $quesNum = $i + 1; 
                      echo '<div class="shadow p-3 mb-5 bg-body rounded bg-white txt"><div class="p-2 mb-2 bg-body rounded txt-ques">' . $quesNum . '. ' . $questions[$i] . '</div>'; 
                    
                      echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_a_' . $i . '\').checked = true;">
                            <label for="answerRadio_a_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_a_' . $i . '" value="a">
                            ' . $optionA[$i] . '
                            </label>

                            </div><br>';

                       echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_b_' . $i . '\').checked = true;">
                            <label for="answerRadio_b_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_b_' . $i . '" value="b">
                            ' . $optionB[$i] . '
                            </label>
                            
                            </div><br>';

                       echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_c_' . $i . '\').checked = true;">
                            <label for="answerRadio_c_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_c_' . $i . '" value="c">
                            ' . $optionC[$i] . '
                            </label>

                            </div><br>';

                        echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans" onclick="document.getElementById(\'answerRadio_d_' . $i . '\').checked = true;">
                            <label for="answerRadio_d_' . $i . '">
                            <input type="radio" name="answer[' . $i . ']" id="answerRadio_d_' . $i . '" value="d">
                            ' . $optionD[$i] . '
                            </label>

                            </div><br>';

                      /* 
                      echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans"><input type="radio" name="answer[' . $i . ']" value="a">' . $optionA[$i] . '</div><br>';
                      echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans"><input type="radio" name="answer[' . $i . ']" value="b">' . $optionB[$i] . '</div><br>';
                      echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans"><input type="radio" name="answer[' . $i . ']" value="c">' . $optionC[$i] . '</div><br>';
                      echo '<div class="border border-dark shadow p-2 mb-1 bg-body rounded txt-ans"><input type="radio" name="answer[' . $i . ']" value="d">' . $optionD[$i] . '</div><br>'; 
                      */

                      echo '<div><input type="radio" name="quesID[' . $i . ']" value="' . $quesID[$i] . '" checked class="d-none"></div><br>';
                      
                      echo 'Answer(system): ' . $answers[$i] . '<br/>'; 
                      /*echo 'questionID: ' . $quesID[$i] . '<br />';  */
                      echo '</div>';
                    }
                    ?>
                    <input type="submit" class="btn btn-block btn-design font-weight-bold txt mb-5" aria-pressed="true" name="submit" value="Submit">
                    </form>
 
                    
            </div>
        </div> 
    </div>
    <!-- <input type="button" value="Logout" name="logout" class="profile-btn" onclick="location = 'logout.php'; alert('You have successfully been logout!');"/> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script> -->
</body>
</html> 