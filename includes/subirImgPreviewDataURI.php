<?php
// print_r($_FILES['image']);

// $imageName = $_FILES["image"]["name"];
// $imageTempLoc = $_FILES["image"]["tmp_name"];
// $image = base64_encode(file_get_contents($imageTempLoc));
// $folder = $_POST["folder"];
$image = $_POST['data'];
$nameImg = rand();

$dir = "../users/" . $_POST['user_id'] . "/"."preview";
if (!file_exists($dir)) {
    mkdir($dir, 0777);
}
$urlImg = $dir . '/' . $nameImg . '.png';

// $fullPat = "../users/" . $_POST['id_user'] . "/"."preview/" . $nameImg . ".png";



$imageTempLoc_two = tempnam(sys_get_temp_dir(), 'image_');
$imageData = base64_decode($image);
file_put_contents($imageTempLoc_two, $imageData);
echo move_uploaded_file($imageTempLoc_two, $urlImg);
// echo $folder;
// echo $imageTempLoc_two;
if (!copy($imageTempLoc_two, $urlImg)) {
    echo "Failed to copy";
} else {
    echo $urlImg;
}
?>
