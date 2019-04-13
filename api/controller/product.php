<?php
    require_once __DIR__."/../model/product.php";

    class ProductCtr {
        
        function fetch($id = false){
            $product = new Product();
            
            if($id != false && !is_numeric($id)){
                return json_encode(
                    array("message" => "id have to be number.", "status" =>"fail")
                );
            }
            //get a product with id = ? 
            else if($id != false && is_numeric($id)){
                $product->id = $id;
                $data = $product->fetchByCategory();
                return json_encode( array(
                    "record" => $data,
                    "status" => "success"
                ));
            }
            //get all product with id = ? 
            else{
                $data = $product->fetchAllByCategory();
                return json_encode(
                    array(
                        "records" => $data,
                        "status" => "success"
                    )
                    );
            }
        }

        function create($product){
            
            $product->create();
            return json_encode(array(
                "message"=>"create success",
                "status" =>"success"
            ));
        }

        function delete($product){
            $p = $product->fetchByCategory();
            if(!isset($p[0])) {
                return json_encode(array("message" => "id not exist", "status" => "fail"));
            }
            $file = $p[0]['picture'];

            $data = $product->delete();
            if($data == 0){
                return json_encode(array("message" => "not row affect", "status" => "review"));
            }
            else{
                unlink(__DIR__."/../../uploads/".$file);
                return json_encode(array("message" => "delete success", "status" => "success"));
            }
        }

        function update($product){ 
            $data = $product->update();
            if($data <= 0){
                return json_encode(array("message" => "not row affect", "status" => "review"));
            }
            else{      
                return json_encode(array("message" => "update success", "status" => "success"));
            }
        }

    }

?>