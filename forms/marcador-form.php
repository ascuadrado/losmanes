<?php

function getAction($action){
  $act = '';
  switch ($action) {
    case 'CAT I 🥇':
      $act = 'cat1';
      break;
    case 'CAT II 🥈':
      $act = 'cat2';
      break;
    case 'CAT III 🥉':
      $act = 'cat3';
      break;
    case 'BALLS BACK 🏓':
      $act = 'balls';
      break;
    case 'ON FIRE 🔥':
      $act = 'fire';
      break;
    case 'COCHES CHOCONES 🚙':
      $act = 'coche';
      break;
    default:
      $act = "ERRROR";
      break;
  }
  return $act;
}

function updateJsonScores($name, $action, $object)
{
  # Check SEUL
  foreach ($object->SEUL as $key => $value) {
    if ($value->nombre == $name) {
    	$act = getAction($action);
    	$object->SEUL[$key]->$act ++;
    }
  }

  # Check TTU
  foreach ($object->TTU as $key => $value) {
    if ($value->nombre == $name) {
    	$act = getAction($action);
    	$object->TTU[$key]->$act ++;
    }
  }

  return $object;
}

$errors = [];
$data = [];

if (empty($_POST['password'])) {
  $errors['data'] = 'Password is required.';
}else if ($_POST['password'] !== "HonorManes"){
  $errors['data'] = 'Wrong password';
}else{
  $nombre = $_POST['nombre'];
  $accion = $_POST['accion'];

  $jsonString = file_get_contents('../data/team.json');
  $jsonObj = json_decode($jsonString);

  $newJson = updateJsonScores($nombre, $accion, $jsonObj);
  $data['putFiles'] = file_put_contents('../data/team.json', json_encode($newJson));
}

if (!empty($errors)) {
  $data['success'] = false;
  $data['errors'] = $errors;
} else {
  $data['success'] = true;
  $data['message'] = 'Success! Please reload!';

  $data['newJson'] = $newJson;
}

echo json_encode($data);
?>
