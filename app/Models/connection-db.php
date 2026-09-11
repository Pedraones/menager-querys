<?php
require_once __DIR__ . "/secrets.php";

use const app\Models\secrets\DB;
use const app\Models\secrets\PORT;
use const app\Models\secrets\USER;
use const app\Models\secrets\PASSWORD;
use const app\Models\secrets\HOST;

class connectionDB{
   private $db;

   public function startConnection(): object{
      $this->db = new mysqli(
         HOST,
         USER,
         PASSWORD,
         DB,
         PORT        
      );

      return $this->db;
   }

   public function closeConnection(){
      $this->db->close();
   }
}

?>
