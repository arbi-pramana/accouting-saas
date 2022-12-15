@extends('users.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- breadcumbs -->
    <div class="row page-titles">
        <div class="col p-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Users</a>
                </li>
                <li class="breadcrumb-item active">Pembelian</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Pembelian</h4>
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
                                    <th>Supplier</th>
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
                                @foreach($purchases as $i => $purchase)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{Format::date_format($purchase->date)}} </td>
                                        <td> {{$purchase->document_no}} </td>
                                        <td> {{$purchase->type}} </td>
                                        <td> {{$purchase->coa ? $purchase->coa->name : ''}} </td>
                                        <td> {{$purchase->supplier ? $purchase->supplier->name : ''}} </td>
                                        <td> {{$purchase->product ? $purchase->product->name : ''}} </td>
                                        <td> {{$purchase->quantity}} </td>
                                        <td> {{Format::price($purchase->price)}} </td>
                                        <td> {{Format::price($purchase->subtotal)}} </td>
                                        <td> {{$purchase->tax_percentage}} </td>
                                        <td> {{Format::price($purchase->tax_amount)}} </td>
                                        <td> {{Format::price($purchase->total)}} </td>
                                        <td> {{Format::price($purchase->payment_amount)}} </td>
                                        <td> {{Format::price($purchase->payment_due_amount)}} </td>
                                        <td> {{$purchase->remarks}} </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                id="edit-{{$purchase->id}}"
                                                data-id="{{$purchase->id}}" 
                                                data-name="{{$purchase->name}}" 
                                                data-email="{{$purchase->email}}" 
                                                data-phone="{{$purchase->phone}}" 
                                                data-address="{{$purchase->address}}" 
                                                data-description="{{$purchase->description}}" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                onclick="editData('{{$purchase->id}}')"
                                                ><i class="fa fa-pencil"></i> </button>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#modalDelete"
                                            onclick="deleteData('{{$purchase->id}}')"
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
            <form action="{{route('purchase.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    Date <br>
                    <input type="date" class="form-control" name="date" required><br>
                    Document No <br>
                    <input type="text" class="form-control" name="document_no" required><br>
                    Type <br>
                    <select name="type" class="form-control" required>
                        <option value="Pembelian">Pembelian</option>
                        <option value="Retur Pembelian">Retur Pembelian</option>
                    </select> <br>
                    Chart Of Account <br>
                    <select name="coa_id" class="form-control select2 coa" required>
                        <option value=""></option>
                        @foreach($coas as $coa)
                            <option value="{{$coa->id}}">{{$coa->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Supplier <br>
                    <select name="supplier_id" class="form-control select2 supplier" required>
                        <option value=""></option>
                        @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select> <br><br>
                    Product <br>
                    <select name="product_id" class="form-control select2 product" id="product_id" required>
                        <option value=""></option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}" data-purchase_price="{{$product->purchase_price}}">{{$product->name}}</option>
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
                    Name <br>
                    <input type="text" class="form-control" id="edit-name" name="name" required><br>
                    Email <br>
                    <input type="email" class="form-control" id="edit-email" name="email" required><br>
                    Phone <br>
                    <input type="text" class="form-control" id="edit-phone" name="phone" required><br>
                    Address <br>
                    <textarea name="address" id="edit-address" class="form-control" cols="30" rows="10"></textarea>
                    Description <br>
                        <textarea name="description" id="edit-description" class="form-control" cols="30" rows="10"></textarea>
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
    $(".select2").select2({
        width:"100%",
        height:"50px"
    });
</script>
<script>
    $("#product_id,#quantity,#tax_percentage,#payment_amount").change(function(){
        let product_price = $("#product_id").find(':selected').attr('data-purchase_price')
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
        $("#edit-name").val($("#edit-"+id).data("name"))
        $("#edit-email").val($("#edit-"+id).data("email"))
        $("#edit-phone").val($("#edit-"+id).data("phone"))
        $("#edit-address").val($("#edit-"+id).data("address"))
        $("#edit-description").val($("#edit-"+id).data("description"))
        $("#editForm").attr("action","{{url('users/purchase')}}"+"/"+id)
    }
    
    function deleteData(id){
        $("#deleteForm").attr("action","{{url('users/purchase')}}"+"/"+id)
    }
</script>
@stop