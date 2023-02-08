<!DOCTYPE html> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Display Verify Email</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<head>
  <script>
    document.addEventListener("DOMContentLoaded", function() 
    {
      document.getElementById("myform").submit();
    });
  </script>
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

</style>

<body>
    <?php  
    require_once './headerFooterClient.php'; 
    if (!isset($_SESSION['csrf_token'])) 
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    $csrf_token = $_SESSION['csrf_token'];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token'])
        { 
            die('CSRF attack detected!');
        }
    }

    ?>
<br/><br/><br/><br/><br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Verify Email</h1>
                <form id="csrf_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                </form>
                <form> 
                    <div><label class="txt text-center">Please verify your email before you log in. You have 30 minutes to verify the email.</label></div> 
                </form>  
                <div class="mb-3">
                    <a class="btn btn-block btn-design font-weight-bold txt" href="login.php">I have verified</a>
                </div>  

            </div>
        </div> 
    </div> 
</body>
</html> 