<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['image'];
    $tmp_name = $image['tmp_name'];
    $name = $image['name'];
    $type = $image['type'];
    $size = $image['size'];

    // Save the file to a directory
    $upload_dir = './';
    $file_path = $upload_dir . $name;
    move_uploaded_file($tmp_name, $file_path);

    echo 'File uploaded successfully!';
  }
?>