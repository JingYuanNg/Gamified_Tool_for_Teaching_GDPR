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

//email
function validateEmail($email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return "Invalid <strong>email</strong>";
    }
    //check if ady exists in db 
    //establish connection 
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

    $sql = "SELECT email from players";

    $result = $con -> query($sql); 

    while($row = $result -> fetch_object())
    {
        $compareEmail = $row -> email; 

        if(strcmp($compareEmail, $email) == 0)
        {
            return "<strong>Email</strong> already taken";
        }
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
        return "Both password are <strong> not same</strong> !";
    }
}

?>