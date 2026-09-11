<?php
$dir_root = getenv("dir_menager_querys");

require_once $dir_root . "app/Routes.php";

if($_POST["action"] == "addPosition"){
   $route = new Routes();

   $values = [
      "newDatas" => $_POST,
      "oldDatas" => ""
   ];
   $route->addPosition($values);
   unset($values);
   unset($route);

   header("Location: ./admin-page.html");
}

if($_POST["action"] == "addUser"){
   $route = new Routes();

   $values = [
      "newDatas" => $_POST,
      "oldDatas" => ""
   ];
   $route->addUser($values);

   unset($values); 
   unset($route);
   unset($_POST);

   header("Location: ./admin-page.html");
}
?>
