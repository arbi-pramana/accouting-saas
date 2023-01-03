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
                <li class="breadcrumb-item ">Entri Jurnal</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
    <form action="{{route('journal.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mr-4">Tambah Entri Jurnal</h4>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Document No</label>
                                <input type="text" name="document_no" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Reference</label>
                                <input type="text" name="reference" class="form-control">
                            </div>
                            <div class="col-md-8 mt-4">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-right">
                            <label class="btn btn-success" onclick="addData()"><i class="fa fa-plus"></i> Tambah Akun</label>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <th>Akun</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @php
                                    $uuid = Ramsey\Uuid\Uuid::uuid1();
                                @endphp
                                <tr id="tr_{{$uuid}}">
                                    <td>
                                        <select name="coa_id[]" class="form-control select2" required>
                                            <option value=""></option>
                                            @foreach($coas as $coa)
                                                <option value="{{$coa->id}}">{{$coa->coa}} - {{$coa->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td> <input type="number" name="debit[]" id="debit_{{$uuid}}" class="form-control debit" value="0" onchange="changeAmount('{{$uuid}}')"> </td>
                                    <td> <input type="number" name="credit[]" id="credit_{{$uuid}}" class="form-control credit" value="0" onchange="changeAmount('{{$uuid}}')"> </td>
                                    <td>
                                        <textarea name="description_item[]" class="form-control" cols="30" rows="10"></textarea>
                                    </td>
                                    <td>
                                        <div id="amount_{{$uuid}}" class="amounts"></div>
                                    </td>
                                    <td> <label class="btn btn-sm btn-danger" onclick="deleteData('{{$uuid}}')"> <i class="fa fa-trash"></i> </label> </td>
                                </tr>
                            </tbody>
                            <tbody id="addData">
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right"><b> Total Credit (Rp.) : </b></td>
                                    <td id="total_credit"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right"><b> Total Debit (Rp.) : </b></td>
                                    <td id="total_debit"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                            <button class="btn btn-success">Tambah Journal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop
@section('scripts')
<script>
    $(".select2").select2({
        width:"300px",
        height:"70px"
    });
</script>
<script>
    function uuidv4() {
        return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }
</script>
<script>
    function addData(){
        var uuid = uuidv4()
        $("#addData").append(`
            <tr id="tr_`+uuid+`">
                <td>
                    <select name="coa_id[]" class="form-control select2" required>
                        <option value=""></option>
                        @foreach($coas as $coa)
                            <option value="{{$coa->id}}">{{$coa->coa}} - {{$coa->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td> <input type="number" name="debit[]" id="debit_`+uuid+`" class="form-control debit" value="0" onchange="changeAmount('`+uuid+`')"> </td>
                <td> <input type="number" name="credit[]" id="credit_`+uuid+`" class="form-control credit" value="0" onchange="changeAmount('`+uuid+`')"> </td> 
                <td>
                    <textarea name="description_item[]" class="form-control" cols="30" rows="10"></textarea>
                </td>
                <td>
                    <div id="amount_`+uuid+`"></div>
                </td>
                <td> <label class="btn btn-sm btn-danger" onclick="deleteData('`+uuid+`')"> <i class="fa fa-trash"></i> </label> </td>
            </tr>
        `)
        $(".select2").select2({
            width:"300px",
            height:"70px"
        });
    }
</script>
<script>
    function changeAmount(id,type){
        var sum_debit = 0;
        var sum_credit = 0;
        
        $("#amount_"+id)[0].innerHTML = Math.abs( parseFloat($("#debit_"+id).val()) - parseFloat($("#credit_"+id).val()) )
        
        //debit
        $('.debit').each(function(){
            sum_debit += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
        });
        $("#total_debit")[0].innerHTML = sum_debit

        //credit
        $('.credit').each(function(){
            sum_credit += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
        });
        $("#total_credit")[0].innerHTML = sum_credit
    }

</script>
<script>
    function deleteData(id){
        $("#tr_"+id).remove()
    }
</script>
@stop