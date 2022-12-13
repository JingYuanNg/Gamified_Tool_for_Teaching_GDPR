
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

    /* .logo
    {
        height : 100px;
    }

    .navbar-inverse
    {
        background: #F5F5DC;
    }

    .nav li a
    {
        font-family: "Strait";
        color: black;
        font-size: 20px; 
        padding: 13px 0;
        margin-right: 80px;
    }

    .nav li a:hover
    {
        cursor: pointer;
        border-bottom: 2px solid #365194;
        padding-bottom: 11px;
        color: #365194;    
    }

    .nav-box
    {
        margin-top: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
        margin-bottom: 0px
    }
             
    .navbar
    {
        margin-top:0px;
    }  */

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
        padding-left: 10px;
        padding-bottom: 10px;
    }
</style>

  
        <!-- <nav role="navigation" class="navbar navbar-expand-lg navbar-inverse fixed-top">

            <div class="container nav-box">
                <a class="navbar-brand js-scroll-trigger" href="home.php"><img src="img/logo.png" class="logo"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars ml-1"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item home-active"><a class="nav-link js-scroll-trigger" href="#">Quiz</a></li>
                        <li class="nav-item product-active"><a class="nav-link js-scroll-trigger" href="#">Leaderboard</a></li>    
                        <li class="nav-item"> 
                        <?php  
                            /* if(isset($_SESSION["pName"]))
                            {
                                echo '<a href="#" class="nav-link js-scroll-trigger signin"><span><i class="fa fa-user" aria-hidden="true"></i> Hello, ' . $_SESSION["pName"]. '</span></a>';
                            }
                            else
                            {
                                echo '<a href="login.php" class="nav-link js-scroll-trigger signin"><span><i class="fa fa-user" aria-hidden="true"></i> Login </span></a>';
                            } */ 
                        ?> </li>
                    </ul>
                </div>
            </div>      
        </nav>  -->
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion navbar-admin" id="accordionSidebar">

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
    <li class="fixed-bottom itm-btm">
        <?php  
            if(isset($_SESSION["pName"]))
            {
                echo '<a href="#" class="nav-link"><span class="navlink txt-sidebar"> Hello, ' . $_SESSION["pName"]. '</span></a>';
            }
            else
            {
                $location = "login.php";
                //echo "<script type='text/JavaScript'>alert('Please log in as an admin to continue');window.location='$location'</script>"; 
               //echo '<a href="login.php" class="nav-link"><span class="navlink txt-sidebar">Login </span></a>';
            } 
        ?> 
    </li> 
</ul>
<!-- End of Sidebar -->
<!-- 
<!-- Content Wrapper 
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content  
    <div id="content">
        <!-- Topbar 
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">       
            
            <!-- Topbar Navbar  
            <ul class="navbar-nav ml-auto">
                
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information 
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline small header-name" style="color: #03045e;">
                            <?php 
                                if(isset($_SESSION['name']))
                                {
                                    echo "Hello, " . $_SESSION['name'];
                                }
                                else
                                {
                                    echo 'Clothable';
                                }
                                
                            ?>&nbsp;
                        </span>
                    </a>
                    
                    <!-- Dropdown - User Information  
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        
<!--logout model 
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
</div> -->
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/adminScripts.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.min.js"></script>