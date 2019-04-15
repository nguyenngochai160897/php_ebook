<?php
    require_once __DIR__."/config/helper.php";
    require_once __DIR__."/api/model/user.php";
    require_once __DIR__."/api/controller/user.php";
    sessionStart();
    
    function showAmountCart(){
        $amount=0;
        if(isset($_SESSION['product-list'])){
            $amount=count($_SESSION['product-list']);
        }
        return $amount;
    }
    function showSmallCart(){
        $html="";
        if(isset($_SESSION['product-list'])){
            foreach($_SESSION['product-list'] as $product){
                $html.='<a class="row" href="./chitietsp.php?id='.$product['product-id'].'">'.
                            '<img src="./uploads/'.$product['product-picture'].'" class="col-3">'.
                            '<div class="row col-9" >'.
                                '<p class="title">'.$product['product-title'].'</p>'.
                                '<p class="price">'.$product['product-price'].' ₫</p>'.
                            '</div>'.
                        '</a>'
                        ;
            }
        }
        else{
            
        }
        return $html;
    }
    function checkLogin(){
        $html = '<a href="./login.php" title="" class="login"><i class="fa fa-user text-18"></i><span>Đăng nhập</span></a>';
        sessionStart();
        if (checkSession() == "customer"){
            $data = (new user())->gets();
            foreach($data as $d){
                if ($d['id'] == $_SESSION['userId']) 
                    $user = $d;
            }
            
            $html = '<i class="fa fa-user text-18"></i> '.$user['first_name'].' '.$user['last_name'].'      <a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span></a>';
        }
        return $html;
    }
  
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="header">
    <div class="top-header">
        <div class="container">
            <div class="row topbar">
                <div class="col-3">
                    <div class="logo">
                        <a href="./">
                            <img src="./assets/images/logo.png" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-6" id="search-form">
                    <form>
                        <input type="text" name="seach" id="search" class="form-control ttimkiem">
                        <input type="submit" class="btntimkiem form-control" name="btntimkiem" value="Tìm">
                    </form>
                    <div class="list-group position-absolute d-none" id="show-search-product">
                        <!-- <div class="small-product">
                            <a href="#" class="row">
                                <div class="col-2 image">
                                    <img src="<?php echo base_url();?>uploads/21-chien-luoc-marketing-hang-dau__74151_thum_135.jpg"
                                        title="something">
                                </div>
                                <div class="col-8 info">
                                    <div class="title">
                                        Ten san pham fdsgffgtr ytrytrhtyyhyh rerrre ererererww
                                    </div>
                                    <span class="prices">95.200 ₫</span>
                                </div>
                            </a>
                        </div> -->
                    </div>
                </div>

                <div class="col-3">
                    <div class="login" style="padding-left: 0px">
                        <?php echo checkLogin(); ?>
                        <a href="./cart.php" title="" class="giohang">Giỏ hàng <span>(<?php echo showAmountCart();?>)</span><i
                                class="fas fa-sort-down"></i></a>
                        <div id="show-small-shop-cart" class="position-absolute p-1">
                            <!-- <a class="row" href="#">
                                <img src="<?php echo base_url();?>uploads/21-chien-luoc-marketing-hang-dau__74151_thum_135.jpg" class="col-3">
                                <div class="row col-10" >
                                    <p class="title">Tensalgjjfgfgjfogjggoghgfugghfgfhklfhu</p>
                                    <p class="price">kfhgkfdughf ₫</p>
                                </div>
                            </a>
                            <hr>
                            <a class="row" href="#">
                                <img src="<?php echo base_url();?>uploads/21-chien-luoc-marketing-hang-dau__74151_thum_135.jpg" class="col-3">
                                <div class="row col-10" >
                                    <p class="title">Tensalgjjfgfgjfogjggoghgfugghfgfhklfhu</p>
                                    <p class="price">kfhgkfdughf ₫</p>
                                </div>
                            </a> -->
                            <?php echo showSmallCart();?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="bottom-header">
        <div class="container">
            <div class="row">
                <div class="main-menu">
                    <span>
                        <h2 class="danhmuc">
                            <i class="fas fa-bars"></i>
                            DANH MỤC SẢN PHẨM
                        </h2>
                    </span>
                    <ul class="list">
                        <!-- <li>
								<span><a href=""><b>Nổi bật</b></a></span>
								<ul class="list-child">
									<li><a href="">Sách bán chạy</a></li>
									<li><a href="">Sách mới</a></li>
									<li><a href="">Sắp phát hành</a></li>
									<li><a href="">Sách giảm giá</a></li>
								</ul>
							</li> -->
                        <li><span><a href="">Sách kinh tế</a></span></li>
                        <li><span><a href="">Văn học nước ngoài</a></span></li>
                        <li><span><a href="">Văn học trong nước</a></span></li>
                        <li><span><a href="">Sách kỹ năng sống</a></span></li>
                        <li><span><a href="">Sách tuổi teen</a></span></li>
                        <li><span><a href="">Học ngoại ngữ</a></span></li>
                        <li><span><a href="">Sách thiếu nhi</a></span></li>
                        <li><span><a href="">Thương thức đời sống</a></span></li>
                        <li><span><a href="">Sách chuyên ngành</a></span></li>
                        <li><span><a href="">Văn Phòng Phẩm - Quà Tặng</a></span></li>
                    </ul>
                </div>
                <div class="hotline">
                    <i class="fas fa-phone"></i>
                    <span class="hline">Hotline:</span>
                    <span class="sdt">0123456798</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function getAllCategories() {
    $.ajax({
        url: "<?php echo base_url();?>api/category.php",
        method: "GET",
        dataType: "json",
    }).done(function(res) {
        let i = res.records.length - 1;
        let data = res.records;
        let html = "";
        while (i >= 0) {
            html += '<li><span><a href="getAllProductByCategory.php?id=' + data[i].id + '">' + data[i].name +
                '</a></span></li>'
            i--;
        }
        $(".list").html(html)
    })
}

function searchProduct(value) {
    $.ajax({
        url: "<?php echo base_url();?>/api/product.option.php?search=" + value,
        method: "GET",
        dataType: "json"
    }).done(function(res) {
        let html = "";
        if (res.length == 0) {
            $("#show-search-product").addClass("d-none")
        } else {
            console.log(res)
            $("#show-search-product").removeClass("d-none")
            res.forEach(function(element, index) {
                html += '<div class="small-product">' +
                    '<a href="#" class="row">' +
                    '<div class="col-2 image">' +
                    '<img src="<?php echo base_url();?>uploads/' + element.picture + '"/>' +
                    '</div>' +
                    '<div class="col-8 info">' +
                    '<div class="title">' +
                    element.title +
                    '</div>' +
                    '<span>' + element.price + '₫</span>' +
                    '</div>' +
                    '</a>' +
                    '</div>';
            })
            $("#show-search-product").html(html)
        }
    })
}

$(document).ready(function() {
    getAllCategories();
     
    $(".btntimkiem").on("click", function(e) {
        e.preventDefault();
        let search = $("#search").val();
        if (search == "") {
            alert("Nhập từ khóa tìm kiếm");
            $("#show-search-product").addClass("d-none")
            return;
        }
        searchProduct(search);
    })

    $("#search").on("keyup", function() {
        let search = $(this).val();
        if (search != "") {
            console.log(search)
            searchProduct(search);
        } else {
            $("#show-search-product").addClass("d-none")
        }
    })
})
</script>