<?php
function structureResponseGetAQuery($response): array{
      $result = [];

      foreach($response AS $key => $value){
         $result[$key] = $value;
      }

      return $result;
   }
?>
