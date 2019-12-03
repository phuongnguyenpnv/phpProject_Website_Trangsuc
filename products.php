<?php
  $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
  
    function get_product_by_id($connect){
      $sql = "SELECT * FROM products";
      $result = $connect->query($sql);

      if ($result->num_rows>0){
        $rowcount = 1;
        while($row = mysqli_fetch_assoc($result)){
          echo "<tr>";
            foreach ($row as $var => $value) {
             echo "<td>$value</td>";

            }
            echo 
             "<td class='actions' data-th=''>".
              "<a  class='btnEdit' href = 'update_product.php?id=".$row['id']."' ><i class='glyphicon glyphicon-edit'></i></a>".
              "<a class='btnExit' href = 'deleteProd.php?id=".$row['id']."' ><i class='glyphicon glyphicon-trash'></i></a>
             </td> ";
            echo "</tr>";
          ++$rowcount;
        }
        mysqli_free_result($result);
      }
    }
    header('Content-Type: text/html; charset=utf-8');
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Products</title>
  <link href = "css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/content.css">
  <style type="text/css">
    .Cell{
      height: 40px;
      text-align: center;
    }
    .btnEdit, .btnExit{
      width: 65px;
      color: blue;
      padding-left: 20px;
    }
    
    .button{
      margin-left: 10px;
      height: 30px;
      width: 100px;
      margin-bottom: 20px;
      color: red;
    }
  </style>
</head>
<body>
  <?php include ("header.php"); ?>
    
  <div class="row border" style="padding-bottom: 20px; padding-top: 10px;" >
    
    <div class="container-fluid">
      
      <h1>Thông tin sản phẩm </h1>
      <a href="inforProduct.php">
        <button class="button " type="button" name="btnnc" value="Thêm">
          <i class="  glyphicon glyphicon-cloud-upload"> Upload </i>
        </button>
      </a>
      <a href="Products.php">
        <button class="button " type="button" name="btnnc" value="Thêm">
          <i class="  glyphicon glyphicon-refresh"> Refresh </i>
        </button>
      </a>
        
       <table class="container-fluid" style="text-align: center;" border=”1px” cellspacing=”0″ cellpadding=”3″>
        <tr >
          <th style="width: 5%;" class="Cell">ID</th>
          <th style="width: 15%;" class="Cell">Tên sản phấm</th>
          <th style="width: 10%;" class="Cell">Giá nhập (đồng)</th>
          <th style="width: 10%;" class="Cell">Giá bán (đồng)</th>
          <th style="width: 10%;" class="Cell">Số lượng</th>
          <th style="width: 15%;" class="Cell">Loại sản phẩm</th>
          <th style="width: 15%;" class="Cell">link hình ảnh</th>
          <th style="width: 8%;" class="Cell">Other</th>
          <th style="width: 10%;" class="Cell">Action</th>
  
        </tr>

       <?php
        get_product_by_id($conn);
       ?>
  </table>
    </div>
  </div>
  <?php include ("footer.php"); ?>
  <script src="js/jquery-3.3.1"></script>
  <script src = "js/bootstrap.js"></script>
</body>
</html>
