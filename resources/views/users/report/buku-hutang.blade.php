@extends('users.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- breadcumbs -->
    <div class="row page-titles">
        <div class="col p-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Users</a>
                </li>
                <li class="breadcrumb-item ">Laporan</li>
                <li class="breadcrumb-item active">Buku Hutang</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title mr-4">Buku Hutang</h4>
                    <table>
                        <tr>
                            <td><b>  Total Saldo Awal  </b></td>
                            <td class="pl-4"> : {{ Format::price($suppliers->sum('opening_balance'))}}</td>
                        </tr>
                        <tr>
                            <td><b>  Total Pembelian  </b></td>
                            <td class="pl-4"> : {{ Format::price($purchases->where('type','Pembelian')->sum('total'))}} </td>
                        </tr>
                        <tr>
                            <td><b> Total Hutang Dagang </b></td>
                            <td class="pl-4"> : {{ Format::price($purchases->where('type','Pembelian')->sum('payment_due_amount'))}}</td>
                        </tr>
                        <tr>
                            <td><b> Total Retur Pembelian </b></td>
                            <td class="pl-4"> : {{ Format::price($purchases->where('type','Retur Pembelian')->sum('payment_due_amount'))}}</td>
                        </tr>
                        <tr>
                            <td><b> Total Saldo Akhir </b></td>
                            <td class="pl-4"> 
                                : {{ Format::price(
                                $suppliers->sum('opening_balance')
                                + $purchases->where('type','Pembelian')->sum('total')
                                - $purchases->where('type','Pembelian')->sum('payment_due_amount')
                                - $purchases->where('type','Retur Pembelian')->sum('payment_due_amount')
                                )}} 
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-4">
                    <form action="?" method="get">
                        <div class="form-inline">
                            <input type="date"  name="start" class="form-control" value="{{request('start')}}" required> 
                            - 
                            <input type="date" name="end" class="form-control" value="{{request('end')}}" required>
                            <button class="btn btn-success ml-2">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped zero-configuration mt-4">
                        <thead class="bg-dark">
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Saldo Awal</th>
                            <th>Pembelian</th>
                            <th>Hutang Dagang</th>
                            <th>Retur Pembelian</th>
                            <th>Saldo Akhir</th>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $i => $supplier)
                                <tr>
                                    <td> {{$i+1}} </td>
                                    <td> {{$supplier->name}} </td>
                                    <td> {{Format::price($supplier->opening_balance)}} </td>
                                    <td> {{Format::price($supplier->hutang_dagang->sum('total'))}} </td>
                                    <td> {{Format::price($supplier->hutang_dagang->sum('payment_due_amount'))}} </td>
                                    <td> {{Format::price($supplier->retur_pembelian->sum('total'))}} </td>
                                    <td> 
                                        {{Format::price(
                                            $supplier->opening_balance
                                            + $supplier->hutang_dagang->sum('total')
                                            - $supplier->hutang_dagang->sum('payment_due_amount')
                                            - $supplier->retur_pembelian->sum('total')
                                        )}}
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
@stop