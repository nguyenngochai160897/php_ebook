<?php
    require_once __DIR__."/header.php";
?>

<script>
$(".category").addClass("active")
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
                html += "<tr>" +
                    "<td>" + data[i].id + "</td>" +
                    " <td>" + data[i].name + "</td>" +
                    " <td>" +
                    '<button class="btn btn-danger mr-3" id="' + data[i].id + '">Delete</button>' +
                    '<button type="button" class="btn btn-success btn-update" id="' + data[i].id + '"data-toggle="modal" data-target="#updateModal">'+
                        'Update'+
                    '</button>'+
                    "</td>" +
                    "</tr>";
            }

        }
    })
    $(".body-category").html(html);
}

function addCategory(category_name) {
    $.ajax({
        url: "<?php echo base_url();?>api/category.php",
        method: "POST",
        data: {
            name: category_name
        },
        success: function(data) {
            console.log(data)
        }
    })
}

function deleteCategory(category_id) {
    $.ajax({
        url: "<?php echo base_url();?>api/category.php",
        method: "DELETE",
        data: {
            id: category_id
        },
        success: function(data) {
            console.log(data)
        }
    })
}

function updateCategory(category_id, category_name) {
    $.ajax({
        url: "<?php echo base_url();?>api/category.php",
        method: "PUT",
        data: {
            id: category_id,
            name: category_name
        },
        
    })
}

function getCategory(id){
    $.ajax({
        url:"<?php echo base_url(); ?>api/category.php?id="+id,
        method: "GET",
        dataType: "json",
        success: function(res){
            let data = res.record;
            $("#name-update").val(data[0].name)
            $("#id-update").val((data[0].id))
        }
    })
}

$(document).ready(function() {
    getAllCategory();
    $(".alert").hide();
    $(".body-category").on("click", ".btn-danger", function() {
        let category_id = $(this).attr("id");
        if (window.confirm("Do you want to delete category with id : " + category_id)) {
            deleteCategory(category_id);
        }
        getAllCategory();
    })

    $(".submit-add").on("click", function(e) {
        e.preventDefault();
        
        if ($("#name-add").val() == "") {
            $(".alert-name-add").show();
        }
        else{
            $(".alert-name-add").hide();
            addCategory($("#name-add").val());
            $("#name-add").val("");
            getAllCategory();
        }
    })

    $(".body-category").on("click", ".btn-update", function(){
        let category_id = $(this).attr("id");
        getCategory(category_id)
    })

    $(".submit-update").on("click", function(e) {
        e.preventDefault();
        if($("#name-update").val() == ""){
            $(".alert-name-update").show();
        }
        else{
            $(".alert-name-update").hide();
            updateCategory($("#id-update").val(), $("#name-update").val());
            getAllCategory();
        }
       
    })
})
</script>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 mt-5">
    <h4>
        Category
    </h4>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-add" data-toggle="modal" data-target="#exampleModal">
        NEW ADD
    </button>

    <!-- Modal ADD-->
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
                    <form>
                        <div class="form-group">
                            <label>Name of category</label>
                            <input type="text" class="form-control" placeholder="Category'name" id="name-add">
                        </div>
                        <div class="alert alert-danger alert-name-add" role="alert">
                            Name is required
                        </div>
                        <button type="submit" class="btn btn-primary submit-add">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="10%">#</th>
                <th scope="col" width="50%">Name</th>
                <th scope="col" width="40%">Action</th>

            </tr>
        </thead>
        <tbody class="body-category">
            <tr>
                <td>1</td>
                <td>Mark</td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#updateModal">Update</button>
                </td>

            </tr>
        </tbody>
    </table>
    <!-- Modal Update -->
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
                        <div class="form-group">
                            <label>Name of category</label>
                            <input type="text" class="form-control" placeholder="Category'name" id="name-update">
                        </div>
                        <div class="form-group d-none">
                            <input type="text" class="form-control" id = "id-update">
                        </div>
                        <div class="alert alert-danger alert-name-update" role="alert">
                            Name is required
                        </div>
                        <button type="submit" class="btn btn-primary submit-update">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>



<?php
    require_once __DIR__."/footer.php";
?>