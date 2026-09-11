<?php
require_once __DIR__ . "/secrets.php";
require_once __DIR__ . "/connection-db.php";

use const app\Models\secrets\TABLE_POSITION;

class positionInterpriseModel{
   public function addPosition($name){
      $connection = new connectionDB();
      $db = $connection->startConnection();

      $building_query = $db->prepare("INSERT INTO " . TABLE_POSITION . " (name) VALUES (?)");
      $building_query->bind_param("s", $name);
      $building_query->execute();

      unset($db);
      unset($connection);
   }

   public function getPosition($position): int{
      $connection = new connectionDB();
      $db = $connection->startConnection();

      $query = "SELECT id FROM " . TABLE_POSITION . " WHERE name = ?";
      
      $result = $db->execute_query($query, [$position]);

      foreach($result AS $register){
         return $register["id"];
      }

      $result->close();
      $db->close();

      return 0;
   }
}
?>
