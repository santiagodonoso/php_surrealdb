<?php

// ##############################
// Start SurreadlDB's server
// surreal start --log trace --user admin --pass password file:data.db
function _db($query){ 
  $headers = [
    'Content-Type:application/json',
    'ns:company',
    'db:company'
  ];
  $ch = curl_init("http://localhost:8000/sql");
  curl_setopt($ch, CURLOPT_TIMEOUT, 2); //timeout in seconds
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Do not outout the response automatically on exec
  curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'admin:password');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch); // ENTER
  curl_close($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if( ! $http_code ){ throw new Exception('timeout'); }
  $response = json_decode($response, true); // the response as assosiative array
  if( isset($response['code']) && $response['code'] != 200 ){ throw new Exception($response['information']); }
  return end($response);
}

// ##############################
function _respond($message='', $status=200){
  http_response_code($status);
  header('Content-Type: application/json');
  $res = is_array($message) ? $message : ['info' => $message];
  echo json_encode($res);
  exit();
}






















