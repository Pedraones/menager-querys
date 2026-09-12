<?php
$dir_root = getenv('dir_menager_querys');

require_once $dir_root . "/app/Routes.php";

$fileUploaded = is_uploaded_file($_FILES["file_query"]["tmp_name"]);
if($fileUploaded == true){
   $temp_name = $_FILES["file_query"]["tmp_name"];
   $name = $_FILES["file_query"]["name"];

   move_uploaded_file($temp_name, $dir_root . "/app/temp/" . $name);

   $file_content = file_get_contents("$dir_root/app/temp/$name", false);
   
   $_POST["file_query"] = $file_content;

   unset($file_content);
   unlink($dir_root . "app/temp/" . $name);
}

if($_POST["action"] == "addQuery"){
   $route = new Routes();

   $_POST["id_user"] = 1;
   $_POST["id_position_interprise_user"] = 4;
   unset($_POST["action"]);

   $values = [
      "newDatas" => $_POST,
      "oldDatas" => ""
   ];
   $route->addQuery($values);
    
   unset($values);
   unset($route);

   header("Location: ./home-page.html");
}
?>
