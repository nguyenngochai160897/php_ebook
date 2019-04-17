<?php 
    require_once __DIR__."/header.php";
    
?>

<script>
    $(".dashboard").addClass("active")
    function getOrder(){
        $.ajax({
        
        })
    }
$(document).ready(function() {
    // $("table").DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "ajax": ""
    // });
});
</script>

<!-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 mt-5"> -->
    <!-- <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="25%">Customer</th>
                <th scope="col" width="20%">Total</th>
                <th scope="col" width="25%">Status of transaction</th>
                <th scope="col" width="25%">Date created</th>
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
            </tr>
        </tbody>
    </table>

</main> -->

<?php
    require_once __DIR__."/footer.php";
?>