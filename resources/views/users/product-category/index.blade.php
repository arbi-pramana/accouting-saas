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
                <li class="breadcrumb-item active">Kategori Barang</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Data Kategori Barang</h4>
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
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product_categorys as $i => $product_category)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{$product_category->name}} </td>
                                        <td> {{$product_category->remarks}} </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                id="edit-{{$product_category->id}}"
                                                data-id="{{$product_category->id}}" 
                                                data-name="{{$product_category->name}}" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                onclick="editData('{{$product_category->id}}')"
                                                ><i class="fa fa-pencil"></i> </button>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#modalDelete"
                                            onclick="deleteData('{{$product_category->id}}')"
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
            <form action="{{route('product-category.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    Name <br>
                    <input type="text" class="form-control" name="name" required><br>
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
        $("#edit-email").val($("#edit-"+id).data("email"))
        $("#edit-phone").val($("#edit-"+id).data("phone"))
        $("#edit-address").val($("#edit-"+id).data("address"))
        $("#edit-description").val($("#edit-"+id).data("description"))
        $("#editForm").attr("action","{{url('users/product-category')}}"+"/"+id)
    }
    
    function deleteData(id){
        $("#deleteForm").attr("action","{{url('users/product-category')}}"+"/"+id)
    }
</script>
@stop