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

	<?php include('./partials/header.php'); 

	      if(empty($_SESSION['staff_email'])){
	        header("location:index.php");
	      }
	?>
 
  <div class="container">
	<h1>Hello <?php echo $_SESSION['staff_name']; ?> </h1>

  </div>

  <div class="container">
		<div class="mt-5 d-flex justify-content-between">
			<a href="staff.php" class="btn btn-primary">staff</a>
	      <a href="tables.php" class="btn btn-primary">Tables</a>

		</div>
	</div>
	

	
</body>
</html>