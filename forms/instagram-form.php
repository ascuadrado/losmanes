<?php

$errors = [];
$data = [];

if (empty($_POST['id'])) {
  $errors['data'] = 'Instagram is required.';
}else {
    $id = $_POST['id'];
    $data['id'] = $id;
    $fp = fopen('data.csv', 'a');
    fputcsv($fp, [$id]);
    fclose($fp);
}

if (!empty($errors)) {
  $data['success'] = false;
  $data['errors'] = $errors;
} else {
  $data['success'] = true;
  $data['message'] = 'Success!';
}

echo json_encode($data);
?>
