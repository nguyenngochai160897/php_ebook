<?php
    require_once __DIR__."/header.php";
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 mt-5">
    <h4>Transaction</h4>
    <table class="table text-center table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="10%">Customer</th>
                <th scope="col" width="15%">Total Order Value</th>
                <th scope="col" width="20%">Transaction Status</th>
                <th scope="col" width="20%">Date created</th>
                <th scope="col" width="30%">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="align-middle">1</td>
                <td class="align-middle">Mark</td>
                <td class="align-middle">1000$</td>
                <td>
                    <div class="alert alert-success ">
                        Successful
                    </div>
                </td>
                <td class="align-middle">19-03-2019 01:24:02</td>
                <td>
                    <button class="btn btn-primary">Detail</button>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-success">Update</button>
                </td>
            </tr>
            <tr>
                <td class="align-middle">2</td>
                <td class="align-middle">Mark</td>
                <td class="align-middle">1000$</td>
                <td>
                    <div class="alert alert-danger ">
                        Failed
                    </div>
                </td>
                <td class="align-middle">19-03-2019 01:24:02</td>
                <td>
                    <button class="btn btn-primary">Detail</button>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-success">Update</button>
                </td>
            </tr>
            <tr>
                <td class="align-middle">3</td>
                <td class="align-middle">Mark</td>
                <td class="align-middle">1000$</td>
                <td>
                    <div class="alert alert-dark ">
                        Processing
                    </div>
                </td>
                <td class="align-middle">19-03-2019 01:24:02</td>
                <td>
                    <button class="btn btn-primary">Detail</button>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-success">Update</button>
                </td>
            </tr>
        </tbody>
    </table>

</main>
<?php
    require_once __DIR__."/footer.php";
?>