<?php
$dir_root = getenv("dir_menager_querys");
require_once $dir_root . "/app/helpers/hash.php";
require_once $dir_root . "/app/Routes.php";

$routes = new Routes();

$credentials = [
   "email" => $_POST["email"],
   "password" => $_POST["password"]
];
$success = $routes->login($credentials);
if(!$success) header("Location: ./auth-page.html");
else{
   $salt = "" . time();
   $credentials["salt"] = $salt;
   $loginEcrypted = encrypt($credentials);
   
   #setcookie("login", $loginEcrypted, time()+36000);

   #header("Location: ./view-home-page.php");
}
?>