<?php
    require_once __DIR__."/config/base_url.php";
    require_once __DIR__."/config/helper.php";
    sessionStart();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/plugin/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/chitietsp-login-register.css">
    <!-- jQuery -->
    <script src="./assets/plugin/jquery-3.3.1.min.js"></script>
    <script src="./assets/js/chitietsp.js"></script>
    <style>
    .increase {
        font-size: 16px;
        padding: 0 2px
    }

    .decrease {
        font-size: 17px;
        padding: 0 4px;
    }
    </style>
</head>
    
    <?php
        function getAllTotal(){
            $total=0;
            if(count($_SESSION['product-list'])>0){
                for($i = 0; $i< count($_SESSION['product-list']); $i++){
                    $total+=$_SESSION['product-list'][$i]['product-price']*$_SESSION['product-list'][$i]['product-amount'];
                }
            }
            return $total;
        }
        
        if(isset($_POST['decrease'])){
            for($i = 0; $i< count($_SESSION['product-list']); $i++){
                if($_POST['product-id']==$_SESSION['product-list'][$i]['product-id']){
                    $_SESSION['product-list'][$i]['product-amount']=$_SESSION['product-list'][$i]['product-amount']-1;
                    if($_SESSION['product-list'][$i]['product-amount']<=0){
                        array_splice($_SESSION['product-list'], $i, 1);
                    }
                }
            }
        }
        if(isset($_POST['increase'])){
            for($i = 0; $i< count($_SESSION['product-list']); $i++){
                if($_POST['product-id']==$_SESSION['product-list'][$i]['product-id']){
                    $_SESSION['product-list'][$i]['product-amount']=$_SESSION['product-list'][$i]['product-amount']+1;
                    if($_SESSION['product-list'][$i]['product-amount']>$_SESSION['product-list'][$i]['product-existed']){
                        $_SESSION['product-list'][$i]['product-amount']=$_SESSION['product-list'][$i]['product-existed'];
                        echo "<script>alert('So luong mat hang chi con".$_SESSION['product-list'][$i]['product-existed']."')</script>";
                    }
                }
            }
        }
    ?>
    <?php
        if(isset($_POST['xoahet'])){
            array_splice($_SESSION['product-list'], 0, count($_SESSION['product-list']));
        }
    ?>
<body>
    <?php require_once __DIR__."/header.php";?>

    <section class="cart">
        <div class="container">
            <div class="giohang">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							$html="";
							if(isset($_SESSION['product-list'])){
								for($i = 0 ;$i < count($_SESSION['product-list']); $i++){
                                    $html.=	
                                            '<tr>'.
                                            '<form action="" method="post">'.
                                                '<input class="d-none" type="text" name="product-id" value="'.$_SESSION['product-list'][$i]['product-id'].'">'.
                                                '<input class="d-none" type="text" name="product-amount" value="'.$_SESSION['product-list'][$i]['product-amount'].'">'.
												'<th scope="row" class="product-id">'.$_SESSION['product-list'][$i]['product-id'].'</th>'.
												'<td><img style="width: 20%;height: 20%" src="'.base_url().'uploads/'.$_SESSION['product-list'][$i]['product-picture'].'" alt=""></td>'.
												'<td>'.$_SESSION['product-list'][$i]['product-title'].'</td>'.
												'<td class="cart-price" style="text-align: center">'.$_SESSION['product-list'][$i]['product-price'].'</td>'.
                                                '<td>'.
                                                    '<button type="submit" name="decrease" class="decrease btn btn-primary">-</button>
                                                    <input disabled name="input-product-amount" style="width: 40px; height: 40px; margin-left: 5px" type="text" value='.$_SESSION['product-list'][$i]['product-amount'].'>
                                                    <button type="submit" name="increase" value="+" class="increase btn btn-primary">+</button>'.
                                                '</td>'.
												'<td class="product-total">'.$_SESSION['product-list'][$i]['product-price']*$_SESSION['product-list'][$i]['product-amount'].'</td>'.
                                            '</form>'.
                                            '</tr>';
								}
								echo $html;
							}
						?>
                        <!-- <tr>
                            <form action="" method="post">
                                <th scope="row">1</th>
                                <td><img style="width: 20%;height: 20%" src="./assets/images/chitiet1.jpg" alt=""></td>
                                <td>Khi nhìn lên trời xanh, tớ sẽ rất nhớ cậu</td>
                                <td class="cart-price" style="text-align: center">67.150</td>
                                <td>
                                    <button type="submit" class="decrease btn btn-primary">-</button>
                                    <input style="width: 40px; height: 40px; margin-left: 5px" type="text">
                                    <button type="submit" value="+" class="increase btn btn-primary">+</button>
                                </td>
                                <td></td>
                            </form>
                        </tr> -->

                    </tbody>
                </table>
            </div>
            <a href="./" class="chonthem">Chọn thêm</a>
            <!-- <button class="capnhatgiohang" type="submit" name="capnhat">Cập nhật giỏ hàng</button> -->
            <form action="" method="POST">
                <button class="xoahetgiohang" type="submit" name="xoahet">Xoá hết giỏ hàng</button>
            </form>
            <div class="clear"></div>
            <div class="tongtien">
                <div class="title-giohang">Giỏ Hàng</div>
                <div class="tongsotien">
                    <strong>Tổng Số Tiền</strong>
                    <strong id="total"><?php echo getAllTotal();?> ₫</strong>
                </div>
                <div class="clear"> </div>
                <div class="form-left">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                            value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Thanh toán khi nhận hàng
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                            value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Thanh toán qua thẻ visa
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                            value="option3" checked>
                        <label class="form-check-label" for="exampleRadios3">
                            Thanh toán qua ....
                        </label>
                    </div>
                </div>
                <div class="form-right">
                    <form action="post">
                        <div class="field">
                            <div class="textlabel">
                                <label for="diachi">Địa chỉ nhận hàng:</label>
                            </div>
                            <input type="text" name="diachi" id="diachi">
                        </div>

                        <div class="field">
                            <div class="textlabel">
                                <label for="sdt">Số điện thoại:</label>
                            </div>
                            <input type="text" name="sdt" id="sdt">
                        </div>

                        <div class="field">
                            <div class="textlabel">
                                <label for="mail">Email:</label>
                            </div>
                            <input type="text" name="email" id="email">
                        </div>
                    </form>
                </div>
                <div class="clear"></div>
                <div class="xacnhan">Xác nhận</div>
            </div>
        </div>
    </section>
    <div class="clear"></div>
    <?php 
		require_once __DIR__."/footer.php";
	?>

</body>