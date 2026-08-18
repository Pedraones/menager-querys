<?php

   function ensure_idempotence($params): bool{
      if($params["new_value"] == $params["old_value"]) return true;

      return false;
   }

?>
