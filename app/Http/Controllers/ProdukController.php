<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function show(Request $request)
    {
        $code=$request->query('code');
        $conv=(string)$code;
        if (empty($conv)){
            $produk = DB::table('produk')->join('category','produk.id_category','=','category.id')->select('produk.id as produk_id','produk.nama_produk','produk.qty','produk.harga','category.nama as category_name')->paginate(5);

            return view('Produk.produk', ['data' => $produk]);
        }
        else{
            $category=Category::all();
            return view('Produk.produk_create',['category'=>$category]);
        }
    }
    public function search(Request $request){
        $find=$request->query('search');
        $conv=(string)$find;
        if($conv==''){
            $produk=Produk::paginate(5);
            return view('Produk.produk', ['data' => $produk]);
        }
        else{
            $produk=Produk::where('nama_produk','LIKE','%'.$request->search.'%')->paginate(5);
            return view('Produk.produk', ['data' => $produk]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_produk' => 'required|string',
            'qty' => 'required|integer',
            'harga'=>'required|integer',
            'id_category'=>'required|integer'
        ]);
        $produk = DB::table('produk')->insert([
            'nama_produk' => $request->nama_produk,
            'qty' => $request->qty,
            'harga'=>$request->harga,
            'id_category'=>$request->id_category
        ]);
        return redirect()->route('produk')->with('success', 'Created Produk');
    }
    public function get_id($id,Request $request)
    {
        $produk = Produk::findOrFail($id);
        $code=$request->query('code');
        $conv=(string)$code;
        switch($conv){
            case "e":
                $category=Category::all();
                $cate=Category::findOrFail($produk->id_category);
                $data['produk']=$produk;
                $data['cate']=$cate;
                $data['category']=$category;
                return view('Produk.produk_edit', ['produk' => $data]);
            case "d":
                return view('Components.delete', ['data' => $produk]);
            default:
                return view('Produk.produk',['data'=>$produk]);
        }
       
        
    }
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->qty = $request->qty;
        $produk->harga=$request->harga;
        $produk->id_category=$request->id_category;
        $produk->update();

    }

    public function drop($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
    }

}