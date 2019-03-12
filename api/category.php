<?php
    require_once  __DIR__."/controller/category.php";
    require_once  __DIR__."/model/category.php";
    require_once  __DIR__."";
    $method = $_SERVER['REQUEST_METHOD'];
    $categoryCtr = new CategoryCtr();

    if($method == "GET"){
        if(isset($_GET['id'])){
            echo $categoryCtr->fetch($_GET['id']);
        }
        else if(isset($_GET['page']) && isset($_GET['limit'])){
            echo $_GET['page'];
        }
        else{
            echo $categoryCtr->fetch();   
        }
    }
    else if($method == "POST"){
        if(!empty(trim($_POST['name']))){
            $category = new Category();
            $category->name = $_POST['name'];
            echo $categoryCtr->create($category);
        }
        else{
            echo json_encode(array("message" => "invalid input", "status" => "fail"));
        }
    }
    else if($method == "PUT"){
        parse_str(file_get_contents('php://input'), $_PUT);
       
        if(empty($_PUT['id']) || empty(trim($_PUT['name']))){
            echo json_encode(array("message" => "invalid input", "status" => "fail"));
        }
        else{
            $category = new Category();
            $category->id = $_PUT['id'];
            $category->name = $_PUT['name'];
            $categoryCtr = new CategoryCtr();
            echo $categoryCtr->update($category);
        }
    }
    else if($method == "DELETE"){
        parse_str(file_get_contents('php://input'), $_DELETE);
        if(empty($_DELETE['id'])){
            echo json_encode(array("message" => "invalid input", "status" => "fail"));
        }
        else{
            $category = new Category();
            $category->id = $_DELETE['id'];
            $categoryCtr = new CategoryCtr();
            echo $categoryCtr->delete($category);
        }
       }
    else{
        echo "Not exist method is '$method'";
    }
?>