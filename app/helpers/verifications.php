<?php

class Verifications{
   public function receivedAllParamsToAddPosition(...$params): bool{
      if(gettype($params[0]["name"]) == "string" && $params[0]["name"] != "") return true;

      return false;
   }

   public function receivedAllParamsToAddPosition(...$params): bool{
      if($params[0]["user"] == "") return false;
      if($params[0]["email"] == "") return false;
      if($params[0]["position_interprise"] == "") return false;
      if($params[0]["password"] == "") return false;
      if($params[0]["salt"] == "") return false;
   }
}

?>
