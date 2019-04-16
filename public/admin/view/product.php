<?php
    require_once __DIR__."/header.php";
?>

<script>
$(".product").addClass("active")
let pageCurrent = 1,
    limit = 3,
    range = 3;
let pageTotal;


function getAllProduct() {
    // return new Promise((resolve) => {
    //     resolve(
            $.ajax({
                async:false,
                url: "<?php echo base_url();?>api/product.php",
                method: "GET",
                dataType: "json",
                success: function(res) {
                   
                    pageTotal = Math.ceil(res.records.length / limit);
                    // let html = ""
                    // let srcImg = "<?php echo base_url();?>uploads/";
                    // for (let i = 0; i < data.length; i++) {
                    //     html += "<tr>" +
                    //         '<td class="align-middle">' + data[i].id + '</td>' +
                    //         ' <td>' +
                    //         '<img src="' + srcImg + data[i].picture + '" class="img-thumbnail">' +
                    //         ' </td>' +
                    //         '<td class="align-middle">' + data[i].title + '</td>' +
                    //         '<td class="align-middle">' + data[i].num_existed + '</td>' +
                    //         '<td class="align-middle">' + data[i].price + 'VND</td>' +
                    //         '<td class="align-middle">' + data[i].category_name + '</td>' +
                    //         '<td class="align-middle">' +
                    //         '<button class="btn btn-danger" id="' + data[i].id + '">Delete</button>' +
                    //         '<div class="dropdown-divider"></div>' +
                    //         '<button class="btn btn-success btn-update" data-toggle="modal" id="' + data[i].id +
                    //         '"' +
                    //         ' data-target="#updateModal">Update</button>' +
                    //         '</td>' +
                    //         '</tr>';
                    // }
                    // $(".body-product").html(html);
                }
            })

        // )
    // })
}

function pagination() {
    // return new Promise((resolve) => {
    //     resolve(
            $.ajax({
                url: "<?php echo base_url();?>/api/product.option.php",
                method: "POST",
                dataType: "json",
                data: {
                    page: pageCurrent,
                    limit: limit,
                    range: range
                },
                success: function(data) {
                    let srcImg = "<?php echo base_url();?>uploads/";
                    let html = "";
                    // data=data.records
                    for (let i = 0; i < data.length; i++) {
                        html += "<tr>" +
                            '<td class="align-middle">' + data[i].id + '</td>' +
                            ' <td>' +
                            '<img src="' + srcImg + data[i].picture + '" class="img-thumbnail">' +
                            ' </td>' +
                            '<td class="align-middle">' + data[i].title + '</td>' +
                            '<td class="align-middle">' + data[i].num_existed + '</td>' +
                            '<td class="align-middle">' + data[i].price + 'VND</td>' +
                            '<td class="align-middle">' + data[i].category_name + '</td>' +
                            '<td class="align-middle">' +
                            '<button class="btn btn-danger" id="' + data[i].id +
                            '">Delete</button>' +
                            '<div class="dropdown-divider"></div>' +
                            '<button class="btn btn-success btn-update" data-toggle="modal" id="' +
                            data[i].id +
                            '"' +
                            ' data-target="#updateModal">Update</button>' +
                            '</td>' +
                            '</tr>';
                    }
                    $(".body-product").html(html);
                }
            })
            // )
    // })
}

function showPagination() {
    let min, max;
    if (range > pageTotal) {
        min = 1;
        max = pageTotal;
    } else {
        var mid = 3;
        console.log("pageCurrent", pageCurrent)
        min = pageCurrent - mid + 1;
        max = pageCurrent + mid - 1;
        console.log("min1:", min)
        console.log("max1:", max)
        if (min < 1) {
            min = 1;
            max = range;
            console.log("2")
        } else if (max > pageTotal) {
            max = pageTotal;
            min = pageTotal - range;
            console.log("3")
        }
    }
    let html = "";
    if (pageCurrent > 1) {
        html += '<li class="page-item"><button class="page-link" id="' + (pageCurrent - 1) +
            '">Previous</button></li>';
    }

    for (let i = min; i <= max; i++) {
        if (i == pageCurrent) {
            html += '<li class="page-item"><button class="btn btn-primary" id="' + i + '">' + i +
                '</button></li>';
        } else {
            html += '<li class="page-item"><button class="page-link" id="' + i + '">' + i +
                '</button></li>';
        }
    }
    if (pageCurrent < pageTotal) {
        html += '<li class="page-item"><button class="page-link" id="' + (pageCurrent + 1) +
            '">Next</button></li>';
    }
    $(".pagination").html(html)

}

