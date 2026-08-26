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
      
      if($values["name"] == NULL ||
         $values["name"] == "") return false;

      if($values["email"] == NULL ||
         $values["email"] == "") return false;

      if($values["id_position_interprise"] == NULL ||
         $values["id_position_interprise"] == "") return false;

      if($values["password"] == NULL ||
         $values["password"] == "") return false;

      if($values["salt"] != NULL &&
         $values["salt"] == "") return false;

      return true;
   }
}

?>
