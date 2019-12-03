<?php
  $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
    function get_product_by_id($connect, $id){
      $sql = "SELECT * FROM Products WHERE id = '".$id."'";
      $result = $connect->query($sql);
      if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)){
          $product[] = $row;
        }
        mysqli_free_result($result);
        return $product[0];
      }
    }
    
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang sức cưới vàng</title>

    <link href = "css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/content.css">
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
                <a class="nav-link" href="Bongtai.php" >Bông tai cưới</a>
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
      <div class="container-fluid border">
        <div class="row">
          <div class="sidebar col-md-1 col-sm-1 ">
            
          </div>
          
          <div class="col-md-10 col-sm-10">
            <div class="box-index">
              <h2><br>Nhẫn cầu hôn</h2>
              <div class="row">
                <?php
                  for ($i=33; $i <= 40 ; $i++) { 
                    $product = get_product_by_id($conn, $i);
                    $price = number_format($product[3]);
                    echo"
                    <div class='col-lg-3 col-md-3 images'>
                      <div class='hovereffect'>
                        <img class='img-responsive' src='$product[6]' alt=''>
                        <strong>$price vnđ</strong>
                        <div class='overlay'>
                          <a class='info' href='chitietsp.php?id=$product[0]'>Chi tiết</a>
                        </div>
                      </div>
                    </div>";
                  }
                ?>
              </div>
            </div>
            <div class="box-index">
              <h2>Nhẫn đôi</h2>
              <div class="row">
                <?php
                  for ($i=17; $i <= 24 ; $i++) { 
                    $product = get_product_by_id($conn, $i);
                   
                    echo"
                    <div class='col-lg-3 col-md-3 images'>
                      <div class='hovereffect'>
                        <img class='img-responsive' src='$product[6]' alt=''>
                        <strong>$price vnđ</strong>
                        <div class='overlay'>
                          <a class='info' href='chitietsp.php?id=$product[0]'>Chi tiết</a>
                        </div>
                      </div>
                    </div>";
                  }
                ?>
              </div> 
            </div>
          <div class="sidebar col-md-1 col-sm-1 ">
            
          </div>
        </div>
      </div>

   
    <?php include ("footer.php"); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>