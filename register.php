<?php
    require_once __DIR__."/config/base_url.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>

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
    function register(user) {
        let temp = ""
        $.ajax({
            async: false,
            url: "<?php echo base_url();?>api/user.php",
            method: "POST",
            dataType: "json",
            data: {
                email: user.email,
                password: user.password,
                first_name: user.first_name,
                last_name: user.last_name,
                phone: user.phone,
                address: user.address
            }
        }).done(function(res) {
            temp = res;
        })
        return temp;
    }

    function requireForm(user) {
        console.log(user)
        if (user.email == "") {
            $("#email-valid").html("Email là bắt buộc")
        } else {
            if (!validateEmail(user.email)) {
                $("#email-valid").html("Sai định dạng email")
            } else {
                $("#email-valid").html("")
            }
        }
        if (user.password == "") {
            $("#psw-valid").html("Mật khẩu là bắt buộc")
        } else {
            $("#psw-valid").html("")
        }
        if ($("#idconfirmpass").val() == "") {
            $("#confirmpsw-valid").html("Xác nhận mật khẩu là cần thiết")
        } else {
            $("#confirmpsw-valid").html("")
        }
        if ($("#idconfirmpass").val() != user.password) {
            $("#confirmpsw-valid").html("Mật khảu không khớp")
        } else {
            $("#confirmpsw-valid").html("")
        }

    }

    function validateEmail(email) {
        var re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    $(document).ready(function() {
        $("#btn-register").on("click", function(e) {
            let user = {
                first_name: $("#idfirstN").val(),
                last_name: $('#idlastN').val(),
                phone: $('#idphone').val(),
                address: $('#idaddress').val(),
                email: $('#idemail').val(),
                password: $('#idpassword').val()
            }
            console.log(user)
            e.preventDefault();
            requireForm(user)
            let data = register(user)
            if (data.status == "success") {
                alert("Đăng ký thành công")
				$("#email-valid").html("")
                window.location = "<?php echo base_url();?>login.php"

            }
			else{
                if(data.message!="invalid input")
				    $("#email-valid").html("Email đã tồn tại")
			}
        })
    })
    </script>
</head>

<body>
    <?php require_once __DIR__."/header.php";?>
    <section class="main-login">
        <div class="container">
            <h1>Đăng ký <span>hoặc</span> <a href="./login.php">Đăng nhập</a></h1>
            <div class="block-content">
                <div class="login-form">
                    <h3>Thông tin cá nhân</h3>
                    <form>
                        <div class="field">
                            <div class="textlabel">
                                <label for="idfirstN">First Name</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="text" id="idfirstN">
                        </div>

                        <div class="field">
                            <div class="textlabel">
                                <label for="idlastN">Last Name</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="text" id="idlastN">
                        </div>

                        <div class="field">
                            <div class="textlabel">
                                <label for="idphone">Phone</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="text" id="idphone">
                        </div>

                        <div class="field">
                            <div class="textlabel">
                                <label for="idaddress">Address</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="text" id="idaddress">
                            <div class="help">
                                <span></span>
                            </div>
                        </div>

                        <h3>Thông tin đăng nhập</h3>

                        <div class="field">
                            <div class="textlabel">
                                <label for="idemail">Email</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="text" id="idemail">
                            <div class="help">
                                <span id="email-valid" style="color:red"></span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="textlabel">
                                <label for="idpassword">Mật khẩu</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="password" id="idpassword">
                            <div class="help">
                                <span id="psw-valid" style="color:red"></span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="textlabel">
                                <label>Xác nhận mật khẩu</label>
                                <span class="required">*</span>:
                            </div>
                            <input type="password" id="idconfirmpass">
                            <div class="help">
                                <span id="confirmpsw-valid" style="color:red"></span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="submit">
                                <input class="dangky" type="submit" value="Đăng ký" id="btn-register">
                            </div>
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