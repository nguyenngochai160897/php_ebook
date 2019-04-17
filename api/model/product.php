<?php
    require_once __DIR__."/object.php";
    require_once __DIR__."/db.php";

    class Product{
        public $title, $publisher_name, $author_name, $publish_year, $category_id, $price, $picture,
            $num_existed, $description, $id;
        public $table = "products";


        public function create(){
            $conn = connectDB();
            $query = "INSERT INTO ".$this->table.
                    " SET ". "category_id = '" .$this->category_id."',".
                            " title = N'".$this->title."',".
                            " publisher_name = N'".$this->publisher_name."',".
                            " author_name = N'".$this->author_name."',".
                            " price = '".$this->price."',".
                            " picture = '".$this->picture."',".
                            " publish_year = '".$this->publish_year."',".
                            " description = '".$this->description."',".
                            " num_existed = '".$this->num_existed."'";
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
        }

        function update(){
            $conn = connectDB();
            $query = "UPDATE ".$this->table.
                    " SET ". "category_id = '" .$this->category_id."',".
                    " title = N'".$this->title."',".
                    " publisher_name = N'".$this->publisher_name."',".
                    " author_name = N'".$this->author_name."',".
                    " price = '".$this->price."',".
                    " picture = '".$this->picture."',".
                    " publish_year = '".$this->publish_year."',".
                    " description = N'".$this->description."',".
                    " num_existed = '".$this->num_existed."'".
                    " WHERE "."id =".$this->id;
            $result = mysqli_query($conn, $query);

            $affected = mysqli_affected_rows($conn);
            mysqli_close($conn);
            return $affected;
        }

        function changeNumProductExist(){
            $conn = connectDB();
            $query = "UPDATE ".$this->table.
                    " SET num_existed = '".$this->num_existed."'".
                    " WHERE "."id =".$this->id;
            $result = mysqli_query($conn, $query);
            $affected = mysqli_affected_rows($conn);
            mysqli_close($conn);
            return $affected;
        }
        
        function fetchAllByCategory(){
            $conn = connectDB();
            $father_table = "categories";
            $query = "SELECT products.*, categories.name as category_name FROM ".$this->table.
                    " JOIN categories ON products.category_id = categories.id ORDER BY products.id";
            $result = mysqli_query($conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            mysqli_close($conn);

            return $arr;
        }

        function fetchByCategory(){
            $conn = connectDB();
            $father_table = "categories";
            $query = "SELECT products.*, categories.name as category_name FROM ".$this->table.
                    " JOIN categories ON products.category_id = categories.id ".
                    "WHERE products.id = ".$this->id;
            $result = mysqli_query($conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                array_push($arr, $row);
            }
            mysqli_close($conn);

            return $arr;
        }

        public function delete(){
            $conn = connectDB();
            $query = "DELETE FROM ".$this->table." WHERE id=".$this->id;
            $result = mysqli_query($conn, $query);
            $affected = mysqli_affected_rows($conn);
            mysqli_close($conn);
            return $affected;
        }

        public function getBestProduct(){
            $query = "SELECT products.*, SUM(orders_products.num_of_product) as total FROM orders_products, products where orders_products.product_id = products.id GROUP BY orders_products.product_id ORDER BY total DESC LIMIT 0, 10";
            $conn = connectDB();
            $result = mysqli_query($conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            mysqli_close($conn);
            return $arr;
        }

        function getProductByOption($page=false, $limit=false, $range=false, $category=false){
            $conn = connectDB();
            $arr = [];
            if($page && $limit && $range && !$category){
                $offset = ($page-1)*$limit;
                $query = "SELECT * FROM products LIMIT ".$offset.", ".$limit;
                $query = "SELECT products.*,categories.name as category_name FROM products, categories WHERE products.category_id=categories.id ORDER BY products.id ASC LIMIT ".$offset.", ".$limit;
            }
            else if(!$page && !$limit && !$range && $category){
                $query = "SELECT * FROM products WHERE category_id=".$category;
            }
            else if($page && $limit && $range && $category){
                $offset = ($page-1)*$limit;
                $query = "SELECT * FROM products WHERE category_id=".$category." LIMIT ".$offset.", ".$limit;
            }
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                    }
            }
            mysqli_close($conn);
            return $arr;
        }

        function searchProduct($search){
            $query = "SELECT * FROM products WHERE products.picture like '".$search."%' OR products.title like '".$search."%' LIMIT 0,5";
            $conn = connectDB();
            $result = mysqli_query($conn, $query);
            $arr = [];
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr,$row);
                }
            }
            mysqli_close($conn);
            return $arr;
        }
    }

?>