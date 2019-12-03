

<?php 
error_reporting(1);
$conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
if (isset($_GET['id']))
	{
	    $idProduct = $_GET['id'];
	    $sql = "SELECT * FROM products WHERE id  = " . $idProduct;
	    $result = mysqli_query($connect,$sql);
        if ($result) {       
           while($row = mysqli_fetch_assoc($result))
           {  
              $product_name= $row['product_name']; 
              $price= $row['price']; 
              $quantity= $row['quantity']; 
              $cost_price= $row['cost_price']; 
              $type_pro= $row['type_pro']; 
              $comments= $row['comments']; 
              $pic= $row['pic']; 
           }
	}
	   
if(isset($_POST['update'])) { 
    //Upload img
     if (isset($_FILES['fileUpload'])) {
       if ($_FILES['fileUpload']['error'] > 0)
           echo "Upload lỗi rồi!";
       else {
           move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'uploads/' . $_FILES['fileUpload']['name']);

       }
   }
    echo  $product_name= $_POST['product_name']; 
    echo $price= $_POST['price']; 
      $quantity= $_POST['quantity']; 
      $cost_price= $_POST['cost_price']; 
    echo  $type_pro= $_POST['type_pro']; 
      $comments= $_POST['comments']; 
      $pic = "Image/$Folder/".$_FILES['fileUpload']['name'];
      $s = "UPDATE products SET product_name = '$product_name', price = $price, quantity =$quantity, cost_price = $cost_price, type_pro = '$type_pro', comments = '$comments', pic = '$pic' WHERE id = $idProduct ;";
      mysqli_query($conn,$s);
      

    } else {echo "Looix".$mysqli-> error;} }

 ?>

 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Information for product</title>
	<link href = "css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/content.css">
	<style type="text/css">
		.button{
			width: 120px;
			height: 40px;
			background-color: #333333;
			color: #FFCC00
		}
		.image{
			height: 220px; 
			width: 250px; 
		}
		.checkbox{
			width: 700px;
			height: 40px;
		}
		.container{
			margin-top: 50px;
		}
		.home{
			margin-bottom: 10px;
		}
		.content{
			height: 450px;
		}
	</style>
</head>
<body>
	<?php include ("header.php"); ?>

    <<div class="container-fluid content">
		<div class="panel panel-default">
				<div class="row">
				<form action="" enctype="multipart/form-data" method="POST" role="form" class="container-fluid">
					<legend>Chỉnh sửa sản phẩm </legend>
					<div class="col-md-4">
				        <div>
				          	<a href="#" class="thumbnail">
			                  <img class="image" src="<?php echo $pic ?>"> 
			                </a>
				          	<input type="file" name="fileUpload" id="fileUpload" size="35"> 
				        </div>
					    <div class="form-group" style="padding-left: 100px;">
					        <button type="submit" class="btn btn-primary" name="update"><i class="glyphicon glyphicon-edit">Edit</i></button>
							<a class="btn btn-primary" href="products.php">Trở về</a>
					    </div>
				    </div>

					<div class="login col-md-4" >
						<div class="row">
							<div class="wrapper">
					        	<div style="float: left;">
						            <div class="form-group <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>" >
						                <label>Tên sản phẩm</label>
						                <input type="text" name="product_name" class="form-control" value="<?php echo $product_name; ?>">
						                <span class="help-block"><?php echo $product_name_err; ?></span>
						            </div>  
						            <div class="form-group <?php echo (!empty($cost_price_err)) ? 'has-error' : ''; ?>">
						                <label>Giá nhập sản phẩm</label>
						                <input type="number" name="cost_price"  class="form-control"  value="<?php echo $cost_price; ?>">
						                <span class="help-block"><?php echo $cost_price_err; ?></span>
						            </div>  
						            <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
						                <label>Giá bán sản phẩm</label>
						                <input type="number" name="price"  class="form-control" value="<?php print_r($price) ; ?>">
						                <span class="help-block"><?php echo $price_err; ?></span>
						            </div>  
						        </div>
						    </div>    
						</div> 
					</div>

				    <div class="login col-md-4">
				        <div class="row">
				           <div class="wrapper">
				                <div style="float: left;">
				                    <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
					                    <label>Số lượng sản phẩm</label>
					                    <input type="number" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
					                    <span class="help-block"><?php echo $quantity_err; ?></span>
				                    </div>  
				                    <div class="form-group <?php echo (!empty($type_pro_err)) ? 'has-error' : ''; ?>">
					                    <label>Loại sản phẩm</label>
					                    <input type="text" name="type_pro" class="form-control" value="<?php echo $type_pro; ?>">
					                    <span class="help-block"><?php echo $type_pro_err; ?></span>
				                    </div> 
				            		<div class="form-group">
						               <label>Folder</label>
						               <select name="Folder" class="form-control">
						               		<option value="LacTay" selected="selected">Lắc Tay</option>
						               		<option value="NhanCauHon">Nhẫn cầu hôn</option>
						               		<option value="NhanCuoiKC">Nhẫn cưới Kim Cương</option>
						               		<option value="NhanDoi">Nhẫn đôi</option>
						               		<option value="Vang">Vàng</option>
						               </select> 
						            </div>    
						            <div class="form-group">
						               <label>Chú ý</label>
						               <input type="text" name="comments" class="form-control">
						            </div>
				            	</div>    
				            </div>
				        </div>
					</div>
		    		</form>
			    </div>
			</div>
		</div>
					


	<?php include ("footer.php"); ?>
 	<script src="js/jquery-3.3.1"></script>
	<script src = "js/bootstrap.js"></script>
</body>
</html>
    <!-- Page Content -->
    