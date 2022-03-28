<?php 
include('../functions.php');
include('php/delete.php'); 

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>
                    <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 

        
        <div class="box">
			<h4 class="display-5 text-center">User List</h4><br>
			<?php if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?> 
			<?php if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">User Type</th>
			      <th scope="col">Password</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
			    <tr>
			      <th scope="row"><?=$i?></th>
			      <td><?=$rows['username']?></td>
			      <td><?php echo $rows['email']; ?></td>
			      <td><?php echo $rows['user_type']; ?></td>
			      <td><?php echo $rows['password']; ?></td>
			      <td><a href="update2.php?id=<?=$rows['id']?>" 
			      	     class="btn btn-success">Update Password</a>

			      	  <a href="php/delete.php?id=<?=$rows['id']?>" 
			      	     class="btn btn-danger">Delete</a>

                        </button>
			      </td>
			    </tr>
			    <?php } ?>
			  </tbody>
			</table>
			<?php } ?>

		</div>




					<small>
						<br>
                        <br>

                        <button class="btn-add_user">
                            &nbsp; <a href="create_user.php"> + add user</a>                
                        </button>

                        <button class="btn-logout">						
                            <a href="home.php?logout='1'">logout</a>
                        </button>                
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>