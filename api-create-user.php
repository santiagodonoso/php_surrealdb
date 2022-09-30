<?php

require_once __DIR__.'/_x.php';

$user_id = bin2hex(random_bytes(25));

$user = json_encode([
  'user_name' => $_POST['user_name'],
  'user_last_name' => $_POST['user_last_name'],
  'user_created_at' => time()
]);

try{
  $query = "CREATE user:$user_id CONTENT $user";
  $db_response = _db($query);
  _respond($db_response);
}catch(Exception $ex){
  _respond(["info"=>$ex->getMessage()], 400);
}



