<?php
$conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
// Initialize the session
session_start();
 

// $sql = "DELETE FROM ".'cartshopping';
// mysqli_query($conn,$sql);
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 

// Redirect to login page
header("location: Login.php");
exit;
?>