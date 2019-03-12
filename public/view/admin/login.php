<?php require('../../../config/base_url.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script>
        $(document).ready(function () {
            console.log("<?php echo base_url();?>");
            $("#login").on("click", function (e) {
                e.preventDefault()
                // $.ajax({
                //     url: "<?php echo base_url();?>api/admin.controller/getadmin.php",
                //     type: "post",
                //     // data: {
                //     //     email: $("#email").val(),
                //     //     password: $("#password").val()
                //     // }
                    
                // }).done(function (data) {
                   
                // }).fail( function(jqXHR, status){
                //     alert("die")
                // })
                localStorage.setItem("token", "value of token");
                window.location = "<?php echo base_url();?>public/view/admin/";
                
            })
        })

       
    </script>
</head>

<body>
<?php
    setcookie("user", "aaa", time()+10);
?>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <div class="alert alert-danger" role="alert" style = "display: none">
                This is a danger alert—check it out!
            </div>
            <button type="submit" class="btn btn-primary" id = "login">Login</button>
        </form>
    </div>
        
</body>

</html>