<?php
   function encrypt($params): array{
      foreach($params AS $key => $value){
         $value = password_hash($value, PASSWORD_BCRYPT);

         $params[$key] = $value;
      }
      return $params;
   }
?>
