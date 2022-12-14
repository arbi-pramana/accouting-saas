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
                <li class="breadcrumb-item active">Pelanggan</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Data Pelanggan</h4>
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Description</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $i => $customer)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{$customer->name}} </td>
                                        <td> {{$customer->email}} </td>
                                        <td> {{$customer->phone}} </td>
                                        <td> {{$customer->address}} </td>
                                        <td> {{$customer->description}} </td>
                                        <td> {{$customer->remarks}} </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                id="edit-{{$customer->id}}"
                                                data-id="{{$customer->id}}" 
                                                data-name="{{$customer->name}}" 
                                                data-email="{{$customer->email}}" 
                                                data-phone="{{$customer->phone}}" 
                                                data-address="{{$customer->address}}" 
                                                data-description="{{$customer->description}}" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                onclick="editData('{{$customer->id}}')"
                                                ><i class="fa fa-pencil"></i> </button>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#modalDelete"
                                            onclick="deleteData('{{$customer->id}}')"
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
            <form action="{{route('customer.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    Name <br>
                    <input type="text" class="form-control" name="name" required><br>
                    Email <br>
                    <input type="email" class="form-control" name="email" required><br>
                    Phone <br>
                    <input type="text" class="form-control" name="phone" required><br>
                    Address <br>
                    <textarea name="address" class="form-control" cols="30" rows="10"></textarea>
                    Description <br>
                    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
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
    function editData(id){
        $("#edit-name").val($("#edit-"+id).data("name"))
        $("#edit-email").val($("#edit-"+id).data("email"))
        $("#edit-phone").val($("#edit-"+id).data("phone"))
        $("#edit-address").val($("#edit-"+id).data("address"))
        $("#edit-description").val($("#edit-"+id).data("description"))
        $("#editForm").attr("action","{{url('users/customer')}}"+"/"+id)
    }
    
    function deleteData(id){
        $("#deleteForm").attr("action","{{url('users/customer')}}"+"/"+id)
    }
</script>
@stop