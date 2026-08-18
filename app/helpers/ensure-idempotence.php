<?php

   function ensureIdempotence(...$params): bool{
      if($params[0]["newData"] == $params[0]["oldData"]) return true;

      return false;
   }
?>
