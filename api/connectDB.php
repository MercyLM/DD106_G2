<?php
	$dsn = "mysql:host=localhost;port=3306;dbname=dd106g2;charset=utf8";
	$user = "dd106g2";
	$password = "dd106g2";
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO( $dsn, $user, $password, $options);  
?>