<?php

// get All curent users
$userCurents = getJson("data/UserCurent.json");


// get All users
$users = getJson("data/Users.json");

$id = @$_REQUEST['id'];
$user = [];

if ($id) {
  $user = getUserById($id,$users); 

  if (count($user)>0) {
    
    $user['dateTime'] = gmdate('d-m-Y H:i:s');
    array_push($userCurents, $user);
    $jsonData = json_encode($userCurents);
    file_put_contents('data/UserCurent.json', $jsonData);
     return emitNewUser($user);
  }

}
else
{
  emitUserNotFound($user);
}


// var_dump($user);
// echo $id;



?>