
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		.container{
			margin-top: 50px;
		}
		.home{
			margin-bottom: 20px;
		}
		.content{
			height: 550px;
		}
	</style>
</head>
<body>
	<?php 
		$info = array();
		$file = fopen("registation.txt", "r");
		$text = fread($file,filesize("registation.txt"));
		$info= explode("|", $text);
	 ?>
	
	<?php 
	 	if($_SERVER["REQUEST_METHOD"] == "POST") {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			echo $target_file;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$check = getimagesize($_FILES["file"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
			// Check file size
			if ($_FILES["file"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			} else{
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}   
			$ho = $_POST['ho'];
			$ten = $_POST['ten'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			echo "<br>" . $target_file;
			if (!empty($ho) && !empty($ten) && !empty($email) && !empty($address) && !empty($phone)) {
				$file = 'registation.txt';
				if (file_exists($file)) {
					$a = fopen($file, "w");
					$txt = $ho . "|" . $ten . "|" . $email . "|"  . $address . "|"  . $phone . "|" . $target_file  . "|" .$username . "|" . $password;
					fwrite($a, $txt);
					fclose($a);
					echo "Ghi thành công";
				}
			}
			header('Location: showInfo.php');
		}
	  ?>
	 <?php include "header.php" ?>
	 
	 <div class="container-fluid content">
	 	<form method="POST" action="" enctype="multipart/form-data">
	 		<div class="col-md-6 home">
				<img src="<?php echo $info[5]; ?>" width="300px" height="300px">
				<input type="file" name="file" class="form-control home">
			</div>
		<div class="login col-md-6">
			<div class="row">
				<div class="col-md-6 home">
					Họ:
					<input type="text" name="ho" class="form-control" placeholder="Họ" value="<?php echo $info[0]; ?>" required>
				</div>
				<div class="col-md-6 home">
					Tên:
					<input type="text" name="ten" class="form-control" placeholder="Tên" value="<?php echo $info[1]; ?>"required>
				</div>
				<div class="col-md-12 home">
					Địa chỉ email:
					<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $info[2]; ?>"required>
				</div>
				<div class="col-md-12 home">
					Địa chỉ:
					<input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="<?php echo $info[3]; ?>"required>
				</div>
				<div class="col-md-12 home">
					Số điện thoại:
					<input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="<?php echo $info[4]; ?>"required>
				</div>
				<div class="col-md-6 home">
					User Name:
					<input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $info[6]; ?>"required>
				</div>
				<div class="col-md-6 home">
					Password:
					<input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $info[7]; ?>"required>
				</div>
				<div class="col-md-12 home">
					<button class="btn btn-success" name="submit"> UPDATE </button>
				</div>
			</div>
		</div>
	 	</form>
	</div>
	<?php include "footer.php" ?>

</body>
</html>