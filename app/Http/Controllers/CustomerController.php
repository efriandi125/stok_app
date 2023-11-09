<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerController extends Controller
{

    public function show(Request $request)
    {
        $code=$request->query('code');
        $conv=(string)$code;
        if (empty($conv)){
            $customer = Customer::paginate(5);

            return view('Customer.customer', ['data' => $customer]);
        }
        else{
            return view('Customer.customer_create');
        }
    }
    public function search(Request $request){
        $find=$request->query('search');
        $conv=(string)$find;
        if($conv==''){
            $customer=Customer::paginate(5);
            return view('Customer.customer', ['data' => $customer]);
        }
        else{
            $customer=Customer::where('nama_customer','LIKE','%'.$request->search.'%')->paginate(5);
            return view('Customer.customer', ['data' => $customer]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_customer' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string'
        ]);
        $customer = DB::table('customer')->insert([
            'nama_customer' => $request->nama_customer,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);
        return redirect()->route('customer')->with('success', 'Created Customer');
    }
    public function get_id($id,Request $request)
    {
        $customer = Customer::findOrFail($id);
        $code=$request->query('code');
        $conv=(string)$code;
        switch($conv){
            case "e":
                return view('Customer.customer_edit', ['customer' => $customer]);
            case "d":
                return view('Components.delete', ['data' => $customer]);
            default:
                return view('Çustomer.customer',['data'=>$customer]);
        }
       
        
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->nama_customer = $request->nama_customer;
        $customer->alamat = $request->alamat;
        $customer->no_hp = $request->no_hp;
        $customer->update();

    }

    public function drop($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
    }

}