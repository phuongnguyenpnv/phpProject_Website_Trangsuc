<?php
  $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

      function get_info_cartShopping_detail($connect, $id){
        $sql = "SELECT * FROM cartShopping WHERE id = '".$id."'";

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
    <title>Cart shopping</title>

    <link href = "css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <style type="text/css">
      .quantity{
        width: 150px;
        height: 40px;

      }
      .imgcart{
        height: 100px;
        width: 100px;
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
    
   


    <div>
    <div id='cart'>
      <div class="container"> 
 <table id="cart" class="table table-hover table-condensed"> 
  <thead> 
   <tr> 
    <th style="width:40%">Tên sản phẩm</th> 
    <th style="width:20%">Giá</th> 
    <th style="width:8%">Số lượng</th> 
    <th style="width:22%" class="text-center">Thành tiền</th> 
    <th style="width:10%"> </th> 
   </tr> 
  </thead> 
  <tbody><tr> 
 
  <?php 

    $sql = "SELECT count(*) FROM cartShopping group by 'id'";
    $result = $conn->query($sql);
     if ($result->num_rows > 0) {
          while($row = mysqli_fetch_array($result)){
            $total = $row['count(*)'];
          }
          mysqli_free_result($result);
        }
   $totalPrice=0;
    for ($i=1; $i <= $total; $i++) { 
      $info = get_info_cartShopping_detail($conn, $i);
      $price = number_format($info[3]);
      $tota= number_format($info[6]);  
      $totalPrice=$totalPrice+$info[6];

      echo"
        <tr>
         <td data-th='Product'> 
          <div class='row'> 
           <div class='col-sm-2 hidden-xs'><img class='imgcart' src='$info[5]'>
           </div> 
           <div class='col-sm-10'  style='padding-left: 40px;' > 
            <h4 class='nomargin'>$info[1]</h4> 
            <p>$info[2]</p> 
           </div> 
          </div> 
         </td> 
         <td data-th='Price' style='margin-top: 20px;'>$price vnđ</td> 
         <td data-th='Quantity'>$info[4]
         </td> 
         <td data-th='Subtotal' class='text-center'>$tota vnđ</td> 
          <td class='actions' data-th=''>".
              "<a  class='btnEdit' href = 'update_product.php?id=".$row['id']."' ><i class='glyphicon glyphicon-edit'></i></a>". "<a class='btnExit' href = 'delete_cartShopping.php?id=".$row['id']."' ><i class='glyphicon glyphicon-trash'></i></a>
         </td> 
        </tr> 
            ";
         }
  ?>
  
  </tbody><tfoot> 
   <tr class="visible-xs"> 
    <td class="text-center"><strong>Tổng 200.000 đ</strong>
    </td> 
   </tr> 
   <tr> 
    <td><a href="TrangSucVang.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
    </td> 
    <td colspan="2" class="hidden-xs"> </td> 
    <td class="hidden-xs text-center"><strong>Tổng tiền <?php echo number_format($totalPrice) ?> đ</strong>
    </td> 
    <td><a href="http://hocwebgiare.com/" class="btn btn-success btn-block">Thanh toán <i class="fa fa-angle-right"></i></a>
    </td> 
   </tr> 
  </tfoot> 
 </table>
</div>
    </div>
  <?php include ("footer.php"); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
