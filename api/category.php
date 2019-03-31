<?php
    require_once __DIR__."/controller/category.php";
    require_once __DIR__."/model/category.php";
    require_once __DIR__."/../config/helper.php";

    sessionStart();
    $method = $_SERVER['REQUEST_METHOD'];
    $categoryCtr = new CategoryCtr();

    //retrieve category
    if($method == "GET"){
        //retrieve a category
        if(isset($_GET['id'])){
            echo $categoryCtr->fetch($_GET['id']);
            
        }
        //retrieve all categories
        else{
            echo $categoryCtr->fetch();   
        }
    }
    //store a category
    else if($method == "POST"){
        //check admin
        if(checkSession() == false || checkSession() == "customer"){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }
        
        if(isset($_POST['name']) && !empty(trim($_POST['name'])) ){
            $category = new Category();
            $category->name = $_POST['name'];
            echo $categoryCtr->create($category);
        }
        else{
            echo json_encode(array("message" => "invalid input", "status" => "fail"));
        }
    }
    //update a category
    else if($method == "PUT"){
        //check admin
        if(checkSession() == false || checkSession() == "customer"){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }
        
        parse_str(file_get_contents('php://input'), $_PUT);
       
        if(!isset($_PUT['name']) || !isset($_PUT['id']) || empty($_PUT['id']) || empty(trim($_PUT['name']))){
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
    ////delete a category
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
        if(!isset($_DELETE['id']) ||empty($_DELETE['id'])){
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