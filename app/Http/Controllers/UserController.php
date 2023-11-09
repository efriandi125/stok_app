<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserController extends Controller
{
    

    public function show(Request $request)
    {
        $code=$request->query('code');
        $conv=(string)$code;
        if (empty($conv)){
            $user = User::paginate(5);

            return view('User.user', ['data' => $user]);
        }
        else{
            return view('User.user_create');
        }
      
    }
    public function search(Request $request){
        $find=$request->query('search');
        $conv=(string)$find;
        if($conv==''){
            $user=User::paginate(5);
            return view('User.user', ['data' => $user]);
        }
        else{
            $user=User::where('nama','LIKE','%'.$request->search.'%')->paginate(5);
            return view('User.user', ['data' => $user]);
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'level'=> 'required|string',
        ]);
        $user = DB::table('user')->insert([
            'nama' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level'=> $request->level,
        ]);
        return redirect()->route('user')->with('success', 'Created User');
    }
    public function get_id($id,Request $request)
    {
        $user = User::findOrFail($id);
        $code=$request->query('code');
        $conv=(string)$code;
        switch($conv){
            case "e":
                return view('User.user_edit', ['user' => $user]);
            case "d":
                return view('Components.delete', ['data' => $user]);    
            default:
                return view('User.user',['data'=>$user]);
    }
}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->nama = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level=$request->level;
        $user->update();

    }

   
    public function drop($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

}