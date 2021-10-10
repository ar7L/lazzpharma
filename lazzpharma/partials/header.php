<?php include('./inc/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style.css">
	<title>Document</title>
</head>
<body>

<header class = "alert-primary">
	<div class="container">
		<nav class = "d-flex justify-content-between">
		<a class="logo" href="./index.php">LOGO</a>
		<div class="nav-section">
			<a href="tables.php">TABLES</a>
			<a class = "mx-5" href="ordertable.php">ORDER TABLE</a>
		</div>
		<div class="signing">
			<?php
               session_start();
               if(!empty($_SESSION['staff_name'])){?>
               	  <a><?php echo $_SESSION['staff_name']; ?></a>
			      <a href="./signing.php?status=signout">Sign Out</a>
               <?php }else {?>
			      <a href="./signing.php?status=signup">Sign Up</a>
			      <a href="./signing.php?status=signin">Sign In</a>


               <?php }
			?>
		</div>
	</nav>
	</div>
</header>