<?php
require_once __DIR__ . "/Controllers/admin-controller.php";
require_once __DIR__ . "/Controllers/home-controller.php";
require_once __DIR__ . "/Services/admin-service.php";
require_once __DIR__ . "/Services/home-service.php";

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

      if($responseAdminController["success"] == false) return false;
      
      unset($adminController);

      $adminService = new adminService();

      $responseAdminService = $adminService->insertUser($user);
      
      if($responseAdminService == false) return false;

      unset($user);
      unset($responseAdminService);

      return true;
   }

   public function addQuery($query): bool{
      $homeController = new homeController();

      $responseHomeController = $homeController->receiveAllParamsToAddQuery($query);

      if($responseHomeController == false) return false;

      unset($homeController);

      $homeService = new homeService();

      $responseHomeService = $homeService->insertQuery($query);

      if($responseHomeService == false) return false;

      unset($responseHomeService);
      unset($homeService);

      return true;
   }
}

?>
