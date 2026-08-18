<?php

$dir_root = getenv('dir_menager_querys');
require_once $dir_root . "app/helpers/ensure-idempotence.php";
require_once $dir_root . "app/Models/admin-model.php";

class adminService{
   public function insertPosition($params): bool{
      if(ensureIdempotence($params) == true) return false;
         
      $adminModel = new adminModel();

      $position = $params["name"];
      $existPosition = $adminModel->getPosition($position);

      if($existPosition == true) return false;

      $adminModel->addPosition($position);
      
      return true;
   }
}

?>
