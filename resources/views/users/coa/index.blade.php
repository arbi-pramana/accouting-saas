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
                <li class="breadcrumb-item active">Chart of Account</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Data Chart of Account</h4>
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
                                    <th>Kategori 1</th>
                                    <th>Kategori 2</th>
                                    <th>Nama Akun</th>
                                    <th>Saldo Awal (D)</th>
                                    <th>Saldo Awal (K)</th>
                                    <th>Total Saldo Awal</th>
                                    <th>Date</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coas as $i => $coa)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{$coa->category_1}} </td>
                                        <td> {{$coa->category_2}} </td>
                                        <td> {{$coa->name}} </td>
                                        <td> {{$coa->opening_balance_db}} </td>
                                        <td> {{$coa->opening_balance_cr}} </td>
                                        <td> {{$coa->total_opening_balance}} </td>
                                        <td> {{Format::date_format($coa->date)}} </td>
                                        <td> {{$coa->remarks}} </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                id="edit-{{$coa->id}}"
                                                data-id="{{$coa->id}}" 
                                                data-coa="{{$coa->coa}}"
                                                data-category_1="{{$coa->category_1}}"
                                                data-category_2="{{$coa->category_2}}"
                                                data-name="{{$coa->name}}"
                                                data-opening_balance_db="{{$coa->opening_balance_db}}"
                                                data-opening_balance_cr="{{$coa->opening_balance_cr}}"
                                                data-total_opening_balance="{{$coa->total_opening_balance}}"
                                                data-date="{{$coa->date}}"
                                                data-is_locked="{{$coa->is_locked}}"
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                onclick="editData('{{$coa->id}}')"
                                                ><i class="fa fa-pencil"></i> </button>
                                            @if($coa->is_locked != 1)
                                                <button type="button" class="btn btn-sm btn-danger" 
                                                    data-toggle="modal" 
                                                    data-target="#modalDelete"
                                                    onclick="deleteData('{{$coa->id}}')"
                                                ><i class="fa fa-trash"></i>  </button>
                                            @else
                                            @endif
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
            <form action="{{route('coa.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    COA <br>
                    <input type="text" name="coa" id="coa" class="form-control" required><br>
                    Kategori 1 <br>
                    <input type="text" name="category_1" id="category_1" class="form-control" required><br>
                    Kategori 2 <br>
                    <input type="text" name="category_2" id="category_2" class="form-control" required><br>
                    Nama Akun <br>
                    <input type="text" name="name" id="name" class="form-control" required><br>
                    Saldo Awal (D) <br>
                    <input type="text" name="opening_balance_db" id="opening_balance_db" class="form-control" required><br>
                    Saldo Awal (K) <br>
                    <input type="text" name="opening_balance_cr" id="opening_balance_cr" class="form-control" required><br>
                    Total Saldo Awal <br>
                    <input type="text" name="total_opening_balance" id="total_opening_balance" class="form-control" readonly><br>
                    Tanggal <br>
                    <input type="date" name="date" id="date" class="form-control" required><br>
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
                    COA <br>
                    <input type="text" name="coa" id="edit-coa" class="form-control" required><br>
                    Kategori 1 <br>
                    <input type="text" name="category_1" id="edit-category_1" class="form-control" required><br>
                    Kategori 2 <br>
                    <input type="text" name="category_2" id="edit-category_2" class="form-control" required><br>
                    Nama Akun <br>
                    <input type="text" name="name" id="edit-name" class="form-control" required><br>
                    Saldo Awal (D) <br>
                    <input type="text" name="opening_balance_db" id="edit-opening_balance_db" class="form-control" required><br>
                    Saldo Awal (K) <br>
                    <input type="text" name="opening_balance_cr" id="edit-opening_balance_cr" class="form-control" required><br>
                    Total Saldo Awal <br>
                    <input type="text" name="total_opening_balance" id="edit-total_opening_balance" class="form-control" readonly><br>
                    Tanggal <br>
                    <input type="date" name="date" id="edit-date" class="form-control" required><br>
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
    $("#opening_balance_db,#opening_balance_cr").keyup(function(){
        var db = $("#opening_balance_db").val()
        var cr = $("#opening_balance_cr").val()
        $("#total_opening_balance").val(db - cr)
    })

    $("#edit-opening_balance_db,#edit-opening_balance_cr").keyup(function(){
        var db = $("#edit-opening_balance_db").val()
        var cr = $("#edit-opening_balance_cr").val()
        $("#edit-total_opening_balance").val(db - cr)
    })

    function editData(id){
        if($("#edit-"+id).data("is_locked") == 1){
            $("#edit-coa").attr("readonly","readonly")
            $("#edit-category_1").attr("readonly","readonly")
            $("#edit-category_2").attr("readonly","readonly")
            $("#edit-name").attr("readonly","readonly")
        }
        $("#edit-coa").val($("#edit-"+id).data("coa"))
        $("#edit-category_1").val($("#edit-"+id).data("category_1"))
        $("#edit-category_2").val($("#edit-"+id).data("category_2"))
        $("#edit-name").val($("#edit-"+id).data("name"))
        $("#edit-opening_balance_db").val($("#edit-"+id).data("opening_balance_db"))
        $("#edit-opening_balance_cr").val($("#edit-"+id).data("opening_balance_cr"))
        $("#edit-total_opening_balance").val($("#edit-"+id).data("total_opening_balance"))
        $("#edit-date").val($("#edit-"+id).data("date"))
        $("#editForm").attr("action","{{url('users/coa')}}"+"/"+id)
    }
    
    function deleteData(id){
        $("#deleteForm").attr("action","{{url('users/coa')}}"+"/"+id)
    }
</script>
@stop