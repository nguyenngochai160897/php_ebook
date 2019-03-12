<?php
    $path =  __DIR__."/../model/category.php";
    require_once $path; 

    class CategoryCtr{
        function fetch($id = false){
            $category = new Category();
            if($id != false){
                if(is_numeric($id)){
                    $category->id = $id;
                    return $category->get();
                }
            }
            else{
                return $category->gets();
            }
        }

        function create($category){
           return $category->create();
        }

        function update($category){
            return $category->update();
        }

        function delete($category){
            return $category->delete();
        }
    }
?>