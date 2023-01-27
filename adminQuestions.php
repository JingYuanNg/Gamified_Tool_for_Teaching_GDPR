<!DOCTYPE html>

<?php
    //session_start(); 
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Admin - Questions</title>
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
     
    div.dataTables_wrapper div.dataTables_filter label 
    {
        font-size: 1rem;
    } 

    div.dataTables_wrapper div.dataTables_info 
    {
        font-size: 1rem;
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
        <h1 class="text-left txt fw-bold">Questions</h1> 
                
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/adminScripts.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.min.js"></script> 
        <!-- for search box --> 
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

        <script>
            // Initialize the DataTables plugin on the table element  
            // Ensure that the table is initialized after the page finished loading 
            // coz DataTables plugin will not work on table that is not fully rendered 
            $(document).ready(function() 
            {
              //$ - used by jQuery to find html element 
              //# - find an element with a specific id 
              $('#dataTable').DataTable();
            });

            $(document).ready(function() 
            {
                var table = $('#dataTable').DataTable();

                //keyup - to trigger whenever User releases a key from the keyboard
                $('#search-user').on('keyup', function() 
                {
                    //searches the second column (1)
                    //draw() - redraw table with the search results 
                    table.columns(1).search(this.value).draw();
                });
            });
        </script>

        <div class="d-flex flex-row-reverse">
            <a href="adminDashboard.php" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg" role="button">Back</a> 
            <a href="addQuestion.php" class="btn btn-design txt txt-resize h-auto btn-txt btn-lg" style="margin-right: 5px;" role="button">Add Question</a>
        </div>  
        <br/>
        <form action="" method="POST">
        <div class="card shadow mb-4 txt">
            <!------Content Title------->
            <div class="card-header py-3">
                <h6 class="h6 m-0 font-weight-bold">All Questions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table txt container-fluid" id="dataTable" width="100%" cellspacing="0">
                        <thead> 
                            <tr> 
                                <th class="fs-6">ID</th>
                                <th class="fs-6">Question</th> 
                                <th class="fs-6">Update</th>
                                <th class="fs-6">Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                //Establish connection
                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);   
                                //SQL statement
                                $sql = "SELECT * FROM questions";

                                    //Getting connection object to process the sql command
                                if($result = $con ->query($sql))
                                { 
                                    //Check got record or not
                                    while($row = $result -> fetch_object())
                                    {
                                        printf('
                                            <tr id="%s">
                                                <td class="fs-6">%s</td> 
                                                <td class="fs-6">%s</td> 
                                                <td>
                                                    <a href="adminUpdateQuestion.php?id=%d" class="edit-delete-btn fs-6">Update</a> 
                                                </td>
                                                <td>
                                                    <a href="adminDeleteQuestion.php?id=%d" class="edit-delete-btn fs-6" onclick="return confirm(\'Are you sure to delete question with ID %d?\');">Delete</a>
                                                </td>
                                            </tr>
                                                 ', $row->questionID, $row->questionID, $row-> question, $row->questionID, $row->questionID, $row->questionID, $row->questionID);
                                    }
                                    
                                $result->free();
                                $con->close();
                            }
                            ?>
                        </tbody>
                    </table>
 
                </div>
            </div>
        </div>
    </form>
        
    </div>
    </div> 
    <script type="text/javascript">
        $('#dataTable').DataTable(
        {
            ordering: false,
            scrollY: 400,
            paging:false
        });
    </script>
 
</body>
</html> 