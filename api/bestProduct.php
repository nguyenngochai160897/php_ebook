<?php

$method = $_SERVER['REQUEST_METHOD'];
if($method == "GET"){
    require_once __DIR__."/model/product.php";
    $p = new Product();
    echo json_encode( $p->getBestProduct());
}