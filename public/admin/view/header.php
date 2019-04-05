<?php
    require __DIR__."/../../../config/base_url.php";
    require_once __DIR__."/../../../config/helper.php";
    sessionStart(); 
    if(!isset($_SESSION['login']) || $_SESSION['login'] != "admin"){
        header("Location: login.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Management</title>


    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>public/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>public/admin/css/datatable.min.css">
    <style>
        h3 {
            border-bottom: 1px solid rgb(187, 184, 184)
        }
        table {
            position: relative;
        }

        .btn-add {
            position: absolute;
            top: 2rem;
            right: 3rem
        }
    </style>
    <script src="<?php echo base_url();?>public/js/jquery.js"></script>
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/admin/js/datatable.min.js"></script>
    
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Administrator</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="signout.php">Sign out</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <h3>
                            <li class="nav-item">
                                <a class="nav-link dashboard" href="index.php">
                                    Dashboard
                                </a>
                            </li>
                        </h3>
                        <li class="nav-item">
                            <h3>
                                <a class="nav-link trans" href="transaction.php">
                                    Transaction
                                </a>
                            </h3>
                        </li>
                        <li class="nav-item">
                            <h3>
                                <a class="nav-link product" href="product.php">
                                    Product
                                </a>
                            </h3>
                        </li>
                        <li class="nav-item">
                            <h3>
                                <a class="nav-link category" href="category.php">
                                    Category
                                </a>
                            </h3>
                        </li>
                    </ul>
                </div>
            </nav>

       