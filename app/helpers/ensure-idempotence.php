<?php

   function ensureIdempotence(...$params): bool{
      if($params[0]["newDatas"] == $params[0]["oldDatas"]) return true;

      return false;
   }
?>
