<!DOCTYPE html>

<?php
    //session_start(); 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Update Question</title>
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
            if(empty($_SESSION["aName"]))
            {
                $location = "login.php";
                echo "<script type='text/JavaScript'>alert('Please log in as admin to continue');window.location='$location'</script>"; 
            } 
        ?>
        
        <div class="container-fluid ps-5">
            <h1 class="text-left txt">Edit Question</h1> 
            <?php
            //retrieve from db 
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
                    $sql = "SELECT * FROM questions WHERE questionID = ?";

                    //Prepare statement
                    $stmt = $con->prepare($sql);

                    //Bind questionID to the statement
                    $stmt->bind_param("i", $questionID);

                    //Execute statement
                    $stmt->execute();

                    //Store result
                    $result = $stmt->get_result();

                    if($row = $result -> fetch_object())
                    { 
                        //questionID
                        $questionID = $row -> questionID;

                        //question
                        $question = $row -> question;
                        
                        //category 
                        $category = $row -> category;
                        
                        //optionA
                        $optionA = $row -> optionA;
                        
                        //optionB
                        $optionB = $row -> optionB;
                        
                        //optionC
                        $optionC = $row -> optionC;
                        
                        //optionD
                        $optionD = $row -> optionD;
                        
                        //answer
                        $answer = $row -> answer;
                        
                    }

                    //Close connection
                    $result -> free();
                    $con -> close();
                }
            } 
            elseif($_SERVER['REQUEST_METHOD'] == 'POST')
            { 
                //POST method for updating question form
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
                    $questionID = trim($_POST['questionID']);
                    $question = trim($_POST['question']); 
                    $category = trim($_POST['category']); 
                    $optionA = trim($_POST['optionA']);
                    $optionB = trim($_POST['optionB']);
                    $optionC = trim($_POST['optionC']);
                    $optionD = trim($_POST['optionD']);
                    $answer = trim($_POST['answer']); 

                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

                    //SQL statement
                    $sql = "UPDATE questions SET question = '$question', category = '$category', optionA = '$optionA', optionB = '$optionB', optionC = '$optionC', optionD = '$optionD', answer = '$answer' WHERE questionID = '$questionID'"; 
                    
                    // if($stmt -> execute())
                    if($con -> query($sql) === TRUE)
                    { 
                        $location = "adminQuestions.php";
                        echo "<script type='text/JavaScript'>alert('Question updated successfully');window.location='$location'</script>"; 
                    }
                    else 
                    {
                        echo 'uh-oh' . $stmt->error;
                    }
                    
                    $con -> close();
                }
            }
                
            ?>
                
            <div class="d-flex flex-row-reverse">
                <a href="adminQuestions.php" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg" role="button">Back</a> 
            </div>
            <?php  
            
            ?> 

            <br/>
                <div class="shadow ps-3 pe-3 pt-3 pb-5 bg-body rounded bg-white txt">
                 <form class="user" action="adminUpdateQuestion.php" method="post" enctype='multipart/form-data'>
                    <!-- questionID --> 
                    <div class="mb-3">
                    <label for="questionID" class="txt fs-5 fs-5">Question ID</label>
                    <input type="text" class="form-control fs-5" id="questionID" name="questionID" value="<?php echo $questionID ?>" disabled/>
                    <input type="text" class="form-control fs-5" id="questionID" name="questionID" value="<?php echo $questionID ?>" hidden/>
                    </div>

                    <!-- question --> 
                    <div class="mb-3">
                    <label for="question" class="txt fs-5 fs-5">Question</label>
                    <input type="text" class="form-control fs-5" id="question" name="question" value="<?php echo $question ?>" required="required"/>
                    </div>
                     
                    <!-- category -->
                    <div class="mb-3">
                    <label for="questionID" class="txt fs-5">Category</label>
                    <select class="dropdown-toggle form-control txt txt-resize text-start btn-txt" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="category" name="category">
                        <option value="none" disabled hidden>Choose Category</option>
                        <?php 
                          $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                          $sql = "SELECT * FROM question_category"; 
                          $result = $con -> query($sql);
                          foreach($result as $row)
                          {
                            $selected = ($row['question_categoryID'] == $category) ? 'selected' : '';
                            echo "<option value=$row[question_categoryID] $selected>$row[question_categoryName]</option>";
                          }
                        ?>
                    </select> 
                    </div>
                    
                    <!-- optionA --> 
                    <div class="mb-3">
                    <label for="optionA" class="txt fs-5">Option A</label>
                    <input type="text" class="form-control fs-5" id="optionA" name="optionA" value="<?php echo $optionA ?>" required="required"/>
                    </div>
                    
                    <!-- optionB -->  
                    <div class="mb-3">
                    <label for="optionB" class="txt fs-5">Option B</label>
                    <input type="text" class="form-control fs-5" id="optionB" name="optionB" value="<?php echo $optionB ?>" required="required"/>
                    </div>
                    
                    <!-- optionC -->  
                    <div class="mb-3">
                    <label for="optionC" class="txt fs-5">Option C</label>
                    <input type="text" class="form-control fs-5" id="optionC" name="optionC" value="<?php echo $optionC ?>" required="required"/>
                    </div>
                    
                    <!-- optionD -->  
                    <div class="mb-3">
                    <label for="optionD" class="txt fs-5">Option D</label>
                    <input type="text" class="form-control fs-5" id="optionD" name="optionD" value="<?php echo $optionD ?>" required="required"/>
                    </div>
                    
                    <!-- answer --> 
                    <div class="mb-3">
                    <label for="answer" class="txt fs-5">Answer</label>
                    <select class="dropdown-toggle form-control txt txt-resize text-start btn-txt fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="answer" name="answer">
                        <option value="a" <?php if ($answer == 'a') echo 'selected'; ?>>Option A</option>
                        <option value="b" <?php if ($answer == 'b') echo 'selected'; ?>>Option B</option>
                        <option value="c" <?php if ($answer == 'c') echo 'selected'; ?>>Option C</option>
                        <option value="d" <?php if ($answer == 'd') echo 'selected'; ?>>Option D</option>
                    </select>

                    <br/>
                    <button type="submit" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg float-end" aria-pressed="true" id="update" name="update">Update</button>
                        
                    </div>
                    
                </form>
                 </div>
                 <br/>  
        </div>
    </div>
 
</body>
</html> 