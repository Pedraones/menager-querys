<?php
   require_once __DIR__ . "/secrets.php";
   use const app\helpers\ALGORITHM;

   function encrypt(...$params): string{
      $datas = $params[0];
      $brute_text = "";

      foreach($datas as $key => $value){
         if($key != "hash") {
            $brute_text = $brute_text . $value;
         }
      }

      $result = hash(ALGORITHM, $brute_text);

      unset($params);

      return $result;
   }

   function compareHash(...$params): bool{
      $hash = encrypt($params[0]);
      
      return hash_equals($hash, $params[0]["hash"]);
   }

?>
