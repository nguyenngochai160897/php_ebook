<?php
    require_once __DIR__."/controller/product.php";
    require_once __DIR__."/model/product.php";
    require_once __DIR__."/../config/helper.php";
   
    sessionStart();
    $method = $_SERVER['REQUEST_METHOD'];

    $productCtr = new ProductCtr();

    $target_dir = __DIR__."/../uploads/";

    //retrieve product(s)
    if($method == "GET"){
        if(isset($_GET['id'])){
            $data = $productCtr->fetch($_GET['id']);
            echo $data;
        }
        else{
            echo $productCtr->fetch();
        }
    }
    //create a product
    else if($method == "POST"){
        //check admin
        if(checkSession() == false || checkSession() == "customer"){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }

        if(!isset($_POST['category_id']) || empty(trim($_POST['category_id']))
            ||!isset($_POST['title']) || empty(trim($_POST['title']))
            ||!isset($_POST['publisher_name']) || empty(trim($_POST['publisher_name']))
            ||!isset($_POST['author_name']) || empty(trim($_POST['author_name']))
            ||!isset($_POST['publish_year']) || empty(trim($_POST['publish_year']))
            ||!isset($_POST['price']) || empty(trim($_POST['price']) || !is_numeric($_POST['price']))
            ||!isset($_POST['description']) || empty(trim($_POST['description']))
            ||!isset($_POST['num_existed']) || empty(trim($_POST['num_existed'])) || !is_numeric($_POST['num_existed'])){
                echo json_encode(array("message" => "invalid input", "status" => "fail"));
                return;
        }
        //handle file
        
        if(!isset($_FILES['picture'])) {
            echo json_encode(array("message" => "have to choose image file", "status" => "fail"));
            return;
        }
        else{
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        }

        if (file_exists($target_file)) {
            echo json_encode(array("message" => "File name already exists", "status" => "fail"));
        }
        else if($_FILES['picture']['error'] > 0){
            echo json_encode(array("message" => "Maybe, something is wronged", "status" => "fail"));
        }
        else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            echo json_encode(array(
                "message" => "Only jpg, png & jpeg files are allowed",
                "status" => "fail"
            ));
        }
        else{
            move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir.$_FILES['picture']['name']);
            $product = new Product();
            $product->category_id = $_POST['category_id'];
            $product->title = $_POST['title'];
            $product->publisher_name = $_POST['publisher_name'];
            $product->author_name = $_POST['author_name'];
            $product->publish_year = $_POST['publish_year'];
            $product->price = $_POST['price'];
            $product->description = $_POST['description'];
            $product->picture = $_FILES["picture"]["name"];
            $product->num_existed = $_POST['num_existed'];
            echo $productCtr->create($product);
        }  
    }
    
    //delete a product
    else if($method == "DELETE"){
        //check admin
        if(checkSession() == false || checkSession() == "customer"){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }
        parse_str(file_get_contents('php://input'), $_DELETE);
        if(!isset($_DELETE['id']) || empty(trim($_DELETE['id']))){
            echo json_encode(array("message" => "invalid input", "status" => "fail"));            
        }
        else{
            $product = new Product();
            $product->id = $_DELETE['id'];
            echo $productCtr->delete($product);
        }
    }
    else{
        echo "Not exist method is '$method'";
    }
?>