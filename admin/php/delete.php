<?php  
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

if(isset($_GET['id'])){
   include "../../functions.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$id = validate($_GET['id']);

	$query = "DELETE FROM users WHERE id=$id";
   $result = mysqli_query($db, $query);
   if ($result) {
   	  header("Location: ../home.php?success=successfully deleted");
   }else {
      header("Location: ../home.php?error=unknown error occurred&$user_data");
   }

}