<?php
require_once __DIR__ . "/secrets.php";

use const app\Models\secrets\PORT;
use const app\Models\secrets\DB;
use const app\Models\secrets\USER;
use const app\Models\secrets\PASSWORD;
use const app\Models\secrets\HOST;
use const app\Models\secrets\TABLE_QUERYS;

class homeModel{
   private $db;

   function __construct(){
      $this->db = new mysqli(
         HOST,
         USER,
         PASSWORD,
         DB,
         PORT
      );
   }

   public function addQuery($queryToInsert){
      $mountQuery = $this->db->prepare(
         "INSERT INTO " . 
         TABLE_QUERYS . 
         "(id_user, id_position_interprise_user, name, archive, content, description, public_view, code_referred_ESUS, code_referred_HDK, created_at) VALUES (?,?,?,?,?,?,?,?,?,?)"
      );

      $mountQuery->bind_param(
         "iisbssiiis",
         $queryToInsert["id_user"],
         $queryToInsert["id_position_interprise"],
         $queryToInsert["name"],
         $queryToInsert["archive"],
         $queryToInsert["content"],
         $queryToInsert["description"],
         $queryToInsert["public_view"],
         $queryToInsert["code_referred_ESUS"],
         $queryToInsert["code_referred_HDK"],
         $queryToInsert["createdAt"]
      );
      $mountQuery->execute();

      $this->db->close();
      unset($this->db);
      unset($mountQuery);
   }
}

?>
