<!DOCTYPE html>

<?php
    //session_start(); 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Add Question</title>
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<style>   

    .display-top
    {
        padding-top: 20px;
    }

    .display-inside
    {
        padding-top: 50px;
    }

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

</style>

<body id="page-top">
    <!-- Page Wrapper --> 
    <div id="wrapper">
        <?php 
            include './headerFooterAdmin.php';
            require_once './validation.php'; 
        ?>
        <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-left txt">Add Question</h1> 
                
                <?php 
                    if(isset($_POST["addQuestion"]))
                    {

                        //validation 
                        if(empty($_POST['category']))
                        {
                            $error['category'] = "Please select a <strong>category</strong> !"; 
                        }  
                        if(empty($_POST['answer']))
                        {
                            $error['answer'] = "Please select an <strong>answer</strong> !"; 
                        }

                        if(!empty($error))
                        {
                            //display error msg 
                           echo "<ul class=‘error’>";
                           foreach ($error as $value)
                           {
                           echo "<li style='color: black;'>$value</li>";
                           echo "</ul>";
                           }
                        }
                        elseif(empty($error))
                        {
                            
                            //trim data input
                            $question = trim($_POST['question']); 
                            $category = trim($_POST['category']); 
                            $optionA = trim($_POST['optionA']);
                            $optionB = trim($_POST['optionB']);
                            $optionC = trim($_POST['optionC']);
                            $optionD = trim($_POST['optionD']);
                            $answer = trim($_POST['answer']); 

                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                            $sql = "INSERT INTO questions (questionID, question, category, optionA, optionB, optionC, optionD, answer) values (?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $con -> prepare($sql); 

                            $questionID = NULL; 

                            $stmt -> bind_param('isssssss', $questionID, $question, $category, $optionA, $optionB, $optionC, $optionD, $answer); 

                            $stmt -> execute(); 

                            if($stmt -> affected_rows > 0)
                            {
                                printf('<script>alert("Question added successfully")</script>');
                            }
                            
                            $stmt -> close(); 
                            $con -> close();
                        }
                        
                    }
                ?> 
            
             <form class="user" action="" method="post" enctype='multipart/form-data'>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control txt txt-resize" id="question" name="question" placeholder="Question" autofocus="autofocus" required="required">
                    <label for="question" class="txt txt-resize">Question</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="dropdown-toggle form-control txt txt-resize text-start btn-txt" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="category" name="category">
                    <option value="none" selected disabled hidden>Choose Category</option>
                    <?php 
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        $sql = "SELECT * FROM question_category"; 
                        $result = $con -> query($sql);
                        foreach($result as $row)
                        {
                            echo "<option value=$row[question_categoryID]>$row[question_categoryName]</option>";
                        }
                    ?>
                    </select>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control txt  txt-resize" id="optionA" name="optionA" placeholder="Option 1" required="required">
                    <label for="optionA" class="txt txt-resize">Option A</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control txt  txt-resize" id="optionB" name="optionB" placeholder="Option 2" required="required">
                    <label for="optionB" class="txt txt-resize">Option B</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control txt  txt-resize" id="optionC" name="optionC" placeholder="Option 3" required="required">
                    <label for="optionC" class="txt txt-resize">Option C</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control txt  txt-resize" id="optionD" name="optionD" placeholder="Option 4" required="required">
                    <label for="optionD" class="txt txt-resize">Option D</label>
                </div>
                <div class="mb-3 form-floating">
                    <select class="dropdown-toggle form-control txt txt-resize text-start btn-txt" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="answer" name="answer">
                    <option value="none" selected disabled hidden>Answer</option>
                    <option value="a">Option A</option>
                    <option value="b">Option B</option>
                    <option value="c">Option C</option>
                    <option value="d">Option D</option>
                    </select>
                </div>
                <div class="mb-3"> 
                    <a href="adminQuestions.php" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg" role="button">Back</a> 
                    <button type="submit" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg float-end" aria-pressed="true" id="addQuestion" name="addQuestion">Add</button>
                </div>
             </form> 
            </div> 
        </div> 
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