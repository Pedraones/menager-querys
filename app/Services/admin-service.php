<?php
$dir_root = getenv('dir_menager_querys');
require_once $dir_root . "app/helpers/ensure-idempotence.php";
require_once $dir_root . "app/helpers/hash.php";
require_once $dir_root . "app/Models/position-interprise-model.php";
require_once $dir_root . "app/Models/user-model.php";

class adminService{
   public function insertPosition($params): bool{
      if(ensureIdempotence($params) == true) return false;
         
      $positionInterpriseModel = new positionInterpriseModel();

      $position = $params["newDatas"];
      $existPosition = $positionInterpriseModel->getPosition($position);

      if($existPosition != 0) return false;

      $positionInterpriseModel->addPosition($position);

      unset($positionInterpriseModel);
      unset($existPosition);

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

      $userModel = new userModel();

      $existUser = $userModel->getUser($params["newDatas"]);

      if($existUser == true) return false;

      $textPasswordToEncrypt = [
         "password" => $params["newDatas"]["password"],
         "salt" => $params["newDatas"]["salt"]
      ];

      $positionInterpriseModel = new positionInterpriseModel();

      $params["newDatas"]["id_position_interprise"] = $positionInterpriseModel->getPosition($params["newDatas"]["id_position_interprise"]);      
      $params["newDatas"]["password"] = encrypt($textPasswordToEncrypt);

      $userModel->addUser($params["newDatas"]);

      unset($params);
      unset($textPasswordToEncrypt);
      unset($userModel);

      return true;
   }
}
?>
