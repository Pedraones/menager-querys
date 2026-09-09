<?php
$dir_root = getenv("dir_menager_querys");

require_once $dir_root . "/app/helpers/verifications.php";
require_once $dir_root . "/app/helpers/hash.php";
require_once $dir_root . "/app/helpers/ensure-idempotence.php";
require_once $dir_root . "/app/Models/home-model.php";

class homeService{
   public function insertQuery($query): bool{
      $secret = encrypt($query["newDatas"]);
      $valuesToIdentifyIdempotence = [
         "newDatas" => $secret,
         "oldDatas" => $query["oldDatas"]
      ];
      
      $isIdempotence = ensureIdempotence($valuesToIdentifyIdempotence);

      if($isIdempotence == true) return false;

      unset($isIdempotence);
      unset($valuesToIdentifyIdempotence);

      $query = $query["newDatas"];
      
      $homeModel = new homeModel();

      $idPositionInterpriseUser = $homeModel->getIdPositionInterpriseUser($query["id_user"]);

      $query["id_position_interprise"] = $idPositionInterpriseUser;
      
      $currentTimeZone = new DateTimeZone("America/Sao_Paulo");
      $thisMoment = new DateTime("now", $currentTimeZone);

      $query["createdAt"] = $thisMoment->format("Y-m-d H:i:s");

      if($query["referred"] == "HDK") {
         $query["code_referred_HDK"] == $query["code"];

         unset($query["referred"]);
         unset($query["code"]);
      }
      else {
         $query["code_referred_ESUS"] = $query["code"];

         unset($query["referred"]);
         unset($query["code"]);
      }

      $homeModel->addQuery($query);

      unset($homeModel);
      unset($query);
      unset($idPositionInterpriseUser);

      return true;
   } 
}
?>
