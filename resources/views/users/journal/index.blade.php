@extends('users.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- breadcumbs -->
    <div class="row page-titles">
        <div class="col p-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Users</a>
                </li>
                <li class="breadcrumb-item">Double Entry</li>
                <li class="breadcrumb-item active">Entri Jurnal</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Entri Jurnal</h4>
                        <a href="{{route('journal.create')}}" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> Tambah Baru </a>
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
                                    <th>Document No</th>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Description</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($journals as $i => $journal)
                                    <tr>
                                        <td> {{$i+1}} </td>
                                        <td> {{$journal->document_no}} </td>
                                        <td> {{Format::date_format($journal->date)}} </td>
                                        <td> {{$journal->reference}} </td>
                                        <td> {{$journal->description}} </td>
                                        <td> {{$journal->remarks}} </td>
                                        <td>
                                            <a href="{{route('journal.edit',['journal'=>$journal->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#modalDelete"
                                            onclick="deleteData('{{$journal->id}}')"
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
    function deleteData(id){
        $("#deleteForm").attr("action","{{url('users/journal')}}"+"/"+id)
    }
</script>
@stop