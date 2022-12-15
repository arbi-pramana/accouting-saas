@extends('users.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- breadcumbs -->
    <div class="row page-titles">
        <div class="col p-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Users</a>
                </li>
                <li class="breadcrumb-item active">Data Master</li>
                <li class="breadcrumb-item active">Barang</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Data Barang</h4>
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
                                    <th>Name</th>
                                    <th>Kategori</th>
                                    <th>Unit</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Beli</th>
                                    <th>Saldo Awal (Qty)</th>
                                    <th>Saldo Awal (IDR)</th>
                                    <th>Remarks</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $i => $product)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{$product->name}} </td>
                                        <td> {{$product->category ? $product->category->name : ''}} </td>
                                        <td> {{$product->unit}} </td>
                                        <td> {{Format::price($product->sell_price)}} </td>
                                        <td> {{Format::price($product->purchase_price)}} </td>
                                        <td> {{$product->opening_quantity}} </td>
                                        <td> {{Format::price($product->opening_quantity * $product->purchase_price)}} </td>
                                        <td> {{$product->remarks}} </td>
                                        <td> {{Format::date_format($product->created_at)}} </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                id="edit-{{$product->id}}"
                                                data-id="{{$product->id}}" 
                                                data-name="{{$product->name}}" 
                                                data-category_id="{{$product->category_id}}" 
                                                data-unit="{{$product->unit}}" 
                                                data-sell_price="{{$product->sell_price}}" 
                                                data-purchase_price="{{$product->purchase_price}}" 
                                                data-opening_quantity="{{$product->opening_quantity}}" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                onclick="editData('{{$product->id}}')"
                                                ><i class="fa fa-pencil"></i> </button>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#modalDelete"
                                            onclick="deleteData('{{$product->id}}')"
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
            <form action="{{route('product.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    Name <br>
                    <input type="text" class="form-control" name="name" required><br>
                    Kategori <br>
                    <select name="category_id" class="form-control">
                        @foreach($categorys as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select> <br>
                    Unit <br>
                    <input type="text" class="form-control" name="unit" required><br>
                    Harga Jual <br>
                    <input type="text" class="form-control" name="sell_price" required><br>
                    Harga Beli <br>
                    <input type="text" class="form-control" name="purchase_price" required><br>
                    Saldo Awal <br>
                    <input type="text" class="form-control" name="opening_quantity" required><br>
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
                    <input type="text" class="form-control" name="name" id="edit-name" required><br>
                    Kategori <br>
                    <select name="category_id" id="edit-category_id" class="form-control">
                        @foreach($categorys as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select> <br>
                    Unit <br>
                    <input type="text" class="form-control" name="unit" id="edit-unit" required><br>
                    Harga Jual <br>
                    <input type="text" class="form-control" name="sell_price" id="edit-sell_price" required><br>
                    Harga Beli <br>
                    <input type="text" class="form-control" name="purchase_price" id="edit-purchase_price" required><br>
                    Saldo Awal <br>
                    <input type="text" class="form-control" name="opening_quantity" id="edit-opening_quantity" required><br>
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
    function editData(id){
        $("#edit-name").val($("#edit-"+id).data("name"))
        $("#edit-category_id").val($("#edit-"+id).data("category_id"))
        $("#edit-unit").val($("#edit-"+id).data("unit"))
        $("#edit-sell_price").val($("#edit-"+id).data("sell_price"))
        $("#edit-purchase_price").val($("#edit-"+id).data("purchase_price"))
        $("#edit-opening_quantity").val($("#edit-"+id).data("opening_quantity"))
        $("#editForm").attr("action","{{url('users/product')}}"+"/"+id)
    }
    
    function deleteData(id){
        $("#deleteForm").attr("action","{{url('users/product')}}"+"/"+id)
    }
</script>
@stop