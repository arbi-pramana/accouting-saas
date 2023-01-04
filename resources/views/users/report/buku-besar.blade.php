@extends('users.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- breadcumbs -->
    <div class="row page-titles">
        <div class="col p-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Users</a>
                </li>
                <li class="breadcrumb-item ">Double Entry</li>
                <li class="breadcrumb-item active">Laporan Buku Besar</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title mr-4">Laporan Buku Besar</h4>
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
                    <table class="table table-hover mt-4">
                        <thead class="bg-primary">
                            <th>Coa</th>
                            <th>Kategori</th>
                            <th>Name</th>
                            <th>Saldo Awal</th>
                            <th>Trx Debit</th>
                            <th>Trx Credit</th>
                            <th>Saldo Akhir</th>
                        </thead>
                        <tbody>
                            @if($coas->count() > 0)
                                @foreach($coas as $coa)
                                    <tr>
                                        <td>{{$coa->coa}}</td>
                                        <td style="width:250px;">{{$coa->category_2}}</td>
                                        <td>{{$coa->name}}</td>
                                        <td>{{Format::price($coa->total_opening_balance)}}</td>
                                        <td>{{Format::price(Coa::saldoByRange($coa->id)['debit'])}}</td>
                                        <td>{{Format::price(Coa::saldoByRange($coa->id)['credit'])}}</td>
                                        <td>{{Format::price($coa->total_opening_balance + Coa::saldoByRange($coa->id)['debit'] - Coa::saldoByRange($coa->id)['credit'])}}</td>
                                        @php
                                            $total_debit[] = Coa::saldoByRange($coa->id)['debit'];
                                            $total_credit[] = Coa::saldoByRange($coa->id)['credit'];
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4"></td>
                                    <td> {{Format::price(array_sum($total_debit))}} </td>
                                    <td> {{Format::price(array_sum($total_credit))}} </td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop