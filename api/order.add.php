<?php 
	require_once __DIR__."/controller/order_product.php";
    require_once __DIR__."/controller/order.php";
    require_once __DIR__."/../config/helper.php";
    require_once __DIR__."/model/product.php";
    require_once __DIR__."/model/order.php";
    require_once __DIR__."/model/order_product.php";
    require_once __DIR__."/controller/product.php";
    sessionStart();
    $method = $_SERVER['REQUEST_METHOD'];
    $orderProductCtr = new OrderProductCtr();
    $orderCtr = new OrderCtr();
    $productCtr = new ProductCtr();
	if($method == "POST"){
        
        //check auth
        if(checkSession() != "customer"){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }
        //check isset
        if (!isset($_SESSION['product-list']) || !isset($_POST['email']) || !isset($_POST['address']) || !isset($_POST['total'])){
        	 echo json_encode(array(
                "message" => "invalid input",
                "status" => "fail"
            ));
            return;
        }
        //check so luong
        for ($i = 0; $i < count($_SESSION['product-list']); $i++){
			if ($_SESSION['product-list'][$i]['product-amount'] > $_SESSION['product-list'][$i]['product-existed']){
				echo json_encode(array(
                "message" => "overWare",
                "status" => "fail"
            	));
            	return;
			}
		}
		$total=0;
        if(isset($_SESSION['product-list'])){
            if(count($_SESSION['product-list'])>0){
                for($i = 0; $i< count($_SESSION['product-list']); $i++){
                    $total+=$_SESSION['product-list'][$i]['product-price']*$_SESSION['product-list'][$i]['product-amount'];
                }
            }
        }
        // add order database
		$order = new Order();
	    $order->user_id = $_SESSION['userId'];
	    $order->deliver_status = 1;
	    $order->total_price = $total;
	    $order->address = $_POST['address'];
		$order_id = $orderCtr->create($order);
		
		for ($i = 0; $i < count($_SESSION['product-list']); $i++){
			// add order product database
			$order_product = new OrderProduct();
			$order_product->order_id = $order_id;
			$order_product->product_id = $_SESSION['product-list'][$i]['product-id'];
			$order_product->num_of_product = $_SESSION['product-list'][$i]['product-amount'];
			$order_product->price = $_SESSION['product-list'][$i]['product-price'];
			$orderProductCtr->create($order_product);
			// cap nhat so luong hang
			$product = new Product();
			$product->id = $_SESSION['product-list'][$i]['product-id'];
			$product->num_existed = $_SESSION['product-list'][$i]['product-existed'] - $_SESSION['product-list'][$i]['product-amount'];
			$product->changeNumProductExist();
		}
		// cap nhat so luong hang

		unset($_SESSION['product-list']);
		echo json_encode(array(
                "message" => "mua hang thanh cong",
                "status" => "success"
        	));
        return;
    }
 ?>