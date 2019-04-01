<?php
    require_once __DIR__."/header.php";
?>

<script>
function getAllProduct() {
    let html = ""
    let srcImg = "<?php echo base_url();?>uploads/";
    $.ajax({
        async: false,
        url: "<?php echo base_url();?>api/product.php",
        method: "GET",
        dataType: "json",
        success: function(res) {
            let data = res.records;
            for (let i = 0; i < data.length; i++) {
                html += "<tr>" +
                    '<td class="align-middle">' + data[i].id + '</td>' +
                    ' <td>' +
                    '<img src="' + srcImg + data[i].picture + '" class="img-thumbnail">' +
                    ' </td>' +
                    '<td class="align-middle">' + data[i].title + '</td>' +
                    '<td class="align-middle">' + data[i].num_existed + '</td>' +
                    '<td class="align-middle">' + data[i].price + '$</td>' +
                    '<td class="align-middle">' + data[i].category_name + '</td>' +
                    '<td class="align-middle">' +
                    '<button class="btn btn-danger" id="' + data[i].id + '">Delete</button>' +
                    '<div class="dropdown-divider"></div>' +
                    '<button class="btn btn-success" data-toggle="modal" id="' + data[i].id +
                    ' data-target="#updateModal">Update</button>' +
                    '</td>' +
                    '</tr>';
            }
            $(".body-product").html(html);
        }
    })
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

function deleteProduct(id){
    $.ajax({
        url: "<?php echo base_url();?>api/product.php",
        method: "DELETE",
        dataType: "json",
        data: {
            id: id,
        },
        success: function(res) {
            if(res.status == "review"){
               alert("Can not delete this product!!!");
            }
            
        }
    })
}

function validateFormAdd(){
    if($("#title-add").val() == ""){
        $("#title-add").focus()
        $(".alert-title-add").show();
        return false;
    }
    else{
        $(".alert-title-add").hide();
    }

    if($("#publisher-add").val() == ""){
        $("#publisher-add").focus()
        $(".alert-publisher-add").show();
        return false;
    }
    else{
        $(".alert-publisher-add").hide();
    }

    if($("#author-add").val() == ""){
        $("#author-add").focus()
        $(".alert-author-add").show();
        return false;
    }
    else{
        $(".alert-author-add").hide();
    }

    if($("#year-add").val() == ""){
        $("#year-add").focus()
        $(".alert-year-add").show();
        return false;
    }
    else{
        $(".alert-year-add").hide();
    }

    if($("#price-add").val() == "" || !$.isNumeric($("#price-add").val())){
        $("#price-add").focus()
        $(".alert-price-add").show();
        return false;
    }
    else{
        $(".alert-price-add").hide();
    }

    if($("#amount-add").val() == "" ){
        $("#amount-add").focus()
        $(".alert-amount-add").show();
        return false;
    }
    else{
        $(".alert-amount-add").hide();
    }

    if($("#description-add").val() == ""){
        $("#description-add").focus()
        $(".alert-description-add").show();
        return false;
    }
    else{
        $(".alert-description-add").hide();
    }

    return true;
}

$(document).ready(function() {
    $(".alert").hide();
    getAllProduct();
    getAllCategory();


    $("#picture-add").on("change", function(){
        // console.log($(this)[0].files[0].name)
    })

    $(".submit-add").on("click", function(e) {
        e.preventDefault();
        if(validateFormAdd()){
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
            if(data.status == "fail"){
                $(".alert-picture-add").html(data.message)
                $(".alert-picture-add").show()
            }
            else{
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
                getAllProduct()
            }
        }
    })

    $(".body-product").on("click", ".btn-danger", function() {
        let product_id = $(".btn-danger").attr("id");
        if(window.confirm("Do you want to delete product with id : " + product_id)){
            deleteProduct(product_id)
            getAllProduct();
        }
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
                    <h5 class="modal-title" id="exampleModalLabel">New add a category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label>Title</label>
                                <input type="text" class    ="form-control" placeholder="Product'title" id="title-add">
                                <div class="alert alert-danger alert-title-add" role="alert">
                                    Title is required
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
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
                                <input type="number" class="form-control" placeholder="Amount" id="amount-add">
                                <div class="alert alert-danger alert-amount-add" role="alert">
                                    Amount is required & integer
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Select a category</label>
                            <select class="custom-select custom-select-lg select-category" id = "category-add">
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
                <th scope="col" width="25%">Action</th>
            </tr>
        </thead>
        <tbody class="body-product lead">
            <!-- <tr>
                <td class="align-middle">1</td>
                <td>
                    <img src="image/product-1.png" alt="err" class="img-thumbnail">
                </td>
                <td class="align-middle">Qua tang cuoc song</td>
                <td class="align-middle">10</td>
                <td class="align-middle">10$</td>
                <td class="align-middle">Doi song</td>
                <td class="align-middle">
                    <button class="btn btn-danger">Delete</button>
                    <div class="dropdown-divider"></div>
                    <button class="btn btn-success" data-toggle="modal" data-target="#updateModal">Update</button>
                </td>
            </tr> -->
        </tbody>
    </table>

    <!-- Modal update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New add a category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Product'title" id="title-add"
                                    required>

                            </div>

                            <div class="form-group col-sm-4">
                                <label>Choose file</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture-add">
                                    <label class="custom-file-label" for="customFile">File</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Publisher Name</label>
                                <input type="text" class="form-control" placeholder="Publisher" id="publisher-add">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Author Name</label>
                                <input type="text" class="form-control" placeholder="Author" id="author-add">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Publish Year</label>
                                <input type="text" class="form-control" placeholder="Year" id="year-add">

                            </div>
                            <div class="form-group col-sm-4">
                                <label>Price</label>
                                <input type="text" class="form-control" placeholder="Price" id="price-add">

                            </div>
                            <div class="form-group col-sm-4">
                                <label>Amount</label>
                                <input type="text" class="form-control" placeholder="Amount" id="amount-add">

                            </div>
                        </div>


                        <div class="form-group">
                            <label>Select a category</label>
                            <select class="custom-select custom-select-lg select-category">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Description:</label>
                            <textarea class="form-control" rows="5" id="description-add"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success submit-add">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    require_once __DIR__."/footer.php";
?>