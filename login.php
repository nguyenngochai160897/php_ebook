<?php
    require_once __DIR__."/config/base_url.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/plugin/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="./assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/chitietsp-login-register.css">
    <!-- jQuery -->
    <script src="./assets/plugin/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


    <link rel="shortcut icon" href="http://nobita.vn/layouts/fontpage/images/favicon.ico">


    <!-- My js -->
    <!-- <script src="./assets/js/myjs.js"></script> -->
    <script src="./assets/js/chitietsp.js"></script>

    <!-- OwlCarousel2 -->
    <!-- 	<link rel="stylesheet" type="text/css" href="./assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.css">
	<script src="./assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.js"></script>
 -->

</head>
<script>
function requireForm(user) {
    if (user.email == "") {
        $("#email-valid").html("Email là bắt buộc")
    } else {

        $("#email-valid").html("")
    }
    if (user.password == "") {
        $("#psw-valid").html("Mật khẩu là bắt buộc")
    } else {
        $("#psw-valid").html("")
    }
}

function login(user){
    let temp;
    $.ajax({
        async:false,
        url:"<?php echo base_url();?>api/user.login.php",
        method:"POST",
        data:{
            email:user.email,
            password:user.password,
        },
        dataType:"json",
    }).done((res) => {
        temp = res;
    })
    return temp;
}
$(document).ready(function() {
    $("#btn-login").on("click", function(e) {
        e.preventDefault();
        let user = {
            email: $('#idemail').val(),
            password: $('#idpassword').val()
        }
        requireForm(user)
        let data = login(user)
        if (data.status == "success") {
            alert("Dang nhap thành công")
            window.location = "<?php echo base_url();?>"
        } else {
            if(data.message!="invalid input"){
                alert("Sai thong tin dang nhap")
            }
        }
    })
})
</script>

<body>
    
    <?php require_once __DIR__."/header.php";?>
    <section class="main-login">
        <div class="container">
            <h1>Đăng nhập <span>hoặc</span> <a href="./register.php">Đăng ký</a></h1>
            <div class="block-content">
                <div class="login-form">
                    <h3>Đăng nhập bằng tài khoản Nobita</h3>
                    <form>
                        <div class="field">
                            <div class="textlabel">
                                <label for="idemail">Email</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="text" name="email" id="idemail">
                            <div class="help">
                                <span id="email-valid"></span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="textlabel">
                                <label for="idpassword">Mật khẩu</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="password" name="password" id="idpassword">
                            <div class="help">
                                <span id="psw-valid"></span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="submit">
                                <input type="submit" value="Đăng nhập" id="btn-login">
                            </div>
                            <a class="taotaikhoan" href="./register.php"><i>Tạo tài khoản</i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="clear"></div>
    <?php require_once __DIR__."/footer.php";?>

</body>

</html>