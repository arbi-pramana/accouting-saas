@extends('users.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- breadcumbs -->
    <div class="row page-titles">
        <div class="col p-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Users</a>
                </li>
                <li class="breadcrumb-item active">Business Info</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-inline">
                        <h4 class="card-title mr-4">Business Info</h4>
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
                    <br>
                    <form action="#" method="post">
                        @csrf
                        <label>Nama Perusahaan</label>
                        <input type="text" name="company" class="form-control" value="{{$setting ? $setting->company : '' }}"><br>
                        <label>Alamat</label>
                        <textarea name="address" id="" cols="30" rows="15" class="form-control">{{$setting ? $setting->address : '' }}</textarea><br>
                        <label>Periode Akuntansi</label>
                        <input type="date" name="accounting_periods" class="form-control" value="{{$setting ? $setting->accounting_periods : '' }}">
                        <br>
                        <button class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop