<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    public function show(Request $request)
    {
        $code=$request->query('code');
        $conv=(string)$code;
        if (empty($conv)){
            $category = Category::paginate(5);

            return view('Category.category', ['data' => $category]);
        }
        else{
            return view('Category.category_create');
        }
    }
    public function search(Request $request){
        $find=$request->query('search');
        $conv=(string)$find;
        if($conv==''){
            $category=Category::paginate(5);
            return view('Category.category', ['data' => $category]);
        }
        else{
            $category=Category::where('nama','LIKE','%'.$request->search.'%')->paginate(5);
            return view('Category.category', ['data' => $category]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'jenis' => 'required|string'
        ]);
        $category = DB::table('category')->insert([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            
        ]);
        return redirect()->route('category')->with('success', 'Created Category');
    }
    public function get_id($id,Request $request)
    {
        $category = Category::findOrFail($id);
        $code=$request->query('code');
        $conv=(string)$code;
        switch($conv){
            case "e":
                return view('Category.category_edit', ['category' => $category]);
            case "d":
                return view('Components.delete', ['data' => $category]);
            default:
                return view('Çategory.category',['data'=>$category]);
        }
       
        
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->nama = $request->nama;
        $category->jenis = $request->jenis;
        $category->update();

    }

    public function drop($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
}