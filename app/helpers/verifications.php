<?php

class Verifications{
   public function receivedAllParamsToAddPosition(...$params): bool{
      if(gettype($params[0]["name"]) == "string" && $params[0]["name"] != "") return true;

      return false;
   }

   public function receivedAllParamsToAddUser(...$params): bool{
      if($params[0]["newDatas"] == NULL ||
         $params[0]["newDatas"] == []) return false;

      $values = $params[0]["newDatas"];

      if($values[0]["user"] == NULL ||
         $values[0]["user"] == "") return false;

      if($values[0]["email"] == NULL ||
         $values[0]["email"] == "") return false;

      if($values[0]["position_interprise"] == NULL ||
         $values[0]["position_interprise"] == "") return false;

      if($values[0]["password"] == NULL ||
         $values[0]["password"] == "") return false;

      if($values[0]["salt"] != NULL &&
         $values[0]["salt"] == "") return false;

      return true;
   }
}

?>