function getAllCategory() {
    let html = "";
    $.ajax({
        async: false,
        url: "<?php echo base_url();?>api/category.php",
        method: "GET",
        dataType: "json",
        success: function(res) {
            let data = res.records;
            for (let i = 0; i < data.length; i++) {
                html += '<option value="' + data[i].name + '" id="' + data[i].id + '">' + data[i].name +
                    '</option>';
            }
            $(".select-category").html(html)
        }
    })
}

function addProduct(product) {
    let data = "";
    let form_data = new FormData();
    form_data.append("category_id", product.category_id);
    form_data.append("title", product.title);
    form_data.append("publisher_name", product.publisher_name);
    form_data.append("author_name", product.author_name);
    form_data.append("publish_year", product.publish_year);
    form_data.append("price", (product.price));
    form_data.append("description", product.description);
    form_data.append("num_existed", (product.num_existed));
    form_data.append("picture", product.picture);

    $.ajax({
        async: false,
        url: "<?php echo base_url();?>api/product.php",
        method: "POST",
        data: form_data,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(res) {
            data = res;
        }
    })
    return data;
}

function deleteProduct(id) {

    $.ajax({
        url: "<?php echo base_url();?>api/product.php",
        method: "DELETE",
        dataType: "json",
        data: {
            id: id,
        },
        success: function(res) {
            if (res.status == "review") {
                alert("Can not delete this product!!!");
            }

        }
    })
}

function editProduct(product) {
    let data = "";
    let form_data = new FormData();
    form_data.append("id", product.id);
    form_data.append("category_id", product.category_id);
    form_data.append("title", product.title);
    form_data.append("publisher_name", product.publisher_name);
    form_data.append("author_name", product.author_name);
    form_data.append("publish_year", product.publish_year);
    form_data.append("price", (product.price));
    form_data.append("description", product.description);
    form_data.append("num_existed", (product.num_existed));
    form_data.append("picture", product.picture);
    $.ajax({
        async: false,
        url: "<?php echo base_url();?>api/product.update.php",
        method: "POST",
        data: form_data,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(res) {
            if (res.status == "fail") {
                $(".alert-picture-update").show();
                $(".alert-picture-update").html(res.message);
            } else {
                $(".alert-picture-update").hide();
            }
        }
    })
}

function validateFormAdd() {
    if ($("#title-add").val() == "") {
        $("#title-add").focus()
        $(".alert-title-add").show();
        return false;
    } else {
        $(".alert-title-add").hide();
    }

    if ($("#publisher-add").val() == "") {
        $("#publisher-add").focus()
        $(".alert-publisher-add").show();
        return false;
    } else {
        $(".alert-publisher-add").hide();
    }

    if ($("#author-add").val() == "") {
        $("#author-add").focus()
        $(".alert-author-add").show();
        return false;
    } else {
        $(".alert-author-add").hide();
    }

    if ($("#year-add").val() == "") {
        $("#year-add").focus()
        $(".alert-year-add").show();
        return false;
    } else {
        $(".alert-year-add").hide();
    }

    if ($("#price-add").val() == "" || isNaN(parseFloat($("#price-add").val()))) {
        $("#price-add").focus()
        $(".alert-price-add").show();
        return false;
    } else {
        $(".alert-price-add").hide();
    }

    if ($("#amount-add").val() == "" || !Number.isInteger(parseFloat($("#amount-add").val()))) {
        $("#amount-add").focus()
        $(".alert-amount-add").show();
        return false;
    } else {
        $(".alert-amount-add").hide();
    }

    if ($("#description-add").val() == "") {
        $("#description-add").focus()
        $(".alert-description-add").show();
        return false;
    } else {
        $(".alert-description-add").hide();
    }

    return true;
}

