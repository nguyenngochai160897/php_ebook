<?php
    require_once __DIR__."/controller/product.php";
    require_once __DIR__."/model/product.php";
    require_once __DIR__."/../config/helper.php";
   
    sessionStart();
    $method = $_SERVER['REQUEST_METHOD'];

    $productCtr = new ProductCtr();

    if($method == "POST"){
        $product = new Product();
        if(isset($_POST['page']) && isset($_POST['limit']) && isset($_POST['range']) 
            && !isset($_POST['category_id'])){
            $list = $product->getProductByOption($_POST['page'], $_POST['limit'], $_POST['range']);
            echo json_encode($list);
        }
        else if(!isset($_POST['page']) && !isset($_POST['limit']) && !isset($_POST['range']) && isset($_POST['category_id'])){
            $list = $product->getProductByOption(false, false, false, $_POST['category_id']);
            echo json_encode($list);
        }
        else if(isset($_POST['page']) && isset($_POST['limit']) && isset($_POST['range']) && isset($_POST['category_id'])){
            $list = $product->getProductByOption($_POST['page'], $_POST['limit'], $_POST['range'], $_POST['category_id']);
            echo json_encode($list);
        }
    }
    else if($method = "GET"){
        $product = new Product();
        $list = $product->searchProduct($_GET['search']);
        echo json_encode($list);
    }
    else{
        echo "Not exist method is '$method'";
    }
?>