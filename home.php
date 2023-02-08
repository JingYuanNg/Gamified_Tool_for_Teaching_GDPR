<!DOCTYPE html>

<?php 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Home</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
 
<style>   

    .display-top
    {
        padding-top: 80px;
    }

    .display-inside
    {
        padding-top: 50px;
    }

    .txt
    {
        font-family: "Strait";
    }
 
    .btn-design
    { 
        border-color: #000000 !important;
        background-color: #F5F5DC !important;
        width:50% !important;
    }

    .div-att 
    {
        background-color: #F5F5DC;
    }
</style>

<body>
    <?php 
        require_once './headerFooterClient.php';  
    ?>

<br/><br/><br/><br/>
    <div class="container mt-5 display-top div-att border shadow rounded w-75">
        <div class="row">
            <div class="col-md-12">
                <img style="width: 500px;" class="img-fluid mx-auto d-block" src="img/logo.png">
            </div>
        </div>  
        <div class="row display-inside">
            <div class="col-md-12">
                <h1 class="text-center txt">Gamified Tool for Teaching GDPR</h1> 
            </div>
        </div> 
        <div class="row display-inside">
            <div class="col-md-12"> 
                <a href="quiz.php" class="btn btn-block btn-design position-absolute top-100 start-50 translate-middle mt-1 font-weight-bold txt" role="button"  aria-pressed="true">Start Quiz</a>
            </div>
        </div>

        
    </div>    
     
</body>
</html> 