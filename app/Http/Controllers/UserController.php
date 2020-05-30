<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Masyarakat;
class UserController extends Controller
{
    //
    public function DaftarPengguna (Request $request){

  $data = ([
    'username' => $request->username,
    'email' => $request->email,
    'password' =>bcrypt($request->password),
    'role' => 'masyarakat',
    'token'=>$request->token,

  ]);
  $lastid = User::create($data)->id;
   
  $mas = new Masyarakat;
  $mas->nama =$request->username;
   $mas->nohp =$request->nohp;
    $mas->alamat =$request->alamat;
     $mas->user_id =$lastid;
     $mas->save();

      if (($data&&$mas)) {
             $out = [
                 "message" => "register_success",
                 "code"    => 201,
             ];
         } else {
             $out = [
                 "message" => "failed_register",
                 "code"   => 404,
             ];
          }
 
         return response()->json($out, $out['code']);
     // return response()->json()
    	// $data = new User;
     //    $data->username = $request->input('username');
    	// $data->email = $request->input('email');
     //    $pas = $request->input('password');
     //    $data->password = bcrypt($pas);
     //    $data->role = $request->input('role');
    	// $data->save();
     //    if (($data)) {
     //        $out = [
     //            "message" => "register_success",
     //            "code"    => 201,
     //        ];
     //    } else {
     //        $out = [
     //            "message" => "failed_register",
     //            "code"   => 404,
     //        ];
        //  }
 
        // return response()->json($out, $out['code']);
    }
    	// return "Berhasil";


  public function MasukPengguna(Request $request){
   

     $user= User::where('email', $request->email)->first();
        $token =([
        'token'=> $request->token
        ]);
        $user->update($token);
        // return data::all();
    $logins = DB::table('user')
   ->where('email', $request->input('email'))
   // ->where('password', $request->password)
   ->first();

   if(Hash::check($request->input('password'),$logins->password)){

    
   $result["success"] = "1";
    $result["message"] = "success";
    //untuk memanggil data sesi Login
    $result["id"] = $logins->id;
    $result["username"] = $logins->username;
    $result["password"] = $logins->password;
    $result["email"] = $logins->email;
    $result["role"] = $logins->role;

    return response()->json($result);
   }
 }
}
