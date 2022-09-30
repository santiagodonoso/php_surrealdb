<?php
require_once __DIR__.'/_x.php';
try{
  $query = 'DELETE '.$_POST['user_id'];
  $users = _db($query);
  _respond($users['result']);
}catch(Exception $ex){
  _respond(["info"=>$ex->getMessage()], 400);
}