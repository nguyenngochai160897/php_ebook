<?php
    require_once __DIR__."/config/base_url.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title id="head-title">Sách kinh tế</title>

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
    function getProductByCategory(id){
        $.ajax({
            url:"<?php echo base_url();?>api/productByCategory.php?id="+id,
            method:"GET",
            dataType:"json",
        }).done(function(data) {
            console.log(data)
            let html="";
            data.forEach((element, index) => {
                html+='<div class="productcontainer">'+
                            '<div class="motproduct">'+
                                '<div class="products">'+
                                    '<div class="image">'+
                                        '<a href="./chitietsp.php?id='+element.id+'"><img src="<?php echo base_url();?>uploads/'+element.picture+'"></a>'+
                                    '</div>'+
                                    '<div class="productname">'+
                                        '<a href="">'+element.title+'</a>'+
                                    '</div>'+
                                    '<div class="fields">'+
                                         element.author_name+       
                                    '</div>'+
                                    '<div class="prices">'+
                                                 element.price+'₫'+
                                    '</div>'+
                                '</div>'+
                            ' </div>' +
                        ' </div>' ;
            })
            $(".allproducts").html(html)
            $(".category-name").html(data[0].category_name)
            $("#head-title").html(data[0].name)
        })
    }
    $(document).ready(function(){
        
        let id = (GetURLParameter("id"))
		if(id == "" || isNaN(id)){
			//???
		}
		else{
            getProductByCategory(id)
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
                        <li><a href="">Trang chủ</a></li>
                        <!-- <li><a href="">Sách kinh tế</a></li> -->
                        <li class="category-name">Sách kinh tế</li>
                    </ul>
                </div> <!-- het pathway -->
                <div class="block-content">
                    <div class="container">
                        <div class="block">
                            <h1 class = "category-name">Sách kinh tế</h1>
                            <div class="pagesright">

                            </div>
                            <div class="allproducts">
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
                            </div> <!-- het allproduct -->
                        </div> <!-- het block -->
                    </div>
                </div> <!-- het block-content -->
            </div>
        </div>
    </section>
    <?php require_once __DIR__."/footer.php";?>
</body>