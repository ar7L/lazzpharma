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
	include('./inc/auth.php');
	$status = $_GET['status'];
	$title = "";

	if($status == 'signup'){
		$title = "Sign Up";
		

	}if($status == 'signing'){
		$title = "Sign In";
	}
	if($status == 'signup'){
		if(isset($_POST['submit'])){
			$name = $_POST['staff_name'];
			$email = $_POST['staff_email'];
			$password = $_POST['staff_password'];

			$staff = new Staff($name , $email , $password);
			$staff->create_staff();
		}
	}
	if($status == 'signin'){
		if(isset($_POST['submit'])){
			$email = $_POST['staff_email'];
			$password = $_POST['staff_password'];

			$staff = new Auth($email , $password);
			$staff->authorize();
		}
	}
	if($status == 'signout'){
		  session_unset();
		  session_destroy();
		  ob_start();
		  header("location:index.php");
		  ob_end_flush();
	}
    ?>
	<div class="form-inp">
      <form action = "signing.php?status=<?php echo $status;?>" class="form" method="post">
          <h1 class="form__title"><?php echo trim($title); ?></h1>


          <?php if($status == 'signup'){ ?>

          	   <div class="form__div">
				    <input name="staff_name" placeholder=" " type="text" class="form__input"/>
				    <label class="form__label">Name</label>
		      </div>
		  	  

		  <?php } ?>	
              	
        
		  <div class="form__div">
		    <input name="staff_email" placeholder=" " type="text" class="form__input"/>
		    <label class="form__label">Email</label>
		  </div>


                  
                  

             
                
		  <div class="form__div">
		    <input name="staff_password" placeholder=" " type="password" class="form__input"/>
		    <label class="form__label">Password</label>
		  </div>
		        
	       <input type="submit" name = "submit" class="form__button">
	   </form>
    </div>


</body>
</html>
