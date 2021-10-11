<?php 
include("inc/connection.php");
include("inc/Fun.php");

  
if(isset($_POST)){
    if(isset($_POST['data'])){
    $data = $_POST['data'];
    $res = mysqli_fetch_array(mysqli_query($conn , "SELECT * FROM order_list ORDER BY  id DESC LIMIT 1"));
    $numrows =  $res['order_id'] + 1;
    // echo $numrows." ".$numrows*5;
    $uid = uniqid();
    foreach($data as $key => $value){
    	$send = array();
    	$order_id = $numrows;
    	$order_name = $value['name'];
    	$order_price = $value['price'];
    	$order_quantity = $value['quant'];
    	$total = $value['total'];
    	$date = date('Y-m-d H:i:s');
    	$recipt = $uid;
    	array_push($send , $value['id'], $order_id, $order_name ,$order_quantity, $order_price,$total,$date,$recipt);
    	print_r($send);
		$id = $value['id'];
		$product_quantity = getBy("products","WHERE product_id = '$id' ")[0]['product_quantity'];
		$product_quantity -= $order_quantity;
		print_r($product_quantity);
		if($product_quantity >= 0){
		   $arr = compact('product_quantity');
		   myInsert("order_list",$send);
		   myUpdate("products", $arr , $id);
		}
    	

    }
    
}}
?>