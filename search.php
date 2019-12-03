<?php 
  $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    
  if (isset( $_GET['ok']) && $_GET["search"] != '') {
      $search = $_GET['search'];
      $query = "SELECT * FROM products WHERE product_name like '%$search%' ";

      $sql = mysqli_query($conn, $query);
//echo $sql;
      $num = mysqli_num_rows($sql);
      if ($num > 0) {
          echo $num." ket qua tra ve voi tu khoa <b>".$search."</b>";
         
          foreach( $sql as $row ) {
              print_r($row);
          }
      } 
      else {
          echo "Khong tim thay ket qua!";
      }
    }
?>