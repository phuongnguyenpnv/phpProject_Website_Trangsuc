<?php
	$conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

   // Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, role FROM customers WHERE username = ?";
        
        // $result = mysqli_query($conn, $sql);
        // print_r($result);
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
              $result = mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
              echo $result;
              echo "day ne";
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 

                            $_SESSION["role"] = $role;

                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                if ($_SESSION["role"] === 'Admin') {
                                   header("Location: Administrator.php");
                                   exit;
                                } else {
                                    header("location: Website.php");
                                    exit;
                                }
                            }

                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href = "css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/content.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<style type="text/css">
		.avr{
		  padding-top: 10px;
		  padding-left: 15px;
		  margin-top: 5px;
		  height: 100%;
		  float: left;
		  text-align: center;
		  border: none;
		}
	</style>
</head>
<body >
	 <?php include ("header2.php"); ?>
	<div  class="menu row" style="background-color: white">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<ul class = "nav nav-tabs" id="myTab">
				<li class = "nav-item">
					<a class="nav-link" href="TrangSucVang.html" >Trang sức vàng</a>
				</li>
				<li class = "nav-item">
					<a class="nav-link" href="TrangSucBac.html">Trang sức bạc</a>
				</li>
				<li class = "nav-item">
					<a class="nav-link" href="TrangSucKimCuong.html" >Trang sức kim cương</a>
				</li>
				<li class = "nav-item">
					<a class="nav-link" href="BoSuuTap.html" >Bộ sưu tập</a>
				</li>
				<li class = "nav-item">
					<a class="nav-link" href="#">quà tặng</a>
				</li>
			</ul>
		</div>
		<div class="col-xs-4" class="span3 mp-search-header search-box">
            <form class="search-form" action="http://hocwebgiare.com/"> 
              <a href="#"><input class="form-control" style="width: 300px; float: left;" placeholder="Search" type="text"><button style="height: 40px;" class="btn btn-light"><i class="icon-menu glyphicon glyphicon-search"></i></button></a>
            </form>
        </div>
	</div>
	<div class="row" style="height: 450px">
		<div class="col-xs-3 col-sm-3 ">
				
		</div>	
		<div class="col-xs-6 col-sm-6 avr">
			 	<h2>Login</h2>
        	<p>Please fill in your credentials to login.</p>
        	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            	<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                	<label>Username</label>
                	<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                	<span class="help-block"><?php echo $username_err; ?></span>
            	</div>    
            	<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                	<label>Password</label>
                	<input type="password" name="password" class="form-control">
                	<span class="help-block"><?php echo $password_err; ?></span>
            	</div>
            	<div class="form-group">
                	<input type="submit" class="btn btn-primary" value="Login">
            	</div>
            	<p>Don't have an account? <a href="SignUp.php">Sign up now</a>.</p>
        </form> 
			 </div>
		</div>
		<div class="col-xs-3 col-sm-3 ">
			
		</div>			
	</div>
    <?php include "footer.php" ?>
 	<script src="js/jquery-3.3.1"></script>
	<script src = "js/bootstrap.js"></script>
</body>
</html>