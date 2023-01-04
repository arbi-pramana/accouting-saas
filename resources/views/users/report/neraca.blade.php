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
                <li class="breadcrumb-item active">Laporan Neraca</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title mr-4">Laporan Neraca</h4>
                </div>
                <div class="col-4">
                    <div class="form-inline">
                        <form action="?" method="get">
                            <select name="month" class="form-control" style="width:200px;" required>
                                <option value="01" @if(request('month') == '01') selected @endif >January</option>
                                <option value="02" @if(request('month') == '02') selected @endif >February</option>
                                <option value="03" @if(request('month') == '03') selected @endif >March</option>
                                <option value="04" @if(request('month') == '04') selected @endif >April</option>
                                <option value="05" @if(request('month') == '05') selected @endif >May</option>
                                <option value="06" @if(request('month') == '06') selected @endif >June</option>
                                <option value="07" @if(request('month') == '07') selected @endif >July</option>
                                <option value="08" @if(request('month') == '08') selected @endif >August</option>
                                <option value="09" @if(request('month') == '09') selected @endif >September</option>
                                <option value="10" @if(request('month') == '10') selected @endif >October</option>
                                <option value="11" @if(request('month') == '11') selected @endif >November</option>
                                <option value="12" @if(request('month') == '12') selected @endif >December</option>
                            </select>
                            <select name="year" class="form-control" style="width:200px;" required>
                                @for($i=date('Y');$i >= date('Y') - 10 ; $i--)
                                    <option value="{{$i}}" @if(request('year') == $i) selected @endif >{{$i}}</option>
                                @endfor
                            </select>
                            <input type="submit" class="btn btn-success" value="Filter">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead class="bg-primary">
                            <th>Neraca</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @foreach($collections as $i => $collections)
                                <tr class="bg-dark">
                                    <td>{{$i}}</td>
                                    <td></td>
                                </tr>
                                @foreach($collections as $j => $coas)
                                    <tr class="bg-light">
                                        <td style="padding-left:20px;">{{$j}}</td>
                                        <td></td>
                                    </tr>
                                    @foreach($coas as $k => $coa)
                                        <tr>
                                            <td style="padding-left:40px;">{{$coa->name}}</td>
                                            @if(Coa::saldo($coa->id) < 0)
                                                <td class="text-danger">{{Format::price(abs(Coa::saldo($coa->id)))}}</td>
                                            @else
                                                <td>{{Format::price(Coa::saldo($coa->id))}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop