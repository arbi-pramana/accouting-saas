@extends('users.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- breadcumbs -->
    <div class="row page-titles">
        <div class="col p-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Users</a>
                </li>
                <li class="breadcrumb-item active">Penjualan</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Penjualan</h4>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Tambah Baru </button>
                    </div>
                    @if (\Session::has('danger'))
                        <div class="alert alert-danger mt-2">
                            {!! \Session::get('danger') !!}
                        </div>
                    @endif
                    @if (\Session::has('success'))
                        <div class="alert alert-success mt-2">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Document No</th>
                                    <th>Type</th>
                                    <th>Chart Of Account</th>
                                    <th>Customer</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>PPN (%)</th>
                                    <th>PPN</th>
                                    <th>Total</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Sisa Pembayaran</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $i => $sale)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{Format::date_format($sale->date)}} </td>
                                        <td> {{$sale->document_no}} </td>
                                        <td> {{$sale->type}} </td>
                                        <td> {{$sale->coa ? $sale->coa->name : ''}} </td>
                                        <td> {{$sale->customer ? $sale->customer->name : ''}} </td>
                                        <td> {{$sale->product ? $sale->product->name : ''}} </td>
                                        <td> {{$sale->quantity}} </td>
                                        <td> {{Format::price($sale->price)}} </td>
                                        <td> {{Format::price($sale->subtotal)}} </td>
                                        <td> {{$sale->tax_percentage}} </td>
                                        <td> {{Format::price($sale->tax_amount)}} </td>
                                        <td> {{Format::price($sale->total)}} </td>
                                        <td> {{Format::price($sale->payment_amount)}} </td>
                                        <td> {{Format::price($sale->payment_due_amount)}} </td>
                                        <td> {{$sale->remarks}} </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                id="edit-{{$sale->id}}"
                                                data-id="{{$sale->id}}" 
                                                data-date="{{$sale->date}}" 
                                                data-document_no="{{$sale->document_no}}" 
                                                data-type="{{$sale->type}}" 
                                                data-coa_id="{{$sale->coa_id}}" 
                                                data-customer_id="{{$sale->customer_id}}" 
                                                data-product_id="{{$sale->product_id}}" 
                                                data-quantity="{{$sale->quantity}}" 
                                                data-price="{{$sale->price}}" 
                                                data-subtotal="{{$sale->subtotal}}" 
                                                data-tax_percentage="{{$sale->tax_percentage}}" 
                                                data-tax_amount="{{$sale->tax_amount}}" 
                                                data-total="{{$sale->total}}" 
                                                data-payment_amount="{{$sale->payment_amount}}" 
                                                data-payment_due_amount="{{$sale->payment_due_amount}}" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                onclick="editData('{{$sale->id}}')"
                                                ><i class="fa fa-pencil"></i> </button>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#modalDelete"
                                            onclick="deleteData('{{$sale->id}}')"
                                            ><i class="fa fa-trash"></i>  </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add-->
<div class="modal fade" id="modalAdd">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{route('sale.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    Date <br>
                    <input type="date" class="form-control" name="date" required><br>
                    Document No <br>
                    <input type="text" class="form-control" name="document_no" required><br>
                    Type <br>
                    <select name="type" class="form-control" required>
                        <option value="Penjualan">Penjualan</option>
                        <option value="Retur Penjualan">Retur Penjualan</option>
                    </select> <br>
                    Chart Of Account <br>
                    <select name="coa_id" class="form-control select2 coa" required>
                        <option value=""></option>
                        @foreach($coas as $coa)
                            <option value="{{$coa->id}}">{{$coa->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Customer <br>
                    <select name="customer_id" class="form-control select2 customer" required>
                        <option value=""></option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Product <br>
                    <select name="product_id" class="form-control select2 product" id="product_id" required>
                        <option value=""></option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}" data-sell_price="{{$product->sell_price}}">{{$product->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Quantity <br>
                    <input type="text" class="form-control" name="quantity" id="quantity" required><br>
                    Price <br>
                    <input type="text" class="form-control" name="price" id="price" required><br><br>
                    Subtotal <br>
                    <input type="text" class="form-control" name="subtotal" id="subtotal" required readonly><br>
                    PPN (%) <br>
                    <input type="number" class="form-control" name="tax_percentage" id="tax_percentage" required><br>
                    PPN <br>
                    <input type="text" class="form-control" name="tax_amount" id="tax_amount" required readonly><br>
                    Total <br>
                    <input type="text" class="form-control" name="total" id="total" required readonly><br>
                    Jumlah Pembayaran <br>
                    <input type="text" class="form-control" name="payment_amount" id="payment_amount" value="0" required><br>
                    Sisa Pembayaran <br>
                    <input type="text" class="form-control" name="payment_due_amount" id="payment_due_amount" required readonly><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" value="Save changes">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit-->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="" method="post" id="editForm">
                @method('put')
                @csrf
                <div class="modal-body">
                    Date <br>
                    <input type="date" class="form-control" name="date" id="edit-date" required><br>
                    Document No <br>
                    <input type="text" class="form-control" name="document_no" id="edit-document_no" required><br>
                    Type <br>
                    <select name="type" id="edit-type" class="form-control" required>
                        <option value="Penjualan">Penjualan</option>
                        <option value="Retur Penjualan">Retur Penjualan</option>
                    </select> <br>
                    Chart Of Account <br>
                    <select name="coa_id" id="edit-coa_id" class="form-control select2 coa" required>
                        <option value=""></option>
                        @foreach($coas as $coa)
                            <option value="{{$coa->id}}">{{$coa->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Customer <br>
                    <select name="customer_id" id="edit-customer_id" class="form-control select2 customer" required>
                        <option value=""></option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Product <br>
                    <select name="product_id" class="form-control select2 product" id="edit-product_id" required>
                        <option value=""></option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}" data-sell_price="{{$product->sell_price}}">{{$product->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Quantity <br>
                    <input type="text" class="form-control" name="quantity" id="edit-quantity" required><br>
                    Price <br>
                    <input type="text" class="form-control" name="price" id="edit-price" required><br><br>
                    Subtotal <br>
                    <input type="text" class="form-control" name="subtotal" id="edit-subtotal" required readonly><br>
                    PPN (%) <br>
                    <input type="number" class="form-control" name="tax_percentage" id="edit-tax_percentage" required><br>
                    PPN <br>
                    <input type="text" class="form-control" name="tax_amount" id="edit-tax_amount" required readonly><br>
                    Total <br>
                    <input type="text" class="form-control" name="total" id="edit-total" required readonly><br>
                    Jumlah Pembayaran <br>
                    <input type="text" class="form-control" name="payment_amount" id="edit-payment_amount" value="0" required><br>
                    Sisa Pembayaran <br>
                    <input type="text" class="form-control" name="payment_due_amount" id="edit-payment_due_amount" required readonly><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" value="Save changes">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete-->
<div class="modal fade" id="modalDelete">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="" method="post" id="deleteForm">
                @method('delete')
                @csrf
                <div class="modal-body">
                    Apakah Anda yakin hapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <input type="submit" class="btn btn-danger" value="Yes, Delete!">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>
    $("#product_id,#quantity,#tax_percentage,#payment_amount").change(function(){
        let product_price = $("#product_id").find(':selected').attr('data-sell_price')
        let qty = $("#quantity").val() 
        let price = $("#price").val(product_price)
        let subtotal = $("#subtotal").val(qty * product_price)
        let tax_percentage = $("#tax_percentage")
        let tax_amount = $("#tax_amount").val(subtotal.val() * tax_percentage.val() / 100)
        let total = $("#total").val(parseFloat(subtotal.val()) + parseFloat(tax_amount.val()))
        let payment_amount = $("#payment_amount")
        $("#payment_due_amount").val(parseFloat(total.val()) - parseFloat(payment_amount.val()))
    })
</script>
<script>
    function editData(id){
        $("#edit-date").val($("#edit-"+id).data("date"))
        $("#edit-document_no").val($("#edit-"+id).data("document_no"))
        $("#edit-type").val($("#edit-"+id).data("type"))
        $("#edit-coa_id").val($("#edit-"+id).data("coa_id"))
        $("#edit-customer_id").val($("#edit-"+id).data("customer_id"))
        $("#edit-product_id").val($("#edit-"+id).data("product_id"))
        $("#edit-quantity").val($("#edit-"+id).data("quantity"))
        $("#edit-price").val($("#edit-"+id).data("price"))
        $("#edit-subtotal").val($("#edit-"+id).data("subtotal"))
        $("#edit-tax_percentage").val($("#edit-"+id).data("tax_percentage"))
        $("#edit-tax_amount").val($("#edit-"+id).data("tax_amount"))
        $("#edit-total").val($("#edit-"+id).data("total"))
        $("#edit-payment_amount").val($("#edit-"+id).data("payment_amount"))
        $("#edit-payment_due_amount").val($("#edit-"+id).data("payment_due_amount"))
        $("#editForm").attr("action","{{url('users/sale')}}"+"/"+id)

        $(".select2").select2({
            width:"100%",
            height:"50px"
        });
    }
    
    function deleteData(id){
        $("#deleteForm").attr("action","{{url('users/sale')}}"+"/"+id)
    }
</script>
<script>
    $("#edit-product_id,#edit-quantity,#edit-tax_percentage,#edit-payment_amount").change(function(){
        let product_price = $("#edit-product_id").find(':selected').attr('data-sell_price')
        let qty = $("#edit-quantity").val() 
        let price = $("#edit-price").val(product_price)
        let subtotal = $("#edit-subtotal").val(qty * product_price)
        let tax_percentage = $("#edit-tax_percentage")
        let tax_amount = $("#edit-tax_amount").val(subtotal.val() * tax_percentage.val() / 100)
        let total = $("#edit-total").val(parseFloat(subtotal.val()) + parseFloat(tax_amount.val()))
        let payment_amount = $("#edit-payment_amount")
        $("#edit-payment_due_amount").val(parseFloat(total.val()) - parseFloat(payment_amount.val()))
    })
</script>
<script>
    $(".select2").select2({
        width:"100%",
        height:"50px"
    });
</script>
@stop