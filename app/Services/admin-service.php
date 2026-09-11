<?php

$dir_root = getenv('dir_menager_querys');
require_once $dir_root . "app/helpers/ensure-idempotence.php";
require_once $dir_root . "app/helpers/hash.php";
require_once $dir_root . "app/Models/admin-model.php";

class adminService{
   public function insertPosition($params): bool{
      if(ensureIdempotence($params) == true) return false;
         
      $adminModel = new adminModel();

      $position = $params["newDatas"];
      $existPosition = $adminModel->getPosition($position);

      if($existPosition == true) return false;

      $adminModel->addPosition($position);
      
      return true;
   }

   public function insertUser($params){
      $secret = encrypt($params["newDatas"]);
      
      $valuesToIdentifieIdempotence = [
         "newDatas" => $secret,
         "oldDatas" => $params["oldDatas"]
      ];

      $isIdempotence = ensureIdempotence($valuesToIdentifieIdempotence);

      if($isIdempotence == true) return false;

      unset($valuesToIdentifieIdempotence);

      $adminModel = new adminModel();

      $existUser = $adminModel->getUser($params["newDatas"]);

      if($existUser == true) return false;

      $textPasswordToEncrypt = [
         "password" => $params["newDatas"]["password"],
         "salt" => $params["newDatas"]["salt"]
      ];

      $params["newDatas"]["id_position_interprise"] = $adminModel->getPosition($params["newDatas"]["id_position_interprise"]);      
      $params["newDatas"]["password"] = encrypt($textPasswordToEncrypt);

      $adminModel->addUser($params["newDatas"]);

      unset($params);
      unset($textPasswordToEncrypt);
      unset($adminModel);

      return true;
   }
}
?>
