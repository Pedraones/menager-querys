<?php

   function ensure_idempotence(...$params): bool{
      if($params[0]["new_value"] == $params[0]["old_value"]) return true;

      return false;
   }
?>
