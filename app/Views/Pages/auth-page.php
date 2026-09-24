<?php
$dir_root = getenv("dir_menager_querys");
require_once $dir_root . "/app/Routes.php";

$routes = new Routes();

$credentials = [
   "email" => $_POST["email"],
   "password" => $_POST["password"]
];
$success = $routes->login($credentials);
if(!$success) header("Location: ./auth-page.html");
else header("Location: ./view-home-page.php");
?>
