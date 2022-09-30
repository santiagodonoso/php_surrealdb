<?php

require_once __DIR__.'/_x.php';

try{
  $q = 'UPDATE '.$_POST['user_id'].' SET user_name="'.$_POST['user_name'].'", user_last_name="'.$_POST['user_last_name'].'"';
  $db_response = _db($q);
  _respond($db_response);
}catch(Exception $ex){
  _respond(["info"=>$ex->getMessage()], 400);
}









