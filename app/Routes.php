<?php
require_once __DIR__ . "/Controllers/admin-controller.php";
require_once __DIR__ . "/Services/admin-service.php";
require_once __DIR__ . "/Models/admin-model.php";

class Routes{
   public function addPosition($params): bool{
      $adminController = new adminController();
      $responseAdminController = $adminController->receiveParamsAddPosition($params);

      if($responseAdminController["success"] == false) return false;

      unset($adminController);

      $splitDatas = [];

      foreach($responseAdminController as $key => $value){
         $splitDatas[$key] = $value;
      }

      $adminService = new adminService();
      $responseAdminService = $adminService->insertPosition($responseAdminController);

      unset($adminService);

      if($responseAdminService == false) return false;
      return true;
   }   

   public function addUser($user): bool{
      $adminController = new adminController();

      $responseAdminController = $adminController->receiveParamsAddUser($user);

      var_dump($responseAdminController);
      echo "<br> <br> <br>";

      if($responseAdminController["success"] == false) return false;
      
      unset($adminController);

      $adminService = new adminService();

      $responseAdminService = $adminService->insertUser($user);
      #var_dump($responseAdminService);
      if($responseAdminService == false) return false;

      unset($user);
      unset($responseAdminService);

      return true;
   }
}
?>
