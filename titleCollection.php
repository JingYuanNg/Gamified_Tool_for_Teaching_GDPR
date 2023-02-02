<!DOCTYPE html>

<?php
    //start session 
    session_start();
    
?> 
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/icon.png" type="image/png" sizes="16x16">
    <title>INSHIELD | Title Collection </title>
    <link href="css/styles.css" rel="stylesheet"/>
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

    .img-size
    {
        width:150px;
        height:150px; 
    }

    .displayName
    {
        text-align:center !important;
    }
</style>

<body>
    <?php 
        
    include './headerFooterClient.php'; 
    require_once './validation.php';  
    if(empty($_SESSION["pName"]))
    {
        $location = "login.php";
        echo "<script type='text/JavaScript'>alert('Please log in to continue');window.location='$location'</script>"; 
    } 
    else 
    {
        $email = $_SESSION["pName"]; 
    }
    ?>
<br/><br/><br/>
    <div class="container mt-5 display-top">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center txt">Title Collection</h1>
             
                <br/>
                <button type="button" class="btn btn-block btn-design font-weight-bold txt" data-toggle="modal" data-target="#myModal">How does Title Collection work?</button>
                
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
    
                      <!-- Modal content-->
                      <div class="modal-content txt">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button> 
                        </div>

                        <div class="modal-body">
                          <p><strong>How to get a title?</strong><br/>
                          Complete each level to get the title specific for that level<br/>
                          </p>

                          <p><strong>How many titles in total?</strong><br/>
                          Nine. Each level has a different title and they are listed as below: <br/>
                          <table>
                            <tr>
                                <td>Level 1 (Beginner)</td>
                                <td>-</td>
                                <td>Private</td>
                            </tr>
                            <tr>
                                <td>Level 2 (Beginner)</td>
                                <td>-</td>
                                <td>Private First Class</td>
                            </tr>
                            <tr>
                                <td>Level 3 (Beginner)</td>
                                <td>-</td>
                                <td>Specialist</td>
                            </tr>
                            <tr>
                                <td>Level 4 (Intermediate)</td>
                                <td>-</td>
                                <td>Corporal</td>
                            </tr>
                            <tr>
                                <td>Level 5 (Intermediate)</td>
                                <td>-</td>
                                <td>Sergeant</td>
                            </tr>
                            <tr>
                                <td>Level 6 (Intermediate)</td>
                                <td>-</td>
                                <td>Staff Sergeant</td>
                            </tr>
                            <tr>
                                <td>Level 7 (Advanced)</td>
                                <td>-</td>
                                <td>Sergeant First Class</td>
                            </tr>
                            <tr>
                                <td>Level 8 (Advanced)</td>
                                <td>-</td>
                                <td>Master Sergeant</td>
                            </tr>
                            <tr>
                                <td>Level 9 (Advanced)</td>
                                <td>-</td>
                                <td>Sergeant Major</td>
                            </tr>
                          </table>
                          
                          </p>

                          <p><strong>Why did the title grey out?</strong><br/>
                          The titles will be greyed out automatically if the level is not played again within 5 days.<br/>
                          Play the level again within 5 days to keep those titles !<br/>
                          </p>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-design" data-dismiss="modal">Close</button>
                        </div>

                      </div> 
                    </div>
                </div>

                <?php  
 
                    function checkTitle($time_lvl_bin, $iv) 
                    {
                        $time_lvl = decrypting($time_lvl_bin, $iv);
                                     
                        if (!isset($time_lvl) || empty($time_lvl) || $time_lvl == "")
                        {
                            $titleVar = 0; 
                        }
                        else 
                        {
                            date_default_timezone_set('Europe/Dublin');
                            $date_now = date('d-F-Y H:i:s');
                            $date1 = new DateTime($time_lvl);
                            $date2 = new DateTime($date_now);  
                            $interval = $date1->diff($date2);
                            if($interval -> days <=5)
                            {
                                $titleVar = 1;
                            }
                            else 
                            {
                                $titleVar = 0;
                            }
                        } 

                        return $titleVar; 
                    }

                    function picSelection($title_lvl, $title_lvl_src_name)
                    {
                        if($title_lvl == 1)
                        {
                            $title_lvl_src = "img/title/" . $title_lvl_src_name . ".png"; 
                        }
                        elseif($title_lvl == 0)
                        {
                            $title_lvl_src = "img/greyOut_title/grey_" . $title_lvl_src_name . ".png";
                        }  
                        return $title_lvl_src;
                    }

                    function titleDisplayName($title_lvl, $title_lvl_name)
                    {
                        if($title_lvl == 1)
                        {
                            $title_displayName = $title_lvl_name; 
                        }
                        elseif($title_lvl == 0)
                        {
                            $title_displayName = "";
                        }  
                        return $title_displayName;
                    }


                    if($_SERVER['REQUEST_METHOD'] == 'GET')
                    {
                        if(empty($_GET['id']))
                        {
                            $location = "playerProfile.php";
                            echo "<script type='text/JavaScript'>alert('Please click on the View Title Collection Button from Player Profile to continue');window.location='$location'</script>";
                        }
                        elseif(!empty($_GET['id']))
                        {
                            //select from player table 
                            //retrieve id from URL
                            $id = trim($_GET['id']);  

                            $error['id'] = validateInteger($id);

                            //Remove null value in $error when there is no error
                            $error = array_filter($error);
        
                            if(empty($error))
                            {
                                //hashed_email 
                                $hashed_email = hash('sha3-256', $email, true);
                                //hashed_email_hex
                                $hashed_email_hex = bin2hex($hashed_email);

                                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                                $sql = "SELECT * FROM players WHERE email = '$hashed_email_hex'";
                                $result = $con -> query($sql); 

                                if($row = $result -> fetch_object())
                                {
                                    //get iv 
                                    $iv = hex2bin($row -> iv);

                                    //time_lvl1 
                                    $time_lvl1_bin = hex2bin($row -> time_lvl1);
                                    $title_lvl1 = checkTitle($time_lvl1_bin, $iv);  
                                    $title_lvl1_src_name = "private";
                                    $title_lvl1_src = picSelection($title_lvl1, $title_lvl1_src_name); 
                                    $title_lvl1_name = "Private"; 
                                    $title_lvl1_displayName = titleDisplayName($title_lvl1, $title_lvl1_name);  

                                    //time_lvl2
                                    $time_lvl2_bin = hex2bin($row -> time_lvl2);
                                    $title_lvl2 = checkTitle($time_lvl2_bin, $iv);
                                    $title_lvl2_src_name = "private_first_class";
                                    $title_lvl2_src = picSelection($title_lvl2, $title_lvl2_src_name); 
                                    $title_lvl2_name = "Private First Class"; 
                                    $title_lvl2_displayName = titleDisplayName($title_lvl2, $title_lvl2_name);  
                                     
                                    //time_lvl3 
                                    $time_lvl3_bin = hex2bin($row -> time_lvl3);
                                    $title_lvl3 = checkTitle($time_lvl3_bin, $iv); 
                                    $title_lvl3_src_name = "specialist";
                                    $title_lvl3_src = picSelection($title_lvl3, $title_lvl3_src_name); 
                                    $title_lvl3_name = "Specialist"; 
                                    $title_lvl3_displayName = titleDisplayName($title_lvl3, $title_lvl3_name);  

                                    //time_lvl4 
                                    $time_lvl4_bin = hex2bin($row -> time_lvl4);
                                    $title_lvl4 = checkTitle($time_lvl4_bin, $iv);  
                                    $title_lvl4_src_name = "corporal";
                                    $title_lvl4_src = picSelection($title_lvl4, $title_lvl4_src_name); 
                                    $title_lvl4_name = "Corporal"; 
                                    $title_lvl4_displayName = titleDisplayName($title_lvl4, $title_lvl4_name);  

                                    //time_lvl5
                                    $time_lvl5_bin = hex2bin($row -> time_lvl5);
                                    $title_lvl5 = checkTitle($time_lvl5_bin, $iv); 
                                    $title_lvl5_src_name = "sergeant";
                                    $title_lvl5_src = picSelection($title_lvl5, $title_lvl5_src_name); 
                                    $title_lvl5_name = "Sergeant"; 
                                    $title_lvl5_displayName = titleDisplayName($title_lvl5, $title_lvl5_name); 

                                    //time_lvl6 
                                    $time_lvl6_bin = hex2bin($row -> time_lvl6);
                                    $title_lvl6 = checkTitle($time_lvl6_bin, $iv);  
                                    $title_lvl6_src_name = "staff_sergeant";
                                    $title_lvl6_src = picSelection($title_lvl6, $title_lvl6_src_name); 
                                    $title_lvl6_name = "Staff Sergeant"; 
                                    $title_lvl6_displayName = titleDisplayName($title_lvl6, $title_lvl6_name);  

                                    //time_lvl7 
                                    $time_lvl7_bin = hex2bin($row -> time_lvl7);
                                    $title_lvl7 = checkTitle($time_lvl7_bin, $iv);  
                                    $title_lvl7_src_name = "sergeant_first_class";
                                    $title_lvl7_src = picSelection($title_lvl7, $title_lvl7_src_name); 
                                    $title_lvl7_name = "Sergeant First Class"; 
                                    $title_lvl7_displayName = titleDisplayName($title_lvl7, $title_lvl7_name);  

                                    //time_lvl8 
                                    $time_lvl8_bin = hex2bin($row -> time_lvl8);
                                    $title_lvl8 = checkTitle($time_lvl8_bin, $iv);  
                                    $title_lvl8_src_name = "master_sergeant";
                                    $title_lvl8_src = picSelection($title_lvl8, $title_lvl8_src_name); 
                                    $title_lvl8_name = "Master Sergeant"; 
                                    $title_lvl8_displayName = titleDisplayName($title_lvl8, $title_lvl8_name);  

                                    //time_lvl9 
                                    $time_lvl9_bin = hex2bin($row -> time_lvl9);
                                    $title_lvl9 = checkTitle($time_lvl9_bin, $iv);  
                                    $title_lvl9_src_name = "sergeant_major";
                                    $title_lvl9_src = picSelection($title_lvl9, $title_lvl9_src_name); 
                                    $title_lvl9_name = "Sergeant Major"; 
                                    $title_lvl9_displayName = titleDisplayName($title_lvl9, $title_lvl9_name);  

                                }
                            }
                            else
                            {
                                //display error msg 
                                echo "<ul class=‘error’>";
                                foreach ($error as $value)
                                {
                                    echo "<li style='color: black;'>$value</li>";
                                    echo "</ul>";
                                } 
                            }
                            

                        }
                    }
                ?> 
                <br/> 
            <div class="container-fluid">
                <div class="row bg-white shadow rounded p-2">
                    <label class="txt text-center font-weight-bold fs-4">Beginner</label>
                    <br/>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl1_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl1_displayName?></label>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl2_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl2_displayName?></label>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl3_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl3_displayName?></label>
                  </div>
                </div>

                <br/><br/>

                <div class="row bg-white shadow rounded p-2">
                    <label class="txt text-center font-weight-bold fs-4">Intermediate</label>
                    <br/>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl4_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl4_displayName?></label>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl5_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl5_displayName?></label>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl6_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl6_displayName?></label>
                  </div>
                </div>

                <br/><br/>

                <div class="row bg-white shadow rounded p-2">
                    <label class="txt text-center font-weight-bold fs-4">Advanced</label>
                    <br/>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl7_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl7_displayName?></label>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl8_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl8_displayName?></label>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?php echo $title_lvl9_src?>" class="img-size"/>
                    <label class="txt fs-5"><?php echo $title_lvl9_displayName?></label>
                  </div>
                </div>
            </div>

            </div>
        </div>
        
         
    </div>
    <br> 
</body>
</html> 