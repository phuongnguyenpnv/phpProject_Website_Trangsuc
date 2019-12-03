<?php
  $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
     $id=$_GET['id'];
      function get_info_product_detail($connect, $id) {
      $sql = "SELECT * FROM products WHERE id = '".$id."'";
      $result = $connect->query($sql);
      if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)){
          $product[] = $row;
        }

        
        mysqli_free_result($result);
        return $product[0];
      }
      }

       
   if (isset($_POST['cart'])) {
     $total = 0;
      $product =get_info_product_detail($conn, $id);
      $name_product= $product[1]; 
      $price= $product[3]; 
      $quantity= $_POST['quantity']; 
      $type_pro= $product[5];
      $pic= $product[6];
      $total = $quantity*$price;
    $sql = "INSERT INTO `cartShopping` ( `name`, `price`, `quantity`,`type_pro`, `pic`, total) 
    VALUES ('$name_product', $price, $quantity, '$type_pro', '$pic', $total)";
     mysqli_query($conn,$sql);

  }
  //mysql_select_db("DatabaseTrangSucCuoi",$connect);
    
    ?>

 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin sản phẩm</title>

    <link href = "css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <style type="text/css">
      .name{
        color: black; 
        font-size: 35px;

      }
      .type{
        font-size: 20px;
        font-family: Palatino;
        margin-left: 50px;
        margin-top: 10px;

      }
      .btnSoLuong{
        height: 35px;
        width: 55px;
      }
      .bodderimg{
        height: 350px;
        width: 300px;
        margin-left: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
      }
      .imgChiTiet{
        margin-top: 30px;
        margin-left: 20px;
        height: 250px;
        width: 250px;
      }
      .btgioHang{
        color: #FF3300;
        height: 40px;
        font-family: Palatino;
        width: 200px;
        margin-top: 20px;
        margin-right: 20px;
      }
    </style>
  </head>
  <body>
    <?php include ("header.php"); ?>
    <div class="container-fluid" >
      <div id="wrapper">
        <div  class="menu row">
          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 hidden-xs">
            <ul class = "nav nav-tabs" id="myTab">
              <li class = "nav-item">
                <a class="nav-link" href="TrangSucVang.php">Trang sức vàng</a>
              </li>
              <li class = "nav-item">
                <a class="nav-link" href="TrangSucBac.php" >Trang sức bạc</a>
              </li>
              <li class = "nav-item">
                <a class="nav-link" href="TrangSucKimCuong.php" >Trang sức kim cương</a>
              </li>
              <li class = "nav-item">
                <a class="nav-link" href="BoSuuTap.php">Bộ sưu tập</a>
              </li>
              <li class = "nav-item">
                <a class="nav-link" href="#" >Quà tặng</a>
              </li>
            </ul>
          </div>
          <div class="col-xs-4" class="span3 mp-search-header search-box">
            <form class="search-form" action="http://hocwebgiare.com/"> 
              <a href="#"><input class="form-control" style="width: 300px; float: left;" placeholder="Search" type="text"><button style="height: 40px;" class="btn btn-light"><i class="icon-menu glyphicon glyphicon-search"></i></button></a>
            </form>
          </div>
        </div>
      </div>
    </div>
      <div  class="container-fluid border" >
        <div class="col-lg-1 col-md-1">

      </div>
      <form action="" enctype="multipart/form-data" method="POST" role="form" class="container-fluid">
      
      <div class="col-lg-10 col-md-10" style="height: 400px; background-color: #EEEEEE;">
      <div  class="col-lg-4 col-md-4 bodderimg" style="float: left; background-color: white; ">
        <?php $info = get_info_product_detail($conn, $id); ?>
        <img class="imgChiTiet" src=<?php echo $info[6]; ?>>
      </div>
      <div class="col-lg-7 col-md-7 type">
        <h1>Thông tin sản phẩm</h1><br>
        <?php 

            $price = number_format($info[3]);
            echo "<strong class='name'>$info[1]</strong>"."<br>";
            echo "<strong>Giá sản phẩm: </strong>"."<span style='color:red;'>$price VNĐ</span>"."<br>";
            echo "<strong style='float: left;''>Số lượng: </strong>";?>

            <input class=" btnSoLuong text-center" name="quantity" value="1" type="number">
            <?php echo $info[4]." Sản phẩm có sẵn <br> <br>";
            echo "<strong>Loại:</strong> ".$info[5]."<br>";
            echo "<strong>Vận chuyển:</strong>"."<br>"

         ?>
          
          <button type="submit" class="btn btn-tinted btn--l YtgjXY _3a6p6c btgioHang" name="cart"  style="border: solid 1px #FF3300; font-size: 18px;">
            <i class="icon-menu glyphicon glyphicon-shopping-cart"></i>
            <span>Thêm vào giỏ hàng</span>
          </button>
          <button type ="submit"class="btn btn-tinted btn--l YtgjXY _3a6p6c btgioHang" name="buy" style="border: solid 1px #FF3300; font-size: 18px;">
            <span >Mua ngay</span>
          </button>

      </div>
    </div>
      </form>
      
      <div class="col-lg-1 col-md-1">
        
      </div><br>
      </div>
    <?php include ("footer.php"); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://id.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
