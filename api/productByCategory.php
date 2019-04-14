<?php
    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){
        if(isset($_GET['id'])){
            require_once __DIR__."/model/db.php";
            $conn = connectDB();
            $query = "SELECT products.*, categories.id as category_id, categories.name as category_name FROM products, categories WHERE category_id=categories.id AND category_id=".$_GET['id'];
            $result = mysqli_query($conn, $query);
            $arr = [];
            if(mysqli_num_rows($result) > 0){
                while($row=mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            echo json_encode($arr);
        }
    }
   
    else{
        echo "Not exist method is '$method'";
    }
?>