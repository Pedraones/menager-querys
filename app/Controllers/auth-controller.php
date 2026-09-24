<?php
$dir_root = getenv("dir_menager_querys");
require_once $dir_root . "/app/helpers/verifications.php";

class authController{
   public function receivedParamsToLogin($credentials): array{
      $verify = new Verifications();
      $allParamsBeenReceived = $verify->receivedAllParamsToLogin($credentials);

      if(!$allParamsBeenReceived) return ["success" => false];

      unset($verify);
      unset($allParamsBeenReceived);

      return ["success" => true];
   }
}
?>
