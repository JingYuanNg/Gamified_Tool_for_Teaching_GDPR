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

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

/*admin 
$sql = 'CREATE TABLE IF NOT EXISTS admin (
    adminID int NOT NULL AUTO_INCREMENT,
    iv varchar(32) NOT NULL,
    email varchar(256) NOT NULL,
    password varchar(256) NOT NULL,
    google2FA_secretKey varchar(256) NULL,
    PRIMARY KEY (adminID)
  );';
if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
} 

/*players 
$sql = 'CREATE TABLE IF NOT EXISTS players (
    playerID int NOT NULL AUTO_INCREMENT,
    iv varchar(32) NOT NULL,
    email varchar(256) NOT NULL,
    displayEmail varchar(256) NOT NULL,
    displayName varchar(256) NOT NULL,
    password varchar(256) NOT NULL,
    points varchar(256) NOT NULL,
    leaderboard_position varchar(256) NOT NULL,
    streak varchar(256) NOT NULL,
    last_login_time varchar(256) NOT NULL,
    latest_login_time varchar(256) NOT NULL, 
    badge varchar(256) NOT NULL,
    ranking_category1 varchar(256) NOT NULL,
    ranking_category2 varchar(256) NOT NULL,
    ranking_category3 varchar(256) NOT NULL,
    ranking_category4 varchar(256) NOT NULL,
    levels varchar(256) NOT NULL,
    google2FA_secretKey varchar(256) NULL,
    profilePic MEDIUMTEXT NULL,
    time_lvl1 varchar(256) NULL,
    time_lvl2 varchar(256) NULL,
    time_lvl3 varchar(256) NULL,
    time_lvl4 varchar(256) NULL,
    time_lvl5 varchar(256) NULL,
    time_lvl6 varchar(256) NULL,
    time_lvl7 varchar(256) NULL,
    time_lvl8 varchar(256) NULL,
    time_lvl9 varchar(256) NULL,
    PRIMARY KEY (playerID)
  );';
if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
} 

/*questions 
$sql = 'CREATE TABLE IF NOT EXISTS questions (
    questionID int NOT NULL AUTO_INCREMENT,
    question varchar(256) NOT NULL,
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

/*question_category 
$sql = 'CREATE TABLE IF NOT EXISTS question_category (
  question_categoryID int NOT NULL AUTO_INCREMENT,
  question_categoryName varchar(256) NOT NULL,
  PRIMARY KEY (question_categoryID)
);';
if (!$conn->query($sql) === TRUE) {
die('Error creating table: ' . $conn->error);
}

/* password_reset  
$sql = 'CREATE TABLE IF NOT EXISTS password_reset (
  eventID int NOT NULL AUTO_INCREMENT,
  iv varchar(256) NOT NULL,
  email varchar(256) NOT NULL,
  token varchar(256) NOT NULL,
  timestamp varchar(256) NOT NULL,
  PRIMARY KEY (eventID)
);';
if (!$conn->query($sql) === TRUE) {
die('Error creating table: ' . $conn->error);
}

/* verify_email  
$sql = 'CREATE TABLE IF NOT EXISTS verify_email (
  eventID int NOT NULL AUTO_INCREMENT,
  iv varchar(256) NOT NULL,
  email varchar(256) NOT NULL,
  token varchar(256) NOT NULL,
  timestamp varchar(256) NOT NULL,
  PRIMARY KEY (eventID)
);';
if (!$conn->query($sql) === TRUE) {
die('Error creating table: ' . $conn->error);
} */

//email
function validateEmail($email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return "Invalid <strong>email</strong>";
    }
    //check if ady exists in db 
    //establish connection 
    
    //check existence 
    $exist = 0; 
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

    $sql = "SELECT email from players";

    $result = $con -> query($sql); 

    while($row = $result -> fetch_object())
    {
        $exist = 1; 
        $compareEmail = $row -> email; 

        //hashed_email 
        $hashed_email = hash('sha3-256', $email, true);
        //hashed_email_hex
        $hashed_email_hex = bin2hex($hashed_email);

        if(strcmp($compareEmail, $hashed_email_hex) == 0)
        {
            return "<strong>Email</strong> already taken";
        }
    }
  
}

//email
function validateEmailFormat($email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return "Invalid <strong>email</strong>";
    }
     
}

//int 
function validateInteger($inputInt)
{
  if(!filter_var($inputInt, FILTER_VALIDATE_INT))
  {
    return "Invalid <strong>ID</strong>";
  } 
}

//string 
function validateString($inputString)
{
  if(!is_string($inputString))
  {
    return "Invalid <strong>string</strong>";
  }
} 

//password 
function validatePassword($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) 
    {
        return "<strong>Password</strong> should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }
}

//confirmPassword 
function validateConfirmPassword($password, $confirmPassword)
{
    //check if both are the same 
    if($password != $confirmPassword)
    {
        return "Both password are <strong> not same</strong>";
    }
} 

//encrypting 
function encrypting($valToEncrypt, $iv)
{
  $cipher = 'AES-128-CBC';
  $key = 'thebestsecretkey'; 

  //encrypted_valToEncrypt
  $encrypted_valToEncrypt = openssl_encrypt($valToEncrypt, $cipher, $key, OPENSSL_RAW_DATA, $iv); 
  //encrypted_valToEncrypt_hex 
  $encrypted_valToEncrypt_hex = bin2hex($encrypted_valToEncrypt); 

  return $encrypted_valToEncrypt_hex; 
}

//decrypting 
function decrypting($val_bin, $iv)
{
  $cipher = 'AES-128-CBC';
  $key = 'thebestsecretkey';
 
  $decryptedVal = openssl_decrypt($val_bin, $cipher, $key, OPENSSL_RAW_DATA, $iv);

  return $decryptedVal;
} 
?>