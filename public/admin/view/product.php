<?php
    require_once __DIR__."/header.php";
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 mt-5">
    <h4>
        Category
    </h4>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-add" data-toggle="modal" data-target="#exampleModal">
        NEW ADD
    </button>

    <!-- Modal -->
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
                            <label>Name of product</label>
                            <input type="text" class="form-control" placeholder="Product'name">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="custom-select custom-select-lg">
                                <option selected>Select a category</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" placeholder="Category'price">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Category'amount">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="20%">Image</th>
                <th scope="col" width="20%">Tittle</th>
                <th scope="col" width="5%">Amount</th>
                <th scope="col" width="5%">Price/Product</th>
                <th scope="col" width="10%">Belong to Category</th>
                <th scope="col" width="25%">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
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
            </tr>


        </tbody>
    </table>

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
                        <div class="form-group">
                            <label>Name of product</label>
                            <input type="text" class="form-control" placeholder="Product'name">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="custom-select custom-select-lg">
                                <option selected>Select a category</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" placeholder="Category'price">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Category'amount">
                        </div>
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