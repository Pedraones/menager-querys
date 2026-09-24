<?php
$dir_root = getenv("dir_menager_querys");

require_once __DIR__ . "/secrets.php";
require_once __DIR__ . "/connection-db.php";

use const app\Models\secrets\TABLE_USER;

class userModel{
   public function getUser($user): bool{
      $connection = new connectionDB();
      $db = $connection->startConnection();
      
      $query = "
         SELECT 
            name, 
            email,  
            id_position_interprise 
         FROM " . TABLE_USER;

      $conditions = " 
         WHERE name = ?
         AND   email = ?
         AND id_position_interprise = ?
      ";     
      $query = $query . $conditions;

      $result = $db->execute_query(
         $query, [
            $user["name"], 
            $user["email"],  
            $user["id_position_interprise"]
         ]
      );

      unset($db);
      unset($connection);
      unset($query);
      unset($conditions);
      unset($user);

      if($result->num_rows == 0) return false;

      return true;
   }

   public function getSaltUser($user): object{
      $connection = new connectionDB();
      $db = $connection->startConnection();
      
      $query = "
         SELECT 
            salt
         FROM " . TABLE_USER;

      $conditions = " 
         WHERE email = ?
      ";     
      $query = $query . $conditions;

      $result = $db->execute_query(
         $query, [ 
            $user["email"]
         ]
      );

      unset($db);
      unset($connection);
      unset($query);
      unset($conditions);
      unset($user);

      return $result;
   }

   public function getLoginUser($credentials): bool{
      $connection = new connectionDB();
      $db = $connection->startConnection();
      
      $query = "
         SELECT 
            1 
         FROM " . TABLE_USER;

      $conditions = " 
         WHERE email = ?
         AND   password = ?
      ";     
      $query = $query . $conditions;

      $result = $db->execute_query(
         $query, [ 
            $credentials["email"],  
            $credentials["password"]
         ]
      );

      unset($db);
      unset($connection);
      unset($query);
      unset($conditions);
      unset($credentials);

      if($result->num_rows == 0 || $result->num_rows > 1) return false;

      return true;
   }

   public function addUser($user){
      $connection = new connectionDB();
      $db = $connection->startConnection();

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

      unset($db);
      unset($connection);
      unset($building_query);
      unset($user);
   }

}
?>
