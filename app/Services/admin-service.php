<?php

class adminService{
   public static $quantity_same_request = 0;

   public static function limit($params): boolean{
      if(self::$quantity_same_request > 5){
         self::$quantity_same_request = 0;
         return true;
      }

      if($params["value_request"] != $params["value_old"]){
         self::$quantity_same_request = 1;
         return false;
      }

      if($params["value_request"] == $params["value_old"]){
         self::$quantity_same_request++;
         return false;
      }
   }
}

?>
