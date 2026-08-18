<?php
$dir_root = getenv('dir_menager_querys');

require_once $dir_root . 'app/helpers/verifications.php';
require_once $dir_root . 'app/helpers/hash.php';

class adminController{
   public function receiveParamsAddPosition(...$params): array{
      $verify = new Verifications();
      $allParamsBeenReceived = $verify->receivedAllParamsToAddPosition($params[0]);

      if($allParamsBeenReceived == false) return ["success" => false];

      $result = [
         "success" => true,
         "newData" => $params[0]["name"],
         "oldData" => $params[0]["oldData"]
      ];

      return $result;
   }
}
?>
