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
                <li class="breadcrumb-item active">Laporan Laba Rugi</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title mr-4">Laporan Laba Rugi</h4>
                </div>
                <div class="col-2">
                    <div class="form-inline">
                        <form action="?" method="get">
                            <select name="year" class="form-control" style="width:120px;" required>
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
                <div class="col-12">
                    <table class="table table-hover">
                        <thead class="bg-primary">
                            <th>Total Laba Rugi</th>
                            <th colspan="12">Periode</th>
                        </thead>
                        <thead class="bg-primary">
                            <th>Rugi Laba</th>
                            @for($i=1;$i<=12;$i++)
                                <th>{{$i}}</th>
                            @endfor
                        </thead>
                        <tbody>
                            @foreach($collections as $i => $collection)
                                <tr class="bg-dark">
                                    <td>{{$collection->first()->category_1}}</td>
                                    <td colspan="12"></td>
                                </tr>
                                @foreach($collection->groupBy('category_2') as $j => $coas)
                                    <tr class="bg-light">
                                        <td style="padding-left: 20px;">{{$j}}</td>
                                        <td colspan="12"></td>
                                    </tr>
                                    @foreach($coas as $k => $coa)
                                        <tr>
                                            <td style="padding-left: 40px;">{{$coa->name}}</td>
                                            @for($l=1;$l<=12;$l++)
                                                @if(Coa::saldoByPeriod($coa->id,$l) >=0 )
                                                    <td> {{Format::price(Coa::saldoByPeriod($coa->id,$l))}} </td>
                                                @else
                                                    <td class="text-danger"> {{Format::price(Coa::saldoByPeriod($coa->id,$l))}} </td>
                                                @endif
                                                @php
                                                    $total[$l][] = Coa::saldoByPeriod($coa->id,$l);
                                                @endphp
                                            @endfor
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                        <tbody>
                            <tr>
                                <td><b> Total Laba Rugi </b></td>
                                @for($m=1;$m<=12;$m++)
                                    @if(array_sum($total[$m]) >= 0)
                                        <td><b> {{Format::price(array_sum($total[$m]))}} </b></td>
                                    @else
                                        <td class="text-danger"><b> {{Format::price(array_sum($total[$m]))}} </b></td>
                                    @endif
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop