<?php
    require_once __DIR__."/config/base_url.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Website mua sách online được yêu thích</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/plugin/bootstrap.min.css">


    <link rel="stylesheet" type="text/css" href="./assets/css/index.css">
    <!-- jQuery -->
    <script src="./assets/plugin/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- My js -->
    <script src="./assets/js/myjs.js"></script>

    <!-- OwlCarousel2 -->
    <link rel="stylesheet" type="text/css" href="./assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.css">
    <script src="./assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.js"></script>
    <style>
    
    </style>
</head>

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

function getBestProduct() {
    $.ajax({
        url: "<?php echo base_url();?>api/product.php?best=",
        dataType: "json",
        method: "GET",
    }).done(function(res) {})
}

function getNewProduct() {
    let html = "";
    $.ajax({
        aynsc: false,
        url: "<?php echo base_url();?>api/product.php",
        dataType: "json",
        method: "GET",
    }).done(function(res) {
        let data = res.records;
        let count = 0;
        for (let i = data.length - 1; i >= 0; i--) {
            count++;
            if (count > 10) break;
            html += '<div class="productcontainer">' +
                '<div class="motproduct">' +
                '<div class="products">' +
                '<div class="image">' +
                '<a href="<?php echo base_url();?>chitietsp.php?id=' + data[i].id +
                '" title=" "><img src="<?php echo base_url();?>uploads/' + data[i].picture + '" alt=""></a>' +
                '</div>' +
                '<div class="productname">' +
                '<a href="<?php echo base_url();?>chitietsp.php?id=' + data[i].id + '">' + data[i].title +
                '</a>' +
                '</div>' +
                '<div class="fields">' + data[i].author_name + '</div>' +
                '<div class="prices">' + data[i].price + ' ₫</div>' +
                '</div>' +
                '</div> ' +
                '</div>';

        }
        $("#slideshows").html(html)
    })
}



$(document).ready(function() {
    getAllCategories();
    getBestProduct();
    getNewProduct();
    
})
</script>

<body>
    <?php require_once __DIR__."/header.php";?>


    <section class="main">
        <div class="container">
            <div class="main-banner">
                <div class="bannerp">
                    <div class="slide" style="max-height: 340px;overflow: hidden;margin-top: 15px;">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <!-- <a href=""><img src="./assets/images/banner1.jpg" alt=""></a> -->
                                <img src="./assets/images/banner1.jpg" alt="">
                            </div>
                            <div class="item">
                                <!-- <a href=""><img src="./assets/images/banner2.jpg" alt=""></a> -->
                                <img src="./assets/images/banner2.jpg" alt="">
                            </div>
                            <div class="item">
                                <img src="./assets/images/banner3.jpg" alt="">
                                <!-- <a href=""><img src="./assets/images/banner3.jpg" alt=""></a> -->
                            </div>
                            <div class="item">
                                <img src="./assets/images/banner4.jpg" alt="">
                                <!-- <a href=""><img src="./assets/images/banner4.jpg" alt=""></a> -->
                            </div>
                            <div class="item">
                                <img src="./assets/images/banner5.jpg" alt="">
                                <!-- <a href=""><img src="./assets/images/banner5.jpg" alt=""></a> -->
                            </div>
                            <div class="item">
                                <img src="./assets/images/banner6.jpg" alt="">
                                <!-- <a href=""><img src="./assets/images/banner6.jpg" alt=""></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- het main-banner -->
            <div class="row">
                <div class="floor1">
                    <div class="title">
                        <h2>
                            <a href="" class="titlecon">Sách mới</a>
                            <i class="fas fa-caret-right"></i>
                            <a href="" class="xemtatca">Xem tất cả</a>
                        </h2>
                    </div> <!-- het title -->
                    <div class="clear" style="clear:both;"></div>

                    <div class="blockcontent">
                        <div class="slideshow" id="slideshows" style="left: 5px; transition: all 0.5s ease 0s;">
                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="./chitietsp.html" title=" "><img src="./assets/images/fl1-1.jpg"
                                                    alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="./chitietsp.html">RE:LIFE - TẬP 5 - TẶNG KÈM POSTCARD</a>
                                        </div>
                                        <div class="fields">
                                            Yayoiso
                                        </div>
                                        <div class="prices">
                                            67.500 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-2.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">CON RỒNG TRONG BỂ KÍNH - CÂU CHUYỆN...</a>
                                        </div>
                                        <div class="fields">
                                            Emily Voigt
                                        </div>
                                        <div class="prices">
                                            104.000 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-3.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">LẶNG YÊN DƯỚI VỰC SÂU</a>
                                        </div>
                                        <div class="fields">
                                            Đỗ Bích Thuý
                                        </div>
                                        <div class="prices">
                                            52.200 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-4.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">SỰ TRẢ THÙ CỦA QUÝ CÔ</a>
                                        </div>
                                        <div class="fields">
                                            Sarah Maclean
                                        </div>
                                        <div class="prices">
                                            108.000 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-5.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">NGƯỜI LÀ THÁNG TƯ CỦA THẾ GIAN</a>
                                        </div>
                                        <div class="fields">
                                            Thanh La Phiến Tử
                                        </div>
                                        <div class="prices">
                                            84.140 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-6.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">RE:LIFE - TẬP 4 - TẶNG KÈM POSTCARD</a>
                                        </div>
                                        <div class="fields">
                                            Yayoiso
                                        </div>
                                        <div class="prices">
                                            67.500 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-7.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">CÔ DÂU PHÁP SƯ - TẬP 10 KÈM BỌC SÁCH</a>
                                        </div>
                                        <div class="fields">
                                            Yamazaki Kore
                                        </div>
                                        <div class="prices">
                                            35.000 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-8.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">ĐẸP TRAI LÀ SỐ 1 </a>
                                        </div>
                                        <div class="fields">
                                            Lục Mang Tinh
                                        </div>
                                        <div class="prices">
                                            159.200 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-9.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">365 NGHỀ: NGÀNH DỊCH VỤ</a>
                                        </div>
                                        <div class="fields">
                                            Á Hải
                                        </div>
                                        <div class="prices">
                                            95.200 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-10.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">365 NGHỀ: NHẤT NGHỆ TINH, NHẤT NGHỆ VINH</a>
                                        </div>
                                        <div class="fields">
                                            Á Hải
                                        </div>
                                        <div class="prices">
                                            96.800 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                        </div> <!-- het slideshow -->
                        <div class="list-btn">
                            <button class="prevbtn" id="prev-slide" onclick="prevslide()"><i
                                    class="fas fa-chevron-left"></i></button>
                            <button class="nextbtn" id="next-slide" onclick="nextslide()"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    </div> <!-- hetblockcontent -->
                </div> <!-- !het floor1 -->

                <div class="floor1  floor2">
                    <div class="title">
                        <h2>
                            <a href="" class="titlecon">Sách bán chạy</a>
                            <i class="fas fa-caret-right"></i>
                            <a href="" class="xemtatca">Xem tất cả</a>
                        </h2>
                    </div> <!-- het title -->
                    <div class="clear" style="clear:both;"></div>

                    <div class="blockcontent">
                        <div class="slideshow">
                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-1.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">RE:LIFE - TẬP 5 - TẶNG KÈM POSTCARD</a>
                                        </div>
                                        <div class="fields">
                                            Yayoiso
                                        </div>
                                        <div class="prices">
                                            67.500 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-2.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">CON RỒNG TRONG BỂ KÍNH - CÂU CHUYỆN...</a>
                                        </div>
                                        <div class="fields">
                                            Emily Voigt
                                        </div>
                                        <div class="prices">
                                            104.000 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-3.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">LẶNG YÊN DƯỚI VỰC SÂU</a>
                                        </div>
                                        <div class="fields">
                                            Đỗ Bích Thuý
                                        </div>
                                        <div class="prices">
                                            52.200 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-4.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">SỰ TRẢ THÙ CỦA QUÝ CÔ</a>
                                        </div>
                                        <div class="fields">
                                            Sarah Maclean
                                        </div>
                                        <div class="prices">
                                            108.000 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-5.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">NGƯỜI LÀ THÁNG TƯ CỦA THẾ GIAN</a>
                                        </div>
                                        <div class="fields">
                                            Thanh La Phiến Tử
                                        </div>
                                        <div class="prices">
                                            84.140 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-6.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">RE:LIFE - TẬP 4 - TẶNG KÈM POSTCARD</a>
                                        </div>
                                        <div class="fields">
                                            Yayoiso
                                        </div>
                                        <div class="prices">
                                            67.500 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-7.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">CÔ DÂU PHÁP SƯ - TẬP 10 KÈM BỌC SÁCH</a>
                                        </div>
                                        <div class="fields">
                                            Yamazaki Kore
                                        </div>
                                        <div class="prices">
                                            35.000 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-8.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">ĐẸP TRAI LÀ SỐ 1 </a>
                                        </div>
                                        <div class="fields">
                                            Lục Mang Tinh
                                        </div>
                                        <div class="prices">
                                            159.200 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-9.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">365 NGHỀ: NGÀNH DỊCH VỤ</a>
                                        </div>
                                        <div class="fields">
                                            Á Hải
                                        </div>
                                        <div class="prices">
                                            95.200 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->

                            <div class="productcontainer">
                                <div class="motproduct">
                                    <div class="products">
                                        <div class="image">
                                            <a href="" title=" "><img src="./assets/images/fl1-10.jpg" alt=""></a>
                                        </div>
                                        <div class="productname">
                                            <a href="">365 NGHỀ: NHẤT NGHỆ TINH, NHẤT NGHỆ VINH</a>
                                        </div>
                                        <div class="fields">
                                            Á Hải
                                        </div>
                                        <div class="prices">
                                            96.800 ₫
                                        </div>
                                    </div>
                                </div> <!-- hetmotproduct -->
                            </div> <!-- het productcontainer -->
                        </div>
                    </div> <!-- hetblockcontent -->
                </div> <!-- !het floor2 -->

                <div class="block-seohome">
                    <h1>
                        <span style="font-size: 16px;font-weight: 700; color: black; font-family: arial">Mua Sách Online
                            Tại Nobita.vn</span>
                    </h1>
                    <p class="nd1" style="font-size: 12px;font-family: arial">
                        Ra đời từ năm 2011, đến nay <strong>Nobita.vn</strong> đã trở thành địa chỉ mua sách online quen
                        thuộc của hàng ngàn độc giả trên cả nước. Với đầu sách phong phú, thuộc các thể loại:
                        <strong>Văn học nước ngoại, Văn học trong nước, Kinh tế, Kỹ năng sống, Thiếu nhi, Sách học ngoại
                            ngữ, Sách chuyên ngành</strong>,... được cập nhật liên tục từ các nhà xuất bản uy tín trong
                        nước.
                    </p>
                    <p class="nd2" style="font-size: 12px; font-family: arial">
                        Khi mua sách online tại Nobita.vn, Quý khách được <strong>Bọc plastic miễn phí đến 99%</strong>
                        (trừ sách bìa cứng, sách dạng hộp - dạng đặc biệt, sách khổ quá to, ...)
                    </p>
                    <p class="nd3" style="font-size: 12px; font-family: arial">
                        Ngoài ra, với hình thức Giao hàng thu tiền tận nơi và Đổi hàng trong vòng 7 ngày nếu sách có bất
                        kỳ lỗi nào trong quá trình in ấn sẽ giúp Quý khách yên tâm hơn khi mua sắm tại Nobita.vn
                    </p>
                </div>
            </div>
        </div> <!-- het container -->
    </section><!--  het main -->

    <?php require_once __DIR__."/footer.php";?>
</body>

</html>