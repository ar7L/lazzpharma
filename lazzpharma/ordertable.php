<?php

     include("partials/header.php");
     include("inc/Fun.php");
     if(empty($_SESSION['staff_email'])){
	        header("location:index.php");
	      }
	 $arr = getAll("order_list");

	 if(isset($_POST['submit_r'])){
	 	$id = $_POST['recipt'];
	 	$temp = $arr;
	 	$arr = getBy("order_list","WHERE recipt =  '$id'");
	 	// print_r($arr);
	 	$product_ids = array();
	 	$uniq_ids = array_unique($product_ids);
	 	$actual_ids = array();
	 	$product_quantities = array();
	 	foreach($arr as $k=>$v){
	 		array_push($product_ids , $v['p_id']);
	 		array_push($product_quantities , $v['order_quantity']);
	 	}
	 	foreach($product_quantities as $k=>$v){
	 		$index = strval($product_ids[$k]);
	 		if(!isset($actual_ids[strval($product_ids[$k])])){
	 			$actual_ids[strval($product_ids[$k])] = 0;
	 		} 
	 		$actual_ids[strval($product_ids[$k])] += $v;
	 		// echo $index;
	 	}
	 	print_r($actual_ids);
	 	$original_quantities = array();
	 	foreach($actual_ids as $k=>$v){
	 		$val = getBy1("products","WHERE product_id = '$k'")['product_quantity'];
	 		$original_quantities[$k] = $val + $actual_ids[$k];
	 	}
	 	// echo count($original_quantities);
	 	// foreach($original_quantities as $k=>$v){
	 	// 	$original_quantities[$k] = $v + $product_quantities[$k];
	 	// }
	 	foreach($original_quantities as $k=>$v){
	 		$product_quantity = $v;
	 		$compose = compact('product_quantity');
	 		myUpdate("products",$compose,$k);
	 		// print_r($compose);
	 		// echo $k;
	 	}
	 	// print_r($actual_ids);
	 	// print_r($original_quantities);
	 	deleteBy("order_list", "WHERE recipt = '$id'");

	 	// print_r($original_quantities);
	 	// print_r($product_ids);
	 	// print_r($actual_ids);

	 	// print_r($product_quantities);
	 	header("location: ordertable.php");
	 	

	 }

?>

<body>
	<div class="container">
		<button onclick="show()" class="show-off">REFUND ORDER</button>
		<div class="hidden-form">
			<div class="form-inp">
                   <form action = "ordertable.php" class="form"  method="post">
                  <h1 class="form__title">REFUND ORDER</h1>

          	   <div class="form__div">
				    <input name="recipt" placeholder=" " type="text" class="form__input" required />
				    <label class="form__label">Recipt No</label>
		      </div>
	       <input type="submit" name = "submit_r" class="form__button" value = "CONFIRM">

		 </form>
		</div>
	</div>
		<div class="row">

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
			    

				  </tbody>
			   </table>
		   </div>

           </div>
			<script>
				
				function show(){
			let btn = document.querySelectorAll('.hidden-form')[0];
			console.log(btn);
			btn.classList.toggle('active');
		}
			</script>

</body>

</html>