<?php
    require_once __DIR__."/config/base_url.php";
    require_once __DIR__."/config/helper.php";
    sessionStart();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chi tiet san pham</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/plugin/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/chitietsp-login-register.css">
    <!-- jQuery -->
    <script src="./assets/plugin/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- My js -->
    <!-- <script src="./assets/js/myjs.js"></script> -->
    <script src="./assets/js/chitietsp.js"></script>

    <!-- OwlCarousel2 -->
    <!-- 	<link rel="stylesheet" type="text/css" href="./assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.css">
	<script src="./assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.js"></script>
 -->
 <?php
        if(isset($_POST['product-title'])){
            if(!isset($_SESSION['product-list'])){
                $_SESSION['product-list']=array();
            }
            
            if(count($_SESSION['product-list']) == 0) {
                 
                $arr = array(
                    "product-id"    => $_GET['id'], 
                    "product-title" => $_POST['product-title'],
                    "product-price" => $_POST['product-price'],
                    "product-picture" => $_POST['product-picture'],
                    "product-amount"=> 1,
                    "product-existed"=>$_POST['product-existed']
                );
                array_push($_SESSION['product-list'], $arr);
            }
            $check = true;
            for($i = 0 ;$i<count($_SESSION['product-list']); $i++){
                if($_SESSION['product-list'][$i]["product-id"] == $_GET['id']){
                    $check=false;
                }
            }
            if($check == true){
                $arr = array(
                    "product-id"    => $_GET['id'], 
                    "product-title" => $_POST['product-title'],
                    "product-price" => $_POST['product-price'],
                    "product-picture" => $_POST['product-picture'],
                    "product-amount"=> 1,
                    "product-existed"=>$_POST['product-existed'],
                );
                array_push($_SESSION['product-list'], $arr);
            }
        }
    ?>
    <script>
    function GetURLParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return sParameterName[1];
            }
        }
    }

    function getProduct(id) {
        $.ajax({
            async: false,
            url: "<?php echo base_url();?>api/product.php?id=" + id,
            method: "GET",
            dataType: "json",
        }).done(function(res) {
            console.log(res.record)
            let data = res.record;
            if (data.length == 0) {
                //San pham ko co san 
                $(".main-detail").css("line-height", "200px")
                $(".main-detail").css("height", "200px")
                $(".main-detail").css("text-align", "center")
                $(".main-detail").html(
                    "<h1 style='line-height: 1.5;display: inline-block;vertical-align: middle;'>San pham khong co san<h1>"
                )
                return;
            }
            data = data[0];
            let path = '<li><a href="./">Trang chủ</a></li>' +
                '<li><a href="./getAllProductByCategory.php?id='+data.category_id+'">' + data.category_name + '</a></li>' +
                '<li>' + data.title + '</li>';
            $(".path").html(path);
            $(".left img").attr("src", "<?php echo base_url();?>uploads/" + data.picture)
            $(".product-infor h1").html(data.title)
            $(".tacgia a").html(data.author_name)
            $(".phathanh a").html(data.publisher_name)
            $(".price").html((data.price) + " ₫")
            $("#noidung p").html(data.description)
            $(".p-image img").attr("src", "<?php echo base_url();?>uploads/" + data.picture)
            $(".p-name a").html(data.title)
            $("input[name='product-title']").val(data.title)
            $("input[name='product-picture']").val(data.picture)
            $("input[name='product-price']").val(data.price)
            $("input[name='product-existed']").val(data.num_existed)
            if(data.num_existed ==0){
                $(".addCart").addClass("d-none");
                $(".goshop h5").removeClass("d-none")
            }
        })
    }
    $("document").ready(function() {
        let id = (GetURLParameter("id"))
        if (id == "") {
            window.location = "<?php echo base_url();?>";
            return;
        } else {
            getProduct(id)
        }
        
    })
    </script>
</head>

<body>
    <?php require_once __DIR__."/header.php";?>
    <section class="main-detail">
        <div class="container">
            <div class="row">
                <div class="pathway">
                    <ul class="path">
                        <li><a href="./">Trang chủ</a></li>
                        <li><a href="#">Văn học nước ngoài</a></li>
                        <li>Khi nhìn lên trời xanh, tớ sẽ rất nhớ cậu</li>
                    </ul>
                </div> <!-- het pathway -->
                <div class="content-detail">
                    <div class="left">
                        <img src="./assets/images/chitiet1.jpg" alt="">
                    </div>
                    <div class="right">
                        <div class="product-infor">
                            <h1>Khi nhìn lên trời xanh, tớ sẽ rất nhớ cậu</h1>
                            <div class="viewfield">
                                <div class="tacgia">
                                    <span>Tác giả: <a href="#"> Septiny</a> </span>
                                </div>
                                <div class="phathanh">
                                    <span>Nhà phát hành: <a href="#"> Người Trẻ Việt</a></span>
                                </div>
                            </div> <!-- het viewfield -->
                            <div class="prices-container">
                                <div class="price">
                                    67.150 ₫
                                </div>
                                <div class="goshop">
                                    <p onclick="muangay()" class="d-none">Mua ngay</p>
                                    <form action="" method="POST">
                                        <input type="text" class="d-none" name="product-title">
                                        <input type="text" class="d-none" name="product-picture">
                                        <input type="text" class="d-none" name="product-price">
                                        <input type="text" class="d-none" name="product-existed">
                                        <button type="submit" class="btn btn-primary addCart"
                                            style="margin-left:200px;margin-top:10px">Thêm giỏ hàng</button>
                                        <h5 style="color:white; border: 1px solid red; background:red; padding: 5px 10px; border-radius: 5px" class="d-none">Hết hàng</h5>
                                    </form>
                                </div>
                            </div> <!-- het prices-container -->
                            <div class="intro">
                                <p><i class=" fa fa-check"></i><span>Bọc Plastic miễn phí </span></p>
                                <p><i class=" fa fa-check"></i><span>Giao hàng miễn phí toàn quốc với mọi đơn
                                        hàng</span></p>
                            </div> <!-- het intro -->
                        </div> <!-- het produce-infor -->
                    </div> <!-- het right -->
                    <div class="clear"></div>

                    <div class="wrapper-black visibility" id="black">
                        <div class="wrapper-box">
                            <div>
                                <p class="info">
                                    Sản phẩm đã được thêm thành công vào giỏ hàng của bạn
                                </p>
                            </div>
                            <div class="product-infor-box">
                                <div class="p-image">
                                    <img src="./assets/images/chitiet1.jpg" alt="">
                                </div>
                                <div class="p-name">
                                    <a href="">Khi nhìn lên trời xanh, tớ sẽ rất nhớ cậu</a>
                                </div>
                                <button onclick="chonthem()">Chọn thêm</button>
                                <a class="thanhtoan" href="./cart.php">Thanh toán</a>
                            </div>
                        </div>
                    </div>

                    <div class="gioithieusach">
                        <div class="gioithieu">
                            <h3>Giới thiệu sách</h3>
                        </div>
                        <div class="noidung collapse1" id="noidung">
                            <p>
                                Chàng trai 17 tuổi năm ấy bạn từng yêu...

                                Là người đã bước đi bên cạnh bạn một quãng đường vừa đủ nhưng ngập tràn hạnh phúc và
                                bình yên. Là người cùng bạn trốn học hay kiên trì chở bạn đi trên chiếc xe đạp cũ kĩ. Là
                                người sẵn sàng nhịn ăn sáng để dành tiền mua cho bạn chiếc cặp tóc mới. Là mối tình đầu
                                trong sáng nhất trong cuộc đời.

                                Chàng trai 17 tuổi năm ấy bạn từng yêu...

                                Là người mà cả đời này bạn sẽ không bao giờ quên nhưng chẳng thể nào đi cùng bạn tới
                                suốt cuộc đời. Dù cả hai đã cùng nhau trải qua thời thanh xuân ngông cuồng tươi đẹp như
                                thế, ở bên nhau vào những ngày tháng học hành thi cử khổ sở nhất như thế. Nhưng sau này
                                lại không thể ở bên nhau nữa.

                                "Cảm ơn cậu đã xuất hiện và ở bên tớ trong những ngày tháng thanh xuân đẹp nhất. Dù sau
                                này, chúng mình chẳng thể cùng nhau đi đến cuối con đường.

                                Tớ nhớ tóc cậu rất mềm, khi cậu cười sẽ có một cái lúm đồng tiền nho nhỏ ở má phải, cậu
                                có một cái máy nghe nhạc cũ màu xanh lá cây, thích ăn bánh bao vào buổi sáng... Khi nhớ
                                được một điều, những điều khác thuộc về cậu cũng nối đuôi nhau xuất hiện, khiến tớ không
                                khỏi cười thầm. Thì ra ngày xưa tớ để ý cậu ấy nhiều đến nỗi như đã học thuộc lòng
                                chúng.

                                Thanh xuân của mỗi người trong chúng ta, ai cũng đã đều bỏ lỡ một ai đó. Bởi vì vào
                                những năm tháng ngốc nghếch trẻ dại ấy, chúng ta còn chưa biết cách yêu một người, chưa
                                học được cách trân trọng. Nhưng tớ rất muốn hỏi một câu tại sao lại là người ấy lại là
                                cậu?"

                                “Khi nhìn lên trời xanh, tớ sẽ rất nhớ cậu" – tập truyện đôi đặc biệt dành tặng tất cả
                                những ai đã, đang và sẽ trải qua tuổi 17 đầy ngọt ngào, trong trẻo nhưng cũng đầy tiếc
                                nuối. Cuốn sách đưa bạn trở lại những tháng ngày thanh xuân đẹp nhất, những ngày không
                                chỉ có những bài Toán giải mãi không ra, những bài Văn viết mãi không hết, những lần
                                trốn học cả lớp đi chơi, mà còn có chàng trai bạn thầm yêu – người bạn không thể quên
                                suốt cả cuộc đời!

                                Này chàng trai năm 17 tuổi, giờ cậu ra sao?
                            </p>
                        </div>
                        <div class="xemthemnoidung" onclick="xemthemnoidung()" id="xemthem">
                            <span>Xem thêm nội dung <i class="fas fa-sort-down"></i></span>
                        </div>
                    </div> <!-- het gioi thieu sach -->
                </div> <!-- het content-detail -->
            </div>
        </div> <!-- het container -->
    </section>
    <?php require_once __DIR__."/footer.php";?>
    
</body>

</html>