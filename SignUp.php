<?php 
	$conn = new mysqli('localhost', 'root', '', 'DatabaseTrangSucCuoi');
    // Kiểm tra kết nối
  if ($conn->connect_error) {
      die("Kết nối thất bại: " . $conn->connect_error);
  }
  $conn->set_charset("utf8");
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $full_name = $email = $address = $phone = "";
$username_err = $password_err = $confirm_password_err = $full_name_err = $email_err = $address_err = $phone_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM customers WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // validate full name
    if (empty(trim($_POST["full_name"]))) {
    	$full_name_err = "Please enter full name";
    }else{
    	$full_name = trim($_POST["full_name"]);
    }

    // validate email
    if (empty($_POST["email"])) {
    	$email_err = "Please enter email";
    }else{
    	$email = trim($_POST["email"]);
    }

    // validate phone
    if (empty($_POST["phone"])) {
 		$phone_err = "Enter phone number";
	} else {
  		$phone = trim($_POST["phone"]);
	}

	// validate address
	if (empty(trim($_POST["address"]))) {
		$address_err = "Please enter address";
	} else {
		$address = trim($_POST["address"]);
	}
	
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($full_name_err) && empty($email_err) && empty($phone_err) && empty($address_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO customers (cus_name, username, password, phone, email, address) VALUES (?, ?, ?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss",  $param_full_name, $param_username, $param_password, $param_phone, $param_email, $param_address);
            
            // Set parameters
            $param_full_name = $full_name;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phone = $phone;
            $param_email = $email;
            $param_address = $address;
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: Login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
	<title>Sign up account</title>
	<link href = "css/bootstrap.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		.button{
			width: 120px;
			height: 40px;
			background-color: #333333;
			color: #FFCC00
		}
		.image{
			height: 220px; 
			width: 250px; 
			margin-left: 50px; 
			border: solid 1px black;
			padding: 30px;
      margin-top: 50px;
			margin-bottom: 15px;
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
     .button{
      margin-left: 10px;
      height: 30px;
      width: 60px;
      margin-bottom: 20px;
      background-color: white;
      color: red;
	</style>
	 <link rel="stylesheet" type="text/css" href="css/content.css"> 
</head>
<body style="">
	<?php include ("header.php"); ?>
	<div class="container-fluid content" >
    <form method="POST" action="">
    <div class="col-md-4">
      <div>
        <img class="image" src="Image/cus.png" >
        <input style="margin-left: 50px;" type="file" name="fileUpload" id="fileUpload" size="35"><br>
      </div>
      <div class="form-group" style="padding-left: 100px;">
        <button type="submit" class="button" value="Submit"> <i class="glyphicon glyphicon-upload"></i></button>
        <button type="reset" class="button" value="Reset"> <i class="glyphicon glyphicon-refresh"></i></button>
      </div>
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
		<div class="login col-md-4" style="float: left;">
			<div class="row">
				<div class="wrapper">
          <h2>Sign Up</h2>
          <p>Please fill this form to create an account.</p>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        	<div style="float: left">
            <div class="form-group <?php echo (!empty($full_name_err)) ? 'has-error' : ''; ?>">
              <label>Fullname</label>
              <input type="text" name="full_name" class="form-control" value="<?php echo $full_name; ?>">
              <span class="help-block"><?php echo $full_name_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
              <label>Email</label>
              <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
              <span class="help-block"><?php echo $email_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
              <label>Phone</label>
              <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
              <span class="help-block"><?php echo $phone_err; ?></span>
            </div>  
          </div>
	      </div>    
      </div>
    </div>
    <div class="login col-md-4" style="padding-top: 100px;">
      <div class="row">
        <div class="wrapper">
          <div style="float: left;">
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
              <label>Address</label>
              <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
              <span class="help-block"><?php echo $address_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
              <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <label>Password</label>
              <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
              <span class="help-block"><?php echo $password_err; ?></span>
            </div>
          
          </div>    
        </div>
      </div>
	   </div>
    </form>
  </div>
	<?php include "footer.php" ?> 
</body>
</html>

               
          
              