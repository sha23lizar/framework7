<?php
include 'config.php';

if (isset($_GET['code'])) {
    $code = mysqli_real_escape_string($conn, $_GET['code']);
    $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='$code'");
    
    if ($query) {
        echo "Code removed successfully.";
    } else {
        echo "Error removing code.";
    }
}
?>
