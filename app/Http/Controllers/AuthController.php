<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function index()
    {
        //menampilkan semua data
        $users = User::all();
        return response()->json($users);

        // return view('user.index', ['users' => $users]);
    }
    public function show($id){
        //menampilkan data berdasarkan id
        $user = User::find($id);
        return response()->json($user);

    }
    public function store(Request $request){
        

        //bagian pertama
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required | email',
        //     'password' => 'required'
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if ($validator->fails()) :
            return response()->json([
                "status"=>false,
                "message"=>$validator->errors()
            ],403);
            endif;
        //cara kedua
        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);
        //menginput data cara pertama
        // $user=new User;
        // $user->name=$request->name;
        // $user->password= Hash::make($request->password);
        // $user->email=$request->email;

        // $user->save();
        return response()->json([
            "status"=>true,
            "message"=>"Data Berhasil Disimpan",
            "data"=>$user
            ]);
        
    }
    public function destroy ($id){
        $user=User::find($id);
        $user->delete();
        return response()->json([
            "status"=>true,
            "message"=>"Data Berhasil Dihapus",
            ]);
    }

    public function update ($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email'
        ]);
        if ($validator->fails()) :
            return response()->json([
                "status"=>false,
                "message"=>$validator->errors()
            ],403);
            endif;

        User::where('id', $id)
        ->update([
            'name' => $request->name,
            'email'=> $request->email
            ]);
        return response()->json([
            "status"=>true,
            "message"=>"Data Berhasil Diubah",
            ]);;
    }
}
