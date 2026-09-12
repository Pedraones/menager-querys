<?php
$dir_root = getenv('dir_menager_querys');

require_once __DIR__ . "/secrets.php";
require_once $dir_root . "/app/helpers/structuring-responses.php"; 

use const app\Models\secrets\PORT;
use const app\Models\secrets\DB;
use const app\Models\secrets\USER;
use const app\Models\secrets\PASSWORD;
use const app\Models\secrets\HOST;
use const app\Models\secrets\TABLE_QUERYS;
use const app\Models\secrets\TABLE_USER;

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
         "iissssiiis",
         $queryToInsert["id_user"],
         $queryToInsert["id_position_interprise"],
         $queryToInsert["name"],
         $queryToInsert["file_query"],
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

   public function getAQuery($desiredQuery): array{
      $query = "SELECT archive, content FROM querys";
      $conditions = "
         WHERE id_user = ?
         AND   id_position_interprise_user = ?
         AND   name = ?
         AND   description = ?
         AND   public_view = ?
         AND (
               code_referred_ESUS = ?
            OR code_referred_HDK = ?
         )"
      ;

      $result = $this->db->execute_query($query . $conditions, [
         $desiredQuery["id_user"],
         $desiredQuery["id_position_interprise_user"],
         $desiredQuery["name"],
         $desiredQuery["description"],
         $desiredQuery["public_view"],
         $desiredQuery["code_referred_ESUS"],
         $desiredQuery["code_referred_HDK"]
      ]);

      unset($desiredQuery);
      unset($query);
      unset($conditions);

      if($result->num_rows == 0) return [];

      $structuredResultToReturn = structureResponseGetAQuery($result);
      
      return $structuredResultToReturn;
   }

   public function getIdPositionInterpriseUser($idUser): int{      
      $query = "
         SELECT 
            id_position_interprise 
         FROM " . TABLE_USER;

      $conditions = " 
         WHERE id = ?
      ";     
      $query = $query . $conditions;

      $result = $this->db->execute_query(
         $query, [
            $idUser
         ]
      );

      if($result->num_rows == 0) return 0;

      foreach($result AS $value){
         return $value["id_position_interprise"];
      }
   }
}

?>
