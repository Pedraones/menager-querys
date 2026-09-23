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

   public function receivedAllParamsToAddQuery($values): bool{
      if($values["newDatas"] == NULL ||
         $values["newDatas"] == []) return false;

      $query = $values["newDatas"];
      $quantityFields = count($query);

      if($quantityFields < 8) return false;

      if($query["id_user"] == NULL) return false;

      if($query["name"] == NULL ||
         $query["name"] == "") return false;

      if($query["file_query"] == NULL &&
         $query["content"] == NULL) return false;

      if($query["file_query"] == "" &&
         $query["content"] == "") return false;

      if($query["description"] == NULL ||
         $query["description"] == "") return false;

      if($query["public_view"] > 1 ) return false;

      if(substr_compare($query["referred"], "hdk", 1, 3) == 0 ||
         substr_compare($query["referred"], "esus", 1, 4) == 0) return false;

      if($query["code"] == NULL) return false;

      return true;
   }
}

?>
