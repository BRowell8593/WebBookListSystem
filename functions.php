<?php


// connect to database
function getConnection() {
   $db = new PDO(
 "mysql:host=localhost; dbname=unn_w19032995",
 "unn_w19032995", "RowanBilly2020");
   return $db;
}
?>