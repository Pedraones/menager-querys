<?php

class Verifications{
   public function receivedAllParamsToAddPosition(...$params){
      if(gettype($params[0]["name"]) == "string" && $params[0]["name"] != "") echo "true";

      echo "false";
   }
}

$teste = new Verifications();
$teste->receivedAllParamsToAddPosition([
   "name" => "1"
]);
?>
