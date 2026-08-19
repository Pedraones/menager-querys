<?php
$dir_root = getenv("dir_menager_querys");

require_once $dir_root . "app/Routes.php";

if($_POST["action"] == "addPosition"){
   $route = new Routes();

   $values = $_POST;
   $route->addPosition($values);
   unset($values);
   unset($route);

   header("Location: ./admin-page.html");
}
?>
