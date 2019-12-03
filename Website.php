 <?php
 
    $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

// Initialize the session
    session_start();
 
// Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Login.php");
    exit;
    }

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
    header('Content-Type: text/html; charset=utf-8');
    $product = get_product_by_id($conn, 2);

    function searchProduct($connect){
      if (isset( $_GET['ok']) && $_GET["search"] != '') {
      $search = $_GET['search'];
      $query = "SELECT * FROM products WHERE product_name like '%$search%' ";

      $sql = mysqli_query($connect, $query);
//echo $sql;
      $num = mysqli_num_rows($sql);
      if ($num > 0) {
          echo $num." ket qua tra ve voi tu khoa <b>".$search."</b>"."<br>";
         
          echo "<div class='container-fluid'>";
            echo '<div class="col-sm-1"></div>';
            foreach( $sql as $row ) {
              $price = number_format($row['price']);
              
              echo"
              
                
                  <div class='col-sm-3 hovereffect row'> 
                   <div class='hidden-xs'><img src=".$row['pic'].">
                   </div> 
                   <strong>$price vnđ</strong>
                   <div class='overlay'>
                    <a class='info' href='chitietsp.php?id=".$row['id']."'>Chi tiết</a>
                  </div>
                  </div> 
                
                    ";

            }
            echo'</div>';
      } 
      else {
          echo "Khong tim thay ket qua!";
      }
    }
    }

  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Website nhẫn cưới</title>
    <link href = "css/bootstrap.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <style type="text/css">
          /*.image{
            border: solid 1px black;

          }*/
         .sologan{
            font-size: 30px; 
            color: #FFCC00; 
            padding-top: 5px;
            padding-right: 1100px;
            font-family: Palatino;
            font-style: italic;
          }
       </style>
    <link rel="stylesheet" type="text/css" href="css/content.css">
  </head>
  <body >
    <?php 
          if ($_SESSION["loggedin"] !== true) {
           include ("header2.php");
          } else {
            include ("header.php");
          }
          
     ?>
    <div class="container-fluid">
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

          <div class="col-xs-4 search-form" class="span3 mp-search-header search-box">
            <form action="" method="get">
                <input class="form-control" style="width: 300px; float: left;" placeholder="Search" type="text" name="search" />
                <input type="submit" style="height: 50px; margin-left: 5px;" name="ok" value="search" />
            </form>
            
          </div>
        </div>
      </div>
    </div>
    <div class="card text-center container-fluid">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
         </ol>
          <div class="carousel-inner">
            <div class="item active">
              <div class="row">
                <div class="col-md-3">
                  <img src="Image/b1.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình bông hoa 922433.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp; 350.000đ </span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/b2.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình nai 923334.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp; 450.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/b3.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình cây kem 9242.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;150.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/b4.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình sương rồng 92344.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp; 550.000đ</span></p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="row">
                <div class="col-md-3">
                  <img src="Image/b5.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình chữ love 92424.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;550.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/b6.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình Mỏ |Neo 92342.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp; 550.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/b7.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình Hồng Hạc 92340.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;550.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/b8.png" alt="Los Angeles" style="width:100%;">
                  <p>Hạt charm DIY PNJSilver Retro Forest hình Thiên Điểu 92340.100</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;550.000đ</span></p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="row">
                <div class="col-md-3">
                  <img src="Image/c1.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng hồ nữ mạ vàng PNJ <br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp; Citizen BU2023.16E</p>
                 <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;10.500.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/c2.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng hồ nam thời trang PNJ <br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp; Citizen BU2013.12E</p>
                 <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;13.560.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/c3.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng hồ nam dây da PNJ<br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Citizen BU2025.15E</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;37.500.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/c4.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng hồ nữ đính đá PNJ <br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp; Citizen BU2033.11E</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;12.500.000đ</span></p>
                </div>
              </div>
            </div>
            <div class="item ">
              <div class="row">
                <div class="col-md-3">
                  <img src="Image/c5.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng dây da chống nước PNJ<br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Citizen BU225.65E</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;45.500.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/c6.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng hồ nữ dây thép PNJ <br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Citizen BU2055.11E</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;79.500.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/c7.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng hồ dây bạc PNJ <br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Citizen BU2525.13E</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;39.500.000đ</span></p>
                </div>
                <div class="col-md-3">
                  <img src="Image/c8.png" alt="Los Angeles" style="width:100%;">
                  <p> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Đồng hồ cao cấp PNJ <br> &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;Citizen BU2025.13E</p>
                  <p><span style="color: #ff9900">&ensp;&ensp;&ensp;&ensp;33.500.000đ</span></p>
                </div>
              </div>
            </div>
          </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container-fluid border">
        <?php
          searchProduct($conn);
        ?>
    </div>
    
    <?php include "footer.php" ?>
  </body>
</html>













