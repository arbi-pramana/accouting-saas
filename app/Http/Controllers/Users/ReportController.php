<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    use UserTrait;

    public function neraca(Request $request)
    {
        $data['collections'] = Coa::where('create_by',$this->create_by())
            ->get()
            ->groupBy(['category_1','category_2']);
        return view('users.report.neraca',$data);
    }

    public function labaRugi(Request $request)
    {
        $collection = new Collection();
        $pendapatan = Coa::where('create_by',$this->create_by())->where('category_1','5. Pendapatan')->get();
        $hpp = Coa::where('create_by',$this->create_by())->where('category_1','6. Harga Pokok Penjualan')->get();
        $biaya_operasional = Coa::where('create_by',$this->create_by())->where('category_1','7. Biaya Operasional')->get();
        $pendapatan_lainnya = Coa::where('create_by',$this->create_by())->where('category_1','8. Pendapatan (Biaya) Lain-Lain')->get();
        $pajak_penghasilan = Coa::where('create_by',$this->create_by())->where('category_1','9. Pajak Penghasilan')->get();
        $data['collections'] = $collection->merge([$pendapatan,$hpp,$biaya_operasional,$pendapatan_lainnya,$pajak_penghasilan]);
        return view('users.report.laba-rugi',$data);
    }

    public function bukuBesar(Request $request)
    {
        $data['coas'] = Coa::where('create_by',$this->create_by())
            ->when($request->start,function($q) use ($request){
                $q->whereBetween('date',[$request->start,$request->end]);
                return $q;
            })
            ->orderBy('category_1')
            ->get();
        return view('users.report.buku-besar',$data);
    }
}
