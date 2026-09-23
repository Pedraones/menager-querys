<?php

$dir_root = getenv("dir_menager_querys");

require_once $dir_root . "app/helpers/verifications.php";

class homeController{
   public function receiveAllParamsToAddQuery($query): array{
      $verifications = new Verifications();

      $receivedAllFields = $verifications->receivedAllParamsToAddQuery($query);
      if($receivedAllFields == false) return ["success" => false];

      unset($verifications);
      unset($receivedAllFields);

      $result = [
         "success" => true,
         "newDatas" => $query["newDatas"],
         "oldDatas" => $query["oldDatas"]
      ];
      return $result;
   } 

   public function receiveAllParamsToViewQuerys($positionInterprise): array{
      if(gettype($positionInterprise) != integer) $positionInterprise = null;

      $result = [
         "success" => true,
         "data" => $positionInterprise
      ];

      return $result;
   }
}

?>
