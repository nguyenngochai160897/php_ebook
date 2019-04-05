<?php
    require_once __DIR__."/controller/product.php";
    require_once __DIR__."/model/product.php";
    require_once __DIR__."/../config/helper.php";
    
    sessionStart();
    $method = $_SERVER['REQUEST_METHOD'];
    $productCtr = new ProductCtr();
    $target_dir = __DIR__."/../uploads/";

    if($method == "POST"){
        //check admin
        if(checkSession() == false || checkSession() == "customer"){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }
        if(!isset($_POST['category_id']) || empty(trim($_POST['category_id']))
            ||!isset($_POST['id']) || empty(trim($_POST['id']))
            ||!isset($_POST['title']) || empty(trim($_POST['title']))
            ||!isset($_POST['publisher_name']) || empty(trim($_POST['publisher_name']))
            ||!isset($_POST['author_name']) || empty(trim($_POST['author_name']))
            ||!isset($_POST['publish_year']) || empty(trim($_POST['publish_year']))
            ||!isset($_POST['price']) || empty(trim($_POST['price']) || !is_numeric($_POST['price']))
            ||!isset($_POST['num_existed']) || empty(trim($_POST['num_existed'])) || !is_numeric($_POST['num_existed'])
            ){
                echo json_encode(array("message" => "invalid input", "status" => "fail"));
                return;
        }
        //handle file
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        if(!isset($_FILES['picture']) || file_exists($target_file)) {
            $product = new Product();
            $product->id = $_POST['id'];
            $data = $product->fetchByCategory();
            if(count($data) == 0){
                echo json_encode(array("message" => "not exist product", "status" => "fail"));
            }
            else{
                $product = new Product();
                $product->category_id = $_POST['category_id'];
                $product->title = $_POST['title'];
                $product->publisher_name = $_POST['publisher_name'];
                $product->author_name = $_POST['author_name'];
                $product->publish_year = $_POST['publish_year'];
                $product->price = $_POST['price'];
                $product->description = $_POST['description'];
                $product->picture = $data[0]['picture'];
                $product->num_existed = $_POST['num_existed'];
                $product->id= $_POST['id'];
                echo $productCtr->update($product);
            }
            return;
        }
        else{
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        }

        if($_FILES['picture']['error'] > 0){
            echo json_encode(array("message" => "maybe, something is wronged", "status" => "fail"));
        }
        else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            echo json_encode(array(
                "message" => "only jpg, png & jpeg files are allowed",
                "status" => "fail"
            ));
        }
        else{
            
            move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir.$_FILES['picture']['name']);
            $product = new Product();
            $product->id = $_POST['id'];
            $p = $product->fetchByCategory();
            if(!isset($p[0])) {
                return json_encode(array("message" => "id not exist", "status" => "fail"));
            }
            $file = $p[0]['picture'];
            unlink(__DIR__."/../uploads/".$file);
            $product->category_id = $_POST['category_id'];
            $product->title = $_POST['title'];
            $product->publisher_name = $_POST['publisher_name'];
            $product->author_name = $_POST['author_name'];
            $product->publish_year = $_POST['publish_year'];
            $product->price = $_POST['price'];
            $product->description = $_POST['description'];
            $product->picture = $_FILES["picture"]["name"];
            $product->num_existed = $_POST['num_existed'];
            echo $productCtr->update($product);
        }  
    }
    else{
        echo json_encode(array(
            "message" => "Not exsit method ".$method
        ));
    }