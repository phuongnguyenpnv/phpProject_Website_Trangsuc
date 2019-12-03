<?php 
  $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
  if (isset($_GET['id']) )
  {
      $idUser = $_GET['id'];
      $sql = "DELETE FROM ".'customers'." WHERE id  = " . $idUser;
      mysqli_query($conn,$sql);
      header('Location: users.php');
  }
 ?>

 