function validateFormUpdate() {
    if ($("#title-update").val() == "") {
        $("#title-update").focus()
        $(".alert-title-update").show();
        return false;
    } else {
        $(".alert-title-update").hide();
    }

    if ($("#publisher-update").val() == "") {
        $("#publisher-update").focus()
        $(".alert-publisher-update").show();
        return false;
    } else {
        $(".alert-publisher-update").hide();
    }

    if ($("#author-update").val() == "") {
        $("#author-update").focus()
        $(".alert-author-update").show();
        return false;
    } else {
        $(".alert-author-update").hide();
    }

    if ($("#year-update").val() == "") {
        $("#year-update").focus()
        $(".alert-year-update").show();
        return false;
    } else {
        $(".alert-year-update").hide();
    }

    if ($("#price-update").val() == "" || isNaN(parseFloat($("#price-update").val()))) {
        $("#price-update").focus()
        $(".alert-price-update").show();
        return false;
    } else {
        $(".alert-price-update").hide();
    }

    if ($("#amount-update").val() == "" || !Number.isInteger(parseFloat($("#amount-update").val()))) {
        $("#amount-update").focus()
        $(".alert-amount-update").show();
        return false;
    } else {
        $(".alert-amount-update").hide();
    }

    if ($("#description-update").val() == "") {
        $("#description-update").focus()
        $(".alert-description-update").show();
        return false;
    } else {
        $(".alert-description-update").hide();
    }

    return true;
}

function getProduct(id) {
    let src = "<?php echo base_url();?>uploads/";
    $.ajax({
        url: "<?php echo base_url();?>api/product.php?id=" + id,
        method: "GET",
        dataType: "json",
        success: function(res) {
            console.log("ree")
            let data = res.record[0];
            $("#id-update").val(data.id)
            $("#title-update").val(data.title)
            $("#picture-name-update").html(data.picture)
            $("#publisher-update").val(data.publisher_name)
            $("#author-update").val(data.author_name)
            $("#year-update").val(data.publish_year)
            $("#price-update").val(data.price)
            $("#amount-update").val(data.num_existed);
            $("#category-update").val(data.category_name)
            $("#description-update").val(data.description)
            $("#image_upload_preview").attr("src", src + data.picture)
        }
    })
}

function show() {
    getAllProduct();
    pagination();
    showPagination()
}

$(document).ready(function() {
    $(".alert").hide();

    getAllCategory();
    show();

    $("#picture-update").on("change", function() {
        $("#picture-name-update").html($(this)[0].files[0].name)
    })

    $(".submit-add").on("click", function(e) {
        e.preventDefault();
        if (validateFormAdd()) {
            let product = {
                category_id: $("#category-add").children(":selected").attr("id"),
                title: $("#title-add").val(),
                publisher_name: $("#publisher-add").val(),
                author_name: $("#author-add").val(),
                publish_year: $("#year-add").val(),
                price: parseFloat($("#price-add").val()),
                description: $("#description-add").val(),
                num_existed: parseInt($("#amount-add").val()),
                picture: $("#picture-add").prop("files")[0]
            }
            let data = addProduct(product)
            if (data.status == "fail") {
                $(".alert-picture-add").html(data.message)
                $(".alert-picture-add").show()
            } else {
                $(".alert-picture-add").hide()
                $("#title-add").val("");
                $("#publisher-add").val("");
                $("#year-add").val("");
                $("#price-add").val("");
                $("#description-add").val("");
                $("#amount-add").val("");
                $("#category-add").find('option:first').attr('selected', 'selected');
                $("#author-add").val("");
                $("#picture-add").val("")
                $("#image_upload_preview_add").attr("src", "");
                getAllProduct()
            }
        }
    })

    $(".body-product").on("click", ".btn-danger", function() {
        let product_id = $(this).attr("id");
        if (window.confirm("Do you want to delete product with id : " + product_id)) {
            deleteProduct(product_id)
            getAllProduct();
        }
    })

    $(".body-product").on("click", ".btn-update", function() {
        let product_id = $(this).attr("id")
        getProduct(product_id)
    })

    $(".submit-update").on("click", function(e) {
        e.preventDefault();
        if (validateFormUpdate()) {
            let product = {
                id: $("#id-update").val(),
                category_id: $("#category-update").children(":selected").attr("id"),
                title: $("#title-update").val(),
                publisher_name: $("#publisher-update").val(),
                author_name: $("#author-update").val(),
                publish_year: $("#year-update").val(),
                price: parseFloat($("#price-update").val()),
                description: $("#description-update").val(),
                num_existed: parseInt($("#amount-update").val()),
                picture: $("#picture-update").prop("files")[0]
            }
            console.log(product)
            editProduct(product);
            getAllProduct()
            $("#updateModal").modal("hide");
            alert("Update success");
        }

    })

    $(".pagination").on("click", ".page-link", function() {
        pageCurrent = parseInt($(this).attr("id"))
        show()
    })
})
</script>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 mt-5">
    <h4>
        Product
    </h4>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-add" data-toggle="modal" data-target="#exampleModal">
        NEW ADD
    </button>

    <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New add a product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Product'title" id="title-add">
                                <div class="alert alert-danger alert-title-add" role="alert">
                                    Title is required
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label>Choose file</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture-add">
                                    <label class="custom-file-label" for="customFile">File</label>
                                </div>
                                <div class="alert alert-danger alert-picture-add py-0" role="alert">
                                    File is required
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-3 position-absolute" style="right:1rem; top:1rem">
                            <img alt="" class="img-thumbnail" id="image_upload_preview_add">
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Publisher Name</label>
                                <input type="text" class="form-control" placeholder="Publisher" id="publisher-add">
                                <div class="alert alert-danger alert-publisher-add" role="alert">
                                    Publisher is required
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Author Name</label>
                                <input type="text" class="form-control" placeholder="Author" id="author-add">
                                <div class="alert alert-danger alert-author-add" role="alert">
                                    Author is required
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Publish Year</label>
                                <input type="text" class="form-control" placeholder="Year" id="year-add">
                                <div class="alert alert-danger alert-year-add" role="alert">
                                    Year is required
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price</label>
                                <input type="text" class="form-control" placeholder="Price" id="price-add">
                                <div class="alert alert-danger alert-price-add" role="alert">
                                    Price is required & number
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Amount</label>
                                <input type="text" class="form-control" placeholder="Amount" id="amount-add">
                                <div class="alert alert-danger alert-amount-add" role="alert">
                                    Amount is required & integer
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Select a category</label>
                            <select class="custom-select custom-select-lg select-category" id="category-add">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Description:</label>
                            <textarea class="form-control" rows="5" id="description-add"></textarea>
                            <div class="alert alert-danger alert-description-add" role="alert">
                                Description is required
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success submit-add">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center ">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="10%">Image</th>
                <th scope="col" width="20%">Tittle</th>
                <th scope="col" width="5%">Amount</th>
                <th scope="col" width="5%">Price/Product</th>
                <th scope="col" width="10%">Belong to Category</th>
                <th scope="col" width="15%">Action</th>
            </tr>
        </thead>
        <tbody class="body-product lead">
<?php
    // require_once __DIR__."/../../../api/model/product.php";
    // $product = new Product();
    // $page=$_GET['page'];
    // $limit=5;
    // $range=5;
    // $productList = $product->getProductByOption($page, $limit, $range, false);
    // $html="";
    // foreach($productList as $product){
    //     $html.="<tr>".
    //             '<td class="align-middle">'.$product['id'].'</td>'.
    //             ' <td>'.
    //                 '<img src="'.base_url().'uploads/'.$product['picture'].'" class="img-thumbnail">'.
    //             ' </td>'.
    //             '<td class="align-middle">'.$product['title'].'</td>'.
    //             '<td class="align-middle">'.$product['num_existed'].'</td>'.
    //             '<td class="align-middle">'.$product['price'].' VND</td>'.
    //             '<td class="align-middle">'.$product['category_name'].'</td>'.
    //             '<td class="align-middle">'.
    //                 '<button class="btn btn-danger" id="'.$product['id'].'">Delete</button>'.
    //                 '<div class="dropdown-divider"></div>'.
    //                 '<button class="btn btn-success btn-update" data-toggle="modal" id="'.$product['id'].'" data-target="#updateModal">Update</button>'.
    //             '</td>'.
    //         '</tr>';
    // }
    // echo $html;
    
?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
  <ul class="pagination float-right">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

<?php
    // require_once __DIR__."/../../../api/model/product.php";
    // $p = new Product();
    // $p->table="products";
    // $productList = $p->fetchAllByCategory();
    // $recordTotal = count($productList);
    // $pageTotal = ceil($recordTotal/$limit);
    // $min=0; $max=0;
    // if($pageTotal < $range){
    //     $min=1;
    //     $max = $pageTotal;
    // }
    // else{
    //     $mid = ceil($range/2);
    //     $min=$page-$mid+1;
    //     $max =$page+$mid-1;
    //     if($min<1){
    //         $min=1;
    //         $max=$range;
    //     }
    //     else if($max>$pageTotal){
    //         $max=$pageTotal;
    //         $min=$pageTotal-$range+1;
    //     }
    // }
    // $p='<nav class="float-right">'.
    //     '<ul class="pagination">';
    // if($page>1){
    //     $p.='<li class="page-item"><a href="'.base_url().'public/admin/view/product.php?page='.($page-1).'" class="page-link">Previous</a></li>';
    // }
    // for($i=$min;$i<=$max;$i++){
    //     if($page==$i){
    //         $p.='<li class="page-item"><button class="btn btn-primary">'.$i.'</button></li>';
    //     }
    //     else{
    //         $p.='<li class="page-item"><a href="'.base_url().'public/admin/view/product.php?page='.($i).'" class="page-link">'.$i.'</a></li>';
    //     }
    // }
    // if($page<$pageTotal){
    //     $p.='<li class="page-item"><a href="'.base_url().'public/admin/view/product.php?page='.($page+1).'" class="page-link">Previous</a></li>';
    // }
    
    // $p.=' </ul></nav>';
    // echo $p;
?>

    <!-- Modal update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update the category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div><input type="text" id="id-update" class="d-none"></div>
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Product'title" id="title-update">
                                <div class="alert alert-danger alert-title-update" role="alert">
                                    Title is required
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-sm-3 position-absolute" style="right:1rem; top:1rem">
                            <img src="" alt="err" class="img-thumbnail" id="image_upload_preview">
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label>Choose file</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture-update">
                                    <label class="custom-file-label" for="customFile"
                                        id="picture-name-update">File</label>
                                </div>
                                <div class="alert alert-danger alert-picture-update" role="alert">
                                    File is required
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Publisher Name</label>
                                <input type="text" class="form-control" placeholder="Publisher" id="publisher-update">
                                <div class="alert alert-danger alert-publisher-uodate" role="alert">
                                    Publisher is required
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Author Name</label>
                                <input type="text" class="form-control" placeholder="Author" id="author-update">
                                <div class="alert alert-danger alert-author-update" role="alert">
                                    Title is required
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Publish Year</label>
                                <input type="text" class="form-control" placeholder="Year" id="year-update">
                                <div class="alert alert-danger alert-year-update" role="alert">
                                    Title is required
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price</label>
                                <input type="text" class="form-control" placeholder="Price" id="price-update">
                                <div class="alert alert-danger alert-price-update" role="alert">
                                    Title is required
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Amount</label>
                                <input type="text" class="form-control" placeholder="Amount" id="amount-update">
                                <div class="alert alert-danger alert-amount-update" role="alert">
                                    Amount is required
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Select a category</label>
                            <select class="custom-select custom-select-lg select-category" id="category-update">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Description:</label>
                            <textarea class="form-control" rows="5" id="description-update"></textarea>
                            <div class="alert alert-danger alert-description-update" role="alert">
                                Description is required
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success submit-update">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</main>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image_upload_preview').attr('src', e.target.result);
        }


        reader.readAsDataURL(input.files[0]);
    }
}

function readURL_ADD(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image_upload_preview_add').attr('src', e.target.result);
        }


        reader.readAsDataURL(input.files[0]);
    }
}

$("#picture-update").change(function() {
    readURL(this);
});
$("#picture-add").change(function() {
    readURL_ADD(this)
})
</script>
<?php
    require_once __DIR__."/footer.php";
?>