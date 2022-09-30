<?php
require_once __DIR__.'/_x.php';
try{
  $query = 'SELECT * FROM user ORDER BY user_created_at DESC';
  $users = _db($query);
  _respond($users['result']);
}catch(Exception $ex){
  _respond(["info"=>$ex->getMessage()], 400);
}






