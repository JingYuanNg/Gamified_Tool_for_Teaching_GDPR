
<?php
    require_once './validation.php';
    session_start();
?> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16"/>
    <title></title> 

    <!--fa-icon-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
        
    <!--Custom font--> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Strait">
        
    <!---Ajax--->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
    <!--CSS-->
    <link href="css/dataTables.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet" type="text/css" />

</head>
<style>     

    html body
    {
        background-color: #FFFDE7; 
    }

    .bg-gradient-primary
    {
        background: #F5F5DC;
    }

    .sidebar-brand-text, .navlink
    {
        color: #000000;
    }

    .sidebar-brand-text
    {
        font-family: "Strait";
    }

    .sidebar-divider
    {
        border: 1px solid #000000;
    } 

    .img-att 
    {
        height: 45px; 
        width: 50px; 
        padding-left: 10px;
    }

    .txt 
    {
        padding-top: 25px;
        font-family: "Strait";
        font-size: 30px;
    }

    .txt-sidebar
    {
        font-family: "Strait";
        font-size: 20px !important;
        color: #000000;
    } 

    .itm-btm 
    {
        padding-left: 5px;
        padding-bottom: 10px;
    }
</style>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion navbar-admin sticky-top" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center nav-link" href="#">
    <div class="sidebar-brand mx-0"><img src="img/icon.png" class="img-att"></div>
    <div class="sidebar-brand-text mx-3 txt">INSHIELD Admin</div>
    </a>
    
    <br/>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!--Navbar Item - dashboard-->
    <li class="nav-item dashboard-active">
        <a class="nav-link" href="#">
        <span class="navlink txt-sidebar">Dashboard</span></a>
    </li>

    <!--Navbar Item - questions -->
    <li class="nav-item">
        <a class="nav-link" href="#">
        <span class="navlink txt-sidebar">Questions</span>
        </a>
    </li>

    <!-- Nav Item - leaderboard -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <span class="navlink txt-sidebar">Leaderboard</span>
        </a>
    </li>

    <!-- Nav Item - players -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <span class="navlink txt-sidebar">Players</span>
        </a>
    </li>

    <!-- Nav Item - Admin Name -->  
    <li class="fixed-bottom itm-btm text-wrap">
        <?php  
            if(isset($_SESSION["aName"]))
            {
                echo '<a href="#" class="nav-link "><span class="navlink txt-sidebar">' . $_SESSION["aName"]. '</span></a>';
            }
            else
            {
                $location = "login.php";
                echo "<script type='text/JavaScript'>alert('Please log in as an admin to continue');window.location='$location'</script>"; 
                //echo '<a href="#" class="nav-link"><span class="navlink txt-sidebar">Login</span></a>';
            } 
        ?> 
    </li> 
</ul>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/adminScripts.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.min.js"></script>