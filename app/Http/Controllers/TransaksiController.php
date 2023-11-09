<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function show(Request $request)
    {
        $code=$request->query('code');
        $conv=(string)$code;
        if (empty($conv)){
            $transaksi = DB::table('transaksi')->join('produk','transaksi.id_produk','=','produk.id')->join('customer','transaksi.id_customer','=','customer.id')->
            select('produk.nama_produk as produk_nama','customer.nama_customer as customer_nama','transaksi.qty','transaksi.transaksi_date','transaksi.is_void','transaksi.harga','transaksi.id','transaksi.keterangan')->paginate(5);

            return view('Transaksi.transaksi', ['data' => $transaksi]);
        }
        else{
            $produk=Produk::all();
            $customer=Customer::all();
            $data['produk']=$produk;
            $data['customer']=$customer;
            return view('Transaksi.transaksi_create',['data'=>$data]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_customer' => 'required|integer',
            'qty' => 'required|integer',
            'harga'=>'required|integer',
            'id_produk'=>'required|integer'
        ]);
        $transaksi = DB::table('transaksi')->insert([
            'qty' => $request->qty,
            'harga'=>$request->harga,
            'id_produk'=>$request->id_produk,
            'id_customer'=>$request->id_customer,
            'transaksi_date'=>date('
            Y-m-d H:m:s'),
            'is_void'=>false,
            'keterangan'=>"OK"
        ]);
        return redirect()->route('transaksi')->with('success', 'Created Transaksi');
    }
    public function get_id($id,Request $request)
    {
        $a=(int)filter_var($request->query('is_void'), FILTER_VALIDATE_BOOLEAN);

        $transaksi= Transaksi::findOrFail($id);
        $transaksi->is_void =$a;
        if ($transaksi->is_void){
            $transaksi->keterangan="Batal";
        }
        else{
            $transaksi->keterangan="OK";
        }
        $transaksi->update();

       
        
    }
    public function filter(Request $request){
       
        $to=$request->query('date_to');
        $from=$request->query('date_from');
        $transaksi = DB::table('transaksi')->join('produk','transaksi.id_produk','=','produk.id')->join('customer','transaksi.id_customer','=','customer.id')->
        select('produk.nama_produk as produk_nama','customer.nama_customer as customer_nama','transaksi.qty','transaksi.transaksi_date','transaksi.is_void','transaksi.harga','transaksi.id','transaksi.keterangan')->whereBetween('transaksi.transaksi_date',[$from,$to])->paginate(5);;
        return view('Transaksi.transaksi',['data'=>$transaksi]);
    }

}