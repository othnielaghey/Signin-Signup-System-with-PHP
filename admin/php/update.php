<?php
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

if (isset($_GET['id'])) {
	include "../functions.php";

	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$id = validate($_GET['id']);

	$query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
    	$row = mysqli_fetch_assoc($result);
    }else {
    	header("Location: home.php");
    }


}else if(isset($_POST['update'])){
	include "../../functions.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	// $username = validate($_POST['username']);
	// $email = validate($_POST['email']);
    // $user_type = validate($_POST['user_type']);
	$password = validate($_POST['password']);
    $password = md5($password);
	$id = validate($_POST['id']);

	// if (empty($username)) {
	// 	header("Location: ../update2.php?id=$id&error=username is required");
	// }else if (empty($email)) {
	// 	header("Location: ../update2.php?id=$id&error=Email is required");
	// }else if(empty($user_type)){
	// 	header("Location: ../update2.php?id=$id&error=user type is required");
    // }else
    if(empty($password)){
		header("Location: ../update2.php?error=Password is required&$user_data");
	} else {

       $query = "UPDATE users
               SET password='$password' WHERE id=$id";
       $result = mysqli_query($db, $query);
       if ($result) {
       	  header("Location: ../home.php?success=successfully updated");
       }else {
          header("Location: ../update2.php?id=$id&error=unknown error occurred&$user_data");
       }
	}
}
