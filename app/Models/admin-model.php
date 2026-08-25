<?php
require_once __DIR__ . "/secrets.php";

use const app\Models\secrets\DB;
use const app\Models\secrets\PORT;
use const app\Models\secrets\USER;
use const app\Models\secrets\PASSWORD;
use const app\Models\secrets\HOST;
use const app\Models\secrets\TABLE_POSITION;
use const app\Models\secrets\TABLE_USER;

class adminModel{
   public function addPosition($name){
      $db = new mysqli(
         HOST,
         USER,
         PASSWORD,
         DB,
         PORT
      );

      $building_query = $db->prepare("INSERT INTO " . TABLE_POSITION . " (name) VALUES (?)");
      $building_query->bind_param("s", $name);
      $building_query->execute();

      $db->close();
   }

   public function getPosition($position): bool{
      $db = new mysqli(
         HOST,
         USER,
         PASSWORD,
         DB,
         PORT
      );

      $query = "SELECT name FROM " . TABLE_POSITION . " WHERE name = ?";
      
      $result = $db->execute_query($query, [$position]);

      foreach($result as $row){
         if($row["name"] == $position) return true;
         break;
      }

      $result->close();
      $db->close();

      return false;
   }

   public function getUsers($user): bool{
      $db = new mysqli(
         HOST,
         USER,
         PASSWORD,
         DB,
         PORT
      );
      
      $query = "
         SELECT 
            name, 
            email, 
            password, 
            id_position_interprise 
         FROM " . TABLE_USER;

      $conditions = " 
         WHERE name = ?
         AND   email = ?
         AND   password = ?
         AND id_position_interprise = ?
      ";     
      $query = $query . $conditions;

      $result = $db->execute_query(
         $query, [
            $user["name"], 
            $user["email"], 
            $user["password"], 
            $user["id_position_interprise"]
         ]
      );

      var_dump($result);

      #echo "<br>";

      if($result->num_rows == 0) return false;

      return true;
   }

   public function addUser($user){
      $db = new mysqli(
         HOST,
         USER,
         PASSWORD,
         DB,
         PORT
      );

      $building_query = $db->prepare(
         "INSERT INTO " . TABLE_USER . " 
         (name, email, password, salt, id_position_interprise) 
         VALUES (?, ?, ?, ?, ?)"
      );
      
      $building_query->bind_param(
         "ssssi", 
         $user["name"], 
         $user["email"], 
         $user["password"], 
         $user["salt"], 
         $user["id_position_interprise"]
      );
      $building_query->execute();

      $db->close();

      unset($building_query);
      unset($db);
      unset($user);
   }
}

$teste = new adminModel();
$result = $teste->getUsers(
   [
    'name'                   => 'João Silva',
    'email'                  => 'joao.silva@empresa.com',
    'password'               => '$2y$10$e8N3...hash_da_senha',
    'id_position_interprise' => 5
]
);

var_dump($result);

?>
