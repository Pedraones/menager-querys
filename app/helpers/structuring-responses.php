<?php
function structureResponseGetAQuery($response): array{
   $result = [];

   foreach($response AS $key => $value){
      $result[$key] = $value;
   }

   return $result;
}

function structureResponseGetQuerysPublicOrNot($response): array{
   $result = [];

   foreach($response AS $register => $values){
      if($values["archive"] == "") unset($values["archive"]);
      if($values["content"] == "") unset($values["content"]);
      if($values["code_referred_HDK"] == NULL) unset($values["code_referred_HDK"]);
      if($values["code_referred_ESUS"] == NULL) unset($values["code_referred_ESUS"]);

      $result[$register] = $values;
   }

   return $result;
}

function structureResponseGetSalt($response): string{
   $result = "";

   foreach($response AS $key => $value){
      $result = $value["salt"];
   }

   return $result;
}

function structureResponseGetPositionInterpriseUser($response): int{
   $result = 0;
   
   foreach($response AS $key => $value){
      $result = $value["id_position_interprise"];
   }

   return $result;
}

function strucutureContentOfFileQueryToInsertInDB($fileContent): string{
   $stringContent = "";
   
   foreach ($fileContent as $line) {
      $line = $line . "<br>";
      $stringContent = $stringContent . $line;
   }
   return $stringContent;
}   

function structureContentOfFileQueryToDownload($fileContent): array{
   $lines = explode("<br>", $fileContent);
   
   return $lines;
}
?>