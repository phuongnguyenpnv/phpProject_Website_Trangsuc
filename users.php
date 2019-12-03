<?php
  $conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
    function get_product_by_id($connect){
      $sql = "SELECT * FROM customers";
      $result = $connect->query($sql);

      if ($result->num_rows>0){
        while($row = mysqli_fetch_assoc($result)){
          echo "<tr>";
            foreach ($row as $var => $value) {
             echo "<td>$value</td>";
            }
            echo 
             "<td class='actions' data-th=''>".
              "<a  class='btnEdit' href = 'update_user.php?id=".$row['id']."' ><i class='glyphicon glyphicon-edit'></i></a>".
              "<a class='btnExit' href = 'delete_user.php?id=".$row['id']."' ><i class='glyphicon glyphicon-trash'></i></a>
             </td> ";
            echo "</tr>";
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
  <title>users</title>
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
    .Cell{
      height: 40px;
      text-align: center;
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
    
  <div class="row border" style="padding-bottom: 20px;" >
    
    <div class="container-fluid">
       <h1>Thông tin người dùng </h1>
       <a href="SignUp.php">
        <button class="button " type="button" name="btnnc" value="Thêm">
          <i class="  glyphicon glyphicon-cloud-upload"> Upload </i>
        </button>
      </a>
      <a href="users.php">
        <button class="button " type="button" name="btnnc" value="Thêm">
          <i class="  glyphicon glyphicon-refresh"> Refresh </i>
        </button>
      </a>
       <table style="text-align: center;" class="container-fluid" border=”1px” cellspacing=”0″ cellpadding=”3">
        <tr >
          <th style="width: 5%;" class="Cell">ID</th>
          <th style="width: 15%;" class="Cell">Name</th>
          <th style="width: 10%;" class="Cell">User name</th>
          <th style="width: 10%;" class="Cell">mật khẩu</th>
          <th style="width: 10%;" class="Cell">Phone number</th>
          <th style="width: 15%;" class="Cell">Email</th>
          <th style="width: 10%;" class="Cell">Address</th>
          <th style="width: 5%;" class="Cell">Level</th>
          <th style="width: 10%;" class="Cell">Link avatar</th>
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
