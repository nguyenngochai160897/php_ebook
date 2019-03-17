<?php
    $path =  __DIR__."/../model/category.php";
    require_once $path; 

    class CategoryCtr{
        function fetch($id = false){
            $category = new Category();
            
            if($id != false && !is_numeric($id)){
                return json_encode(
                    array("message" => "id have to be number.", "status" =>"fail")
                );
            }
            else if($id != false && is_numeric($id)){
                $category->id = $id;
                $data = $category->get();
                return json_encode( array(
                    "record" => $data,
                    "status" => "success"
                ));
            }
            else{
                $data = $category->gets();
                return json_encode(
                    array(
                        "records" => $data,
                        "status" => "success"
                    )
                    );
            }
        }

        function create($category){
            $category->create();
            return json_encode(array(
                "status" => "success"
            ));
        }

        function update($category){
            $affectRow = $category->update();
            if($affectRow > 0){
                return json_encode(array(
                    "status" => "success"
                ));
            }
            return json_encode(array("status" => "review",  "message" => "not row affect"));
        }

        function delete($category){
            $affectRow = $category->delete();
            if($affectRow > 0){
                return json_encode(array(
                    "status" => "success"
                ));
            }
            return json_encode(array("status" => "review",  "message" => "not row affect"));
        }
    }
?>