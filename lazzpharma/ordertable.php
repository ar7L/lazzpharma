<?php

     include("partials/header.php");
     include("inc/Fun.php");
     if(empty($_SESSION['staff_email'])){
	        header("location:index.php");
	      }
	 $arr = getAll("order_list");

?>

<body>
	<div class="container">
		<div class="col-md-8 offset-md-2">
		 	<h1 class="text-center my-5">ORDER TABLE</h1>
		</div>


		 <table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">ID</th>
			      <th scope="col">Name</th>
			      <th scope="col">Quantity</th>
			      <th scope="col">Price Per Unit</th>
			      <th scope="col">Total</th>
			      <th scope="col">Date</th>
			      <th scope="col">Recipt</th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php 
			         foreach($arr as $k=>$v){?>
			    <tr>

			         	<th scope="row"><?php echo $k + 1; ?></th>
					      <td><?php echo $v['order_id'] ?></td>
					      <td><?php echo $v['order_name']; ?></td>
					      <td><?php echo $v['order_quantity']; ?></td>
					      <td><?php echo $v['order_price']; ?></td>
					      <td><?php echo $v['total']; ?></td>
					      <td><?php echo $v['date']; ?></td>
					      <td><?php echo $v['recipt']; ?></td>
			    </tr>

			         <?php }
			      ?>
			    
			</table>


  </div>
			

</body>

</html>