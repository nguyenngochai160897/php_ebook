<?php
    require_once __DIR__."/header.php";
    require_once __DIR__."/../../../config/base_url.php";
?>
<script>
$(".trans").addClass("active")

function selectStatusDeliver(status){
   if(status==1){
       return '<div class="form-group">'+
                '<select class="alert-primary form-control" id="select-status">'+
                    '<option selected>Processing</option>'+
                    '<option>Successful</option>'+
                    '<option>Failed</option>'+
                '</select>'+
            '</div>';
    }
    if(status==2){
        return '<div class="form-group">'+
                '<select class="alert-primary form-control" id="select-status">'+
                    '<option>Processing</option>'+
                    '<option selected >Successful</option>'+
                    '<option>Failed</option>'+
                '</select>'+
            '</div>';
    }
    if(status ==3){
        return '<div class="form-group">'+
                '<select class="alert-primary form-control" id="select-status">'+
                    '<option>Processing</option>'+
                    '<option>Successful</option>'+
                    '<option selected>Failed</option>'+
                '</select>'+
            '</div>';
    }
}
function getAllTransaction() {
    $.ajax({
        url: "<?php echo base_url();?>/api/order.php",
        method: "GET",
        dataType: "json",
        success: function(res) {
            let html = "";
            let data = res.records;
            data.forEach((element) => {
                html += '<tr>' +
                    '<td class="align-middle order-id">'+element.id+'</td>' +
                    '<td class="align-middle">'+element.email+'</td>' +
                    '<td class="align-middle">'+element.total_price+' VND</td>' +
                    '<td>';
                if (element.deliver_status == 1) {
                    html += selectStatusDeliver(1);
                } else if (element.deliver_status == 2) {
                    html += selectStatusDeliver(2);
                } else {
                    html += selectStatusDeliver(3);
                }
                html += '</td>' +
                    '<td class="align-middle">'+element.order_date+'</td>' +
                    '<td>' +
                        '<button class="btn btn-primary detail" id="'+element.id+'" data-toggle="modal" data-target="#detailModal">Detail</button>' +
                    '</td>' +
                    '</tr>';
            })
            $(".table-body").html(html);
        }
    })
}
function getTransaction(id){
    $.ajax({
        url: "<?php echo base_url();?>api/order.php?id="+id,
        method:"GET",
        dataType: "json",
        success: function(res) {
            console.log("res")
            let data = res.records;
            let html1 = "";
            let html2 = "";
            console.log(res)
            data.forEach((element) => {
                console.log(element)
                $(".total").html(element.total+" VND")
                html1=   
                    '<h6 style="text-align: center; width:100%;">Customer Information</h6>'+
                    '<p class="font-weight-bold pr-2 ml-5">Email: </p>'+element.email+
                    '<p class="font-weight-bold pr-2 ml-5">Phone: </p>'+element.phone+
                    '<p class="font-weight-bold pr-2 ml-5">Address: </p>'+element.address;
                html2+=  
                    '<tr>'+
                        '<td>'+
                            '<div class="row">'+
                                '<div class="col-4">'+
                                    '<img class="img-thumbnail" width="70" src="<?php echo base_url();?>uploads/'+element.picture+'">'+
                                '</div>'+
                                '<div class="col-4">'+element.title+'</div>'+
                                '</div>'+
                        '</td>'+
                        '<td>'+element.amount+'</td>'+
                        '<td>'+element.price+'VND</td>'+
                        '<td>'+element.totalAmount+' VND</td>'+
                    '</tr>'   ;       
            })
            $(".customer-info").html(html1)
            $(".product-info").html(html2)

        }
    })
}

function updateStatus(id, deliver_status){
    $.ajax({
        url:"<?php echo base_url();?>api/order.php",
        method:"PUT",
        data:{
            id:id,
            deliver_status: deliver_status
        },
        success: function(){
            
        }
        
    })
}
$(document).ready(function() {
    getAllTransaction();
    $(".table-body").on("click", ".detail", function(){
        let id = $(this).attr("id")
        getTransaction(id)
    })
    $(".table-body").on("change", "#select-status", function(){
        let id=$(this).parent().parent().siblings(".order-id").html();
        if($(this).val() == "Successful"){
            updateStatus(id, 2);
        }
        else if($(this).val() == "Failed"){
            updateStatus(id, 3);
            alert("Deleted "+id)

        }
        else if($(this).val() == "Processing"){
            updateStatus(id, 1)
        }
        getAllTransaction();
    })
    
})
</script>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 mt-5">
    <h4>Transaction</h4>
    <!-- Modal Details -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-body-detail">
                    <!-- phone, dia chi, email -->
                    <div class="row customer-info">
                        <h6 style="text-align: center; width:100%;">Customer Information</h6>
                        <p class="font-weight-bold pr-2 ml-5">Email: </p> sodium_crypto_sign_ed25519_sk_to_curve25519
                        <p class="font-weight-bold pr-2 ml-5">Phone: </p> sodium_crypto_sign_ed25519_sk_to_curve25519
                        <p class="font-weight-bold pr-2 ml-5">Address: </p> sodium_crypto_sign_ed25519_sk_to_curve25519
                    </div>
                    <hr>
                    <!-- ten hang, so luong, don gia , thanh tien, tong cong -->
                    <div class="row">
                        <h6 style="text-align: center; width:100%;">Product Information</h6>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th width="40%">Item</th>
                                    <th width="20%">Amount</th>
                                    <th scope="20%">Price</th>
                                    <th scope="20%">Total amount</th>
                                </tr>
                            </thead>
                            <tbody class="product-info">
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <img class="img-thumbnail" width="70"
                                                    src="https://yt3.ggpht.com/a-/AAuE7mDaIPSwLi2eUtSdUZ0Knhmpfg6vTCe09VKiLw=s900-mo-c-c0xffffffff-rj-k-no">
                                            </div>
                                            <div class="col-4">ten san phamdsffffffffffffffffrtr yy tytyyyyyyyyyyyyyyy</div>
                                        </div>
                                    </th>
                                    <td>10</td>
                                    <td>100000 VND</td>
                                    <td>1000000 VND</td>
                                </tr>
                                
                            </tbody>
                            
                        </table>
                        <p class="text-right font-weight-bold" style="width: 40rem;">Tổng cộng: </p><span class="total">dd</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table text-center table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="10%">Customer Email</th>
                <th scope="col" width="15%">Total Order Value</th>
                <th scope="col" width="20%">Transaction Status</th>
                <th scope="col" width="20%">Date created</th>
                <th scope="col" width="30%">Action</th>
            </tr>
        </thead>
        <tbody class="table-body">

        </tbody>
    </table>

</main>
<?php
    require_once __DIR__."/footer.php";
?>