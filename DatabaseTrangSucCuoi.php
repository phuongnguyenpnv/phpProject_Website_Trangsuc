<?php
	$SEVER_NAME = "localhost";
	$USER_NAME_MYSQL = "root";
	$PASSWORD_MYSQL = "";
	header('Content-Type: text/html; charset=utf-8');

	$connect = mysqli_connect($SEVER_NAME, $USER_NAME_MYSQL, $PASSWORD_MYSQL);
	
	if ($connect) {
		echo "Connected successfully";
	} else{
		echo "Falled to connect to MYSQL". mysql_connect_error();
	}

	echo "vao day";
	$checkfont = mysqli_set_charset($connect, 'utf8');
	echo $checkfont;
	echo "ket thuc o day";


	if(mysqli_select_db($connect, "DatabaseTrangSucCuoi")){
		$sql = "CREATE TABLE customers(
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    cus_name VARCHAR(255) NOT NULL,
			username VARCHAR(255) NOT NULL,
		    password VARCHAR(255) NOT NULL,
		    phone varchar(11) NOT NULL,
		    email varchar(100) NOT NULL,
		    address VARCHAR(255) NOT NULL,
		    level VARCHAR(100) NOT NULL,
		    role VARCHAR(30) NOT NULL,
		    avatar_url VARCHAR(100)
		    )";
    if ($connect->query($sql) === TRUE){
    	echo "Table users created successfully";
    }else{
    	echo "Error creating table: ". $connect->error;
    }
	}else {
		echo "Unable to select database";
	}

	if(mysqli_select_db($connect, "DatabaseTrangSucCuoi")){
		$sql = "CREATE TABLE shippers(
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    name VARCHAR(255) NOT NULL,
		    phone_1 INT(11) NOT NULL,
		    phone_2 INT(11)
		)";
    if ($connect->query($sql) === TRUE){
    	echo "Table users created successfully";
    }else{
    	echo "Error creating table: ". $connect->error;
    }
	}else {
		echo "Unable to select database";
	}

	if(mysqli_select_db($connect, "DatabaseTrangSucCuoi")){
		$sql = "CREATE TABLE products(
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    product_name VARCHAR(255) NOT NULL,
		    cost_price INT(11) NOT NULL, -- Giá nhập
		    price INT(11) NOT NULL, -- Giá bán
		    quantity INT(11) NOT NULL,
		    type_pro VARCHAR (100) NOT NULL,
		    pic VARCHAR(100),
		    comments VARCHAR(500) NOT NULL
		)";
    if ($connect->query($sql) === TRUE){
    	echo "Table users created successfully";
    }else{
    	echo "Error creating table: ". $connect->error;
    }
	}else {
		echo "Unable to select database";
	}


	if(mysqli_select_db($connect, "DatabaseTrangSucCuoi")){
		$sql = "CREATE TABLE FeaturedProducts( -- sản phẩm nổi bật
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    product_name VARCHAR(255) NOT NULL,
		    cost_price INT(11) NOT NULL, -- Giá nhập
		    price INT(11) NOT NULL, -- Giá bán
		    quantity INT(11) NOT NULL,
		    pic VARCHAR(100),
		    comments VARCHAR(500) 
		)";
    if ($connect->query($sql) === TRUE){
    	echo "Table users created successfully";
    }else{
    	echo "Error creating table: ". $connect->error;
    }
	}else {
		echo "Unable to select database";
	}

	if(mysqli_select_db($connect, "DatabaseTrangSucCuoi")){
		$sql = "CREATE TABLE cartShopping(
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    name VARCHAR(255) NOT NULL,
		    type_pro VARCHAR(100) NOT NULL,
		    price INT(11) NOT NULL, 
		    quantity INT(11) NOT NULL,
		    pic VARCHAR(100),
		    total INT(11) NOT NULL
		)";
    if ($connect->query($sql) === TRUE){
    	echo "Table users created successfully";
    }else{
    	echo "Error creating table: ". $connect->error;
    }
	}else {
		echo "Unable to select database";
	}
	