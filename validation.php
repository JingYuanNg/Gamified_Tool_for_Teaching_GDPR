<?php 
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'inshield');

$host = 'localhost';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password);

$sql = 'CREATE DATABASE IF NOT EXISTS inshield;';
if (!$conn->query($sql) === TRUE) 
{
  die('Error creating database: ' . $conn->error);
}

$sql = 'USE inshield;';
if (!$conn->query($sql) === TRUE) {
  die('Error using database: ' . $conn->error);
}

/*admin*/ 
$sql = 'CREATE TABLE IF NOT EXISTS admin (
    adminID int NOT NULL AUTO_INCREMENT,
    email varchar(256) NOT NULL,
    password varchar(256) NOT NULL,
    iv varchar(32) NOT NULL,
    PRIMARY KEY (adminID)
  );';
if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}

/*players*/
$sql = 'CREATE TABLE IF NOT EXISTS players (
    playerID int NOT NULL AUTO_INCREMENT,
    iv varchar(32) NOT NULL,
    email varchar(256) NOT NULL,
    password varchar(256) NOT NULL,
    points varchar(256) NOT NULL,
    leaderboard_position int(11) NOT NULL,
    streak varchar(256) NOT NULL,
    last_login_time varchar(256) NOT NULL,
    badge varchar(256) NOT NULL,
    ranking_category1 varchar(256) NOT NULL,
    ranking_category2 varchar(256) NOT NULL,
    ranking_category3 varchar(256) NOT NULL,
    ranking_category4 varchar(256) NOT NULL,
    PRIMARY KEY (playerID)
  );';
if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
} 

/*questions*/
$sql = 'CREATE TABLE IF NOT EXISTS questions (
    questionID int NOT NULL AUTO_INCREMENT,
    category varchar(256) NOT NULL,
    optionA varchar(256) NOT NULL,
    optionB varchar(256) NOT NULL,
    optionC varchar(256) NOT NULL,
    optionD varchar(256) NOT NULL,
    answer varchar(256) NOT NULL,
    PRIMARY KEY (questionID)
  );';
if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}

/*
//username 
function validateUsername($username)
{
    //check if ady exists in db  
    
    //Establish connection
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    $sql = "SELECT username from citizens"; 
    
    $result = $con -> query($sql); 
    
    while($row = $result -> fetch_object())
    {
        $compareUsername = $row -> username; 
        
        if(strcmp($compareUsername, $username) == 0)
        {
            return "<strong>Username</strong> already taken";
        }
    }
}

//password 
function validatePassword($password, $confirmPassword)
{
    //check if both are the same 
    if($password != $confirmPassword)
    {
        return "Both password are <strong> not same</strong> !";
    }
}

//fullName 
function validateFullName($fullName)
{
    //check to make sure only alpha, space and dot 
    if(!preg_match("/^[a-zA-Z ]+$/",$fullName))
    {
        return "<strong>Full name</strong> should only contain alphabet, space and dot."; 
    }
}

//address
function validateAddress($address)
{
    
}

//dateOfBirth
function validateDateOfBirth($dateOfBirth)
{
}

//phoneNumber
function validatephoneNumber($phoneNumber)
{
    //check to make sure only 10 dig with 0 at first 
    if(!preg_match("/^[0][0-9]{9}+$/",$phoneNumber))
    {
        return "<strong>Phone Number</strong> should only contain 10 digit with 0 as the first digit"; 
    } 
}

//img 

//closeContactFullName
function validateCloseContactFullName($closeContactFullName)
{
    if(empty($closeContactFullName))
    {
        return 'Please enter "-" for <strong>Close Contact Full Name</strong> if you do not have close contact with anyone';
    }
    //check to make sure only alpha, space
    else if(!preg_match("/^[a-zA-Z ]+$/",$closeContactFullName) && $closeContactFullName != '-')
    {
        return "<strong>Close Contact Full Name</strong> should only contain alphabet and space"; 
    } 
}


//closeContactPhoneNumber
function validateCloseContactPhoneNumber($closeContactPhoneNumber)
{
    if(empty($closeContactPhoneNumber))
    {
        return 'Please enter "-" for <strong>Close Contact Phone Number</strong> if you do not have close contact with anyone';
    }
    //check to make sure only 10 dig with 0 at first  
    else if(!preg_match("/^[0][0-9]{9}+$/",$closeContactPhoneNumber) && $closeContactPhoneNumber != '-')
    {
        return "<strong>Close Contact Phone Number</strong> should only contain 10 digit with 0 as the first digit"; 
    } 
}

*/ 
?>