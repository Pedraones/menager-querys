<?php
$dir_root = getenv("dir_menager_querys");
require_once $dir_root . "/app/helpers/hash.php";
require_once $dir_root . "/app/helpers/structuring-responses.php";
require_once $dir_root . "/app/Models/user-model.php";

class authService{
   public function login($credentials): bool{
      $userModel = new userModel();
      
      $saltUser = $userModel->getSaltUser(["email" => $credentials["email"]]);
      $saltUser = structureResponseGetSalt($saltUser);

      unset($userModel);

      $passwordEncrypt = encrypt([
         "password" => $credentials["password"],
         "salt" => $saltUser
      ]);

      unset($saltUser);
      $credentials["password"] = $passwordEncrypt;

      $userModel = new userModel();
      $userExist = $userModel->getLoginUser($credentials);

      unset($credentials);
      unset($passwordEncrypt);
      unset($userModel);

      if(!$userExist) return false;

      return true;
   }
}
?>
