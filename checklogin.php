<?php

session_start();

require_once("db.php");

if(isset($_POST)) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$_SESSION['id_user'] = $row['id_user'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['role'] = $row['role'];

		echo "ok";
	} else {
		echo "error";
	}
}