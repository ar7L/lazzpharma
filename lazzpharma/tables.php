<?php include('./partials/header.php'); 
      include('./inc/Fun.php');

	      if(empty($_SESSION['staff_email'])){
	        header("location:index.php");
	      }
	      $quantity = '1';
	      $arr = getAll("products");

	      function comp1($a , $b){
		   	if($a['product_quantity'] == $b['product_quantity'])return 0;
		   	return ($a['product_quantity'] > $b['product_quantity'])?1:-1;
		 }
		 function comp2($a , $b){
		   	if($a['product_quantity'] == $b['product_quantity'])return 0;
		   	return ($a['product_quantity'] < $b['product_quantity'])?1:-1;
		 }

	      if(isset($_GET['sort'])){
		   	if($_GET['sort'] === '1'){
		   		usort($arr,'comp1');
		   		$quantity = '2';
		   	}
		   	else{
		   	    $quantity = '1';
		   	    usort($arr , 'comp2');
		   	}
	       }
	       if(isset($_GET['delete_Id'])){
	       	$id = $_GET['delete_Id'];
	       	myDelete("products",$id,"tables.php");
	       }

	      if(isset($_POST['submit'])){
	      	$product_name = strtolower($_POST['product_name']);
	      	$product_quantity = $_POST['product_quantity'];
	      	$product_price = floatval($_POST['product_price']);
	      	$data = array($product_name, $product_quantity, $product_price);
	      	myInsert("products", $data , "tables.php");
	      }
	       if(isset($_POST['submit_u'])){
	      	$product_name = strtolower($_POST['product_name_u']);
	      	$product_quantity = $_POST['product_quantity_u'];
	      	$product_price = floatval($_POST['product_price_u']);
	      	$product_id = $_POST['product_id_u'];

	      	$data = compact('product_name', 'product_quantity', 'product_price');
	      	myUpdate("products", $data, $product_id , "tables.php");
	      	print_r($data);
	      }

	      if(isset($_GET['edit'])){
	      	$id = $_GET['edit'];
	      	$inputs = getBy("products","WHERE product_id = '$id'");


	      	?>
	      	<div class="">
			<div class="form-inp">
                   <form action = "tables.php" class="form"  method="post">
                  <h1 class="form__title">Edit Item</h1>

          	   <div class="form__div">
				    <input name="product_name_u" placeholder=" " value = "<?php echo $inputs['product_name']?>" type="text" class="form__input" required />
				    <label class="form__label">Name</label>
		      </div>
		      <input type="text" name="product_id_u" value = "<?php echo $inputs['product_id'];?>" hidden>
		      <div class="form__div">
				    <input name="product_quantity_u" placeholder=" " value = "<?php echo $inputs['product_quantity']?>" type="text" class="form__input" required />
				    <label class="form__label">Quantity</label>
		      </div>
		      <div class="form__div">
				    <input name="product_price_u"  placeholder=" " value = "<?php echo $inputs['product_price']?>" type="text" class="form__input" required/>
				    <label class="form__label">Price per unit</label>
		      </div>
		  	  
	       <input type="submit" name = "submit_u" class="form__button">
	   </form>
    </div>
		</div>
	      <?php }
	?>

	<div class="container">
		<button onclick="show()" class="show-off">ADD Product</button>
		<div class="hidden-form">
			<div class="form-inp">
                   <form action = "tables.php" class="form"  method="post">
                  <h1 class="form__title">Add Item</h1>

          	   <div class="form__div">
				    <input name="product_name" placeholder=" " type="text" class="form__input" required />
				    <label class="form__label">Name</label>
		      </div>
		      <div class="form__div">
				    <input name="product_quantity" placeholder=" " type="text" class="form__input" required />
				    <label class="form__label">Quantity</label>
		      </div>
		      <div class="form__div">
				    <input name="product_price" placeholder=" " type="text" class="form__input" required/>
				    <label class="form__label">Price per unit</label>
		      </div>
		  	  
	       <input type="submit" name = "submit" class="form__button">
	   </form>
    </div>
		</div>
		<div class="row my-4">
			<div class="col-md-6">
				<h1>Stock Table</h1>

				
				   

				 <table class="table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Product Name</th>
				      <th scope="col"><a href = "tables.php?sort=<?php echo $quantity; ?>">Available Units</a></th>
				      <th scope="col">Price Per Unit</th>
				      <th scope="col">Actions</th>
				      <th scope="col">Quantity</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    	<?php 
				  			  
					   foreach($arr as $k=>$v){?>

					      <th scope="row"><?php echo $k+1; ?></th>

					      <td class="p-name<?php echo $k?>"><?php echo $v['product_name']?></td>

					      <td><?php echo $v['product_quantity']?></td>
					      <td class="p-price<?php echo $k?>"><?php echo $v['product_price']?></td>

					      <td class="d-flex justify-content-between">
					      	<a href="tables.php?edit=<?php echo $v['product_id'];?> "><img src = "assets/edit.png" width= "20" height = "20"></a>
					      	<a onClick="return confirm('Are you sleeping??');" href="tables.php?delete_Id=<?php echo $v['product_id'];?>">&times;</a>
					      </td>

					      <td><input class="p-quant<?php echo $k; ?>" type="text"/><button id="<?php echo $k?>" onclick="addToCart(this.id)" class="btn alert-success btn-sm rounded-circle mx-1">+</button>
					      	<input class = "p-id<?php echo $k; ?>" type="text" value = "<?php echo $v['product_id'];?>" hidden>
					      </td>
					    </tr>
				    <?php }
				

				   
				 ?>
				  </tbody>
				</table>
					

			</div>
			<div class="col-md-6">
				<h1>Cart table</h1>
				<table class="table cart-list">
					<tr>
						<th scope="col">#</th>
						<th scope="col">product name</th>
						<th scope="col">prouct quantity</th>
						<th scope="col">prouct price</th>
						<th scope="col">total</th>
					</tr>
				</table>
				<hr>
				<div class="total-info d-flex justify-content-around">
					<p class="total"></p>
					<p class="discount"></p>
					<p class="deduced"></p>
				</div>
			      <button onclick="SendConfirm()" class="btn btn-danger">Confirm</button>

			</div>
		</div>
	</div>
    
      <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
	<scrip src = "vendor/bootstrap/js/bootstrap.min.js"></script>
	<script>
		function show(){
			let btn = document.querySelectorAll('.hidden-form')[0];
			console.log(btn);
			btn.classList.toggle('active');
		}
		var idx = 0;
		var List = [];
		var actual = 0;
		function addToCart(id){
			let cartList = document.querySelectorAll('.cart-list')[0];
			let totalP = document.querySelectorAll('.total')[0];
			let discountP = document.querySelectorAll('.discount')[0];
			let deducedP = document.querySelectorAll('.deduced')[0];

			let clsName = ".p-name"+id;
			let clsPrice = ".p-price"+id;
			let clsQuant = ".p-quant"+id;
			let clsid = ".p-id"+id;
			let pid = document.querySelector(clsid).value;
			let valName = document.querySelector(clsName).textContent;
			let valPrice = parseFloat(document.querySelector(clsPrice).textContent).toPrecision(6);
			let valQuant = parseFloat(document.querySelector(clsQuant).value).toPrecision(6);

			let total = 0;
			let amount = valPrice * valQuant;

			actual += amount;

			let info = {id: pid, name : valName , price : valPrice , quant: valQuant, total: amount};
			List.push(info);

			cartList.innerHTML += `<tr>
				                <th>${++idx}</th>
				                <td>${valName}</td>
				                <td>${valPrice}</td>
				                <td>${valQuant}</td>
				                <td>${amount.toPrecision(6)}</td>
				             </tr>`;

			totalP.innerHTML = `Total Price : ${actual.toPrecision(6)}`;
			discountP.innerHTML = `Discount Price: ${actual.toPrecision(6)}`;
			deducedP.innerHTML = `Discount Price: ${actual.toPrecision(6)}`;

		}
		function SendConfirm(){
			if(List.length === 0){
				alert("CART IS EMPTY");
				return;
			}
			 $.post('myFile.php', {
			    data: List
			  }, function(response) {
			  	// console.log(response);
			    List = [];
			    document.querySelectorAll(".cart-list")[0].innerHTML = "";
			    // console.log(response);
				location.reload();
				return false;
			  });
		}

			
	</script>
</body>
</html>