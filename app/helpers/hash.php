<?php
   require_once __DIR__ . "/secrets.php";
   use const app\helpers\ALGORITHM;

   function encrypt(...$params): string{
      $datas = $params[0];
      $brute_text = $datas["password"] . $datas["salt"];
      $result = hash(ALGORITHM, $brute_text);

      unset($params);
      var_dump($result);
      return $result;
   }

   $test = encrypt([
      "password" => "pokrv",
      "salt" => "prv"
   ]);
?>
