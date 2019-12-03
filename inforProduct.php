<?php 
	$conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
  if ($conn->connect_error) {
      die("Kết nối thất bại: " . $conn->connect_error);
  }
  $conn->set_charset("utf8");
  $products = $nameSp = $cost_price = $type_pro= $price = $quantity ="";
  $products_err = $nameSp_err = $cost_price_err = $type_pro_err = $price_err = $quantity_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

	if (isset($_POST['back'])){
        header('Location: admimtab.php');
    }

    if (empty(trim($_POST["nameSp"]))) {
    	$nameSp_err = "Please enter name product";
    }else{
    	$nameSp = trim($_POST["nameSp"]);
    }

    if (empty(trim($_POST["cost_price"]))) {
    	$cost_price_err = "Please enter cost price";
    }else{
    	$cost_price = trim($_POST["cost_price"]);
    }

    if (empty(trim($_POST["price"]))) {
    	$price_err = "Please enter product's price";
    }else{
    	$price = trim($_POST["price"]);
    }

    if (empty(trim($_POST["quantity"]))) {
    	$quantity_err = "Please enter product's quantity";
    }else{
    	$quantity = trim($_POST["quantity"]);
    }

    if (empty(trim($_POST["type_pro"]))) {
    	$type_pro_err = "Please enter product's type";
    }else{
    	$type_pro = trim($_POST["type_pro"]);
    }

    if(empty($nameSp_err) && empty($cost_price_err) && empty($price_err) && empty($quantity_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO `products` ( `product_name`, `cost_price`, `price`, `quantity`,`type_pro`, `pic`, `comments`) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    if($stmt = $conn->prepare($sql)){
  		if (isset($_FILES['fileUpload'])) {
			if ($_FILES['fileUpload']['error'] > 0)
   			echo "Upload lỗi!";
			else {
				if (!is_dir('uploads')) {
					mkdir('uploads');
				}
   		move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'uploads/' . $_FILES['fileUpload']['name']);}
   		}

    	$name_product= $_POST['nameSp']; 
    	$cost_price= $_POST['cost_price'];
    	$price= $_POST['price']; 
    	$quantity= $_POST['quantity']; 
    	
    	$type_pro= $_POST['type_pro']; 
    	echo "You have selected :" .$type_pro;
    	$note= $_POST['note']; 
    	$pic = "Image/Folder/".$_FILES['fileUpload']['name'];
    	echo $pic;
  		$stmt->bind_param("sssssss",$name_product, $cost_price, $price, $quantity, $type_pro, $pic, $note);
   		$stmt->execute();

   		echo "Thêm record thành công";
	   		$stmt->close();
	}
    }
   }
    
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

    <div class="container-fluid content">
		<div class="panel panel-default">
				<div class="row">
				<form action="" enctype="multipart/form-data" method="POST" role="form" class="container-fluid">
					<legend>Thêm sản phẩm </legend>
					<div class="col-md-4">
				        <div>
				          	<a href="#" class="thumbnail">
			                  <img class="image" src="<?php echo $pic ?>"> 
			                </a>
				          	<input type="file" name="fileUpload" id="fileUpload" size="35"> 
				        </div>
					    <div class="form-group" style="padding-left: 100px;">
					        <button type="submit" class="btn btn-primary" name="insert">Thêm</button>
							<a class="btn btn-primary" href="products.php">Trở về</a>
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
			        </div>

					<div class="login col-md-4" >
						<div class="row">
							<div class="wrapper">
					        	<div style="float: left;">
						            <div class="form-group <?php echo (!empty($nameSp_err)) ? 'has-error' : ''; ?>" >
						                <label>Tên sản phẩm</label>
						                <input type="text" name="nameSp" class="form-control" value="<?php echo $nameSp; ?>">
						                <span class="help-block"><?php echo $nameSp_err; ?></span>
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
					                    <input type="number" name="quantity" class="form-control" value="<?php echo $quantity; ?>>
					                    <span class="help-block"><?php echo $quantity_err; ?></span>
				                    </div>  
				            		<div class="form-group <?php echo (!empty($type_pro_err)) ? 'has-error' : ''; ?>">
					                    <label>Loại sản phẩm</label>
					                    <input type="text" name="type_pro" class="form-control" value="<?php echo $type_pro; ?>">
					                    <span class="help-block"><?php echo $type_pro_err; ?></span>
				                    </div> 
				            		
						            <div class="form-group">
						               <label>Chú ý</label>
						               <input type="text" name="note" class="form-control">
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

