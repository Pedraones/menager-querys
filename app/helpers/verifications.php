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

      echo "1";

      $query = $values["newDatas"];
      $quantityFields = count($query);

      if($quantityFields < 8) return false;

      echo "2";

      if($query["id_user"] == NULL) return false;

      echo "3";

      if($query["name"] == NULL ||
         $query["name"] == "") return false;

      echo "4";

      if($query["file_query"] == NULL &&
         $query["content"] == NULL) return false;

      echo "5";

      if($query["file_query"] == "" &&
         $query["content"] == "") return false;

      echo "6";

      if($query["description"] == NULL ||
         $query["description"] == "") return false;

      echo "7";

      if($query["public_view"] > 1 ) return false;

      echo "8";

      echo $query["referred"];

      if(substr_compare($query["referred"], "hdk", 1, 3) == 0 ||
         substr_compare($query["referred"], "esus", 1, 4) == 0) return false;

      echo "9";

      if($query["code"] == NULL) return false;

      echo "10";

      return true;
   }
}

?>
