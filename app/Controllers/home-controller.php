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
}

$t = new homeController();

$r = $t->receiveAllParamsToAddQuery([
   "newDatas" => [
      "name" => "controller home",
      "id_user" => 5,
      "file_query" => "pwvpeovpevṕefl",
      "content" => "",
      "description" => "testando controller",
      "public_view" => "n",
      "referred" => "hdk",
      "code" => 13
   ],
   "oldDatas" => ""
]);

var_dump($r);
?>
