<!DOCTYPE html>
 <?php
 require_once 'vendor/autoload.php';

$google2fa = new \PragmaRX\Google2FA\Google2FA();
$secret_key = $google2fa->generateSecretKey();
// Now store the key in your database

$google2fa = new \PragmaRX\Google2FA\Google2FA();
      
$text = $google2fa->getQRCodeUrl(
 'Inshield',
 $username,
 $secret_key
);
    
$image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$text;
echo '<img src="'.$image_url.'" />';

$google2fa = new \PragmaRX\Google2FA\Google2FA();
if ($google2fa->verifyKey($secret_key, $user_provided_code)) 
{
// Code is valid
} 
else 
{
 // Code is NOT valid
}
?>
 