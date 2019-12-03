<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrator</title>
	<link href = "css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/content.css">
	<style type="text/css">
		.avr{
		  padding-top: 10px;
		  padding-left: 15px;
		  margin-top: 5px;
		  height: 100%;
		  float: left;
		  text-align: center;
		}
		.images{
		  height: 400px;
		  width: 400px;
		  padding-top: 25px;
		  padding-left: 25px;
		}
		.button{
			margin-top: 40px;
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
	<div class="row border" style="height: 450px">
		<div class="col-xs-4 col-sm-4 avr">
			<h1>Sản phẩm</h1>
			<img class="images" src="Image/product.png">
			<br>
			<a href="products.php"><input class="button" type="button" name="btnnc" value="Quản lí sản phẩm"></a>
		</div>	
		<div class="col-xs-4 col-sm-4 avr">
			 <h1>Người dùng</h1>
			 <img class="images" src="Image/users.png">
			 <br>
			 <a href="users.php"><input class="button" type="button" name="btnnc" value="Quản lí thành viên"></a>
		</div>
		<div class="col-xs-4 col-sm-4 avr">
			<h1>Giỏ hàng</h1>
			<img class="images" src="Image/giohang.jpg"><br>
			<a href="giohang.php"><input class="button" type="button" name="btnnc" value="Quản lí giỏ hàng"></a>
		</div>			
	</div>
	<?php include ("footer.php"); ?>
 	<script src="js/jquery-3.3.1"></script>
	<script src = "js/bootstrap.js"></script>
</body>
</html>