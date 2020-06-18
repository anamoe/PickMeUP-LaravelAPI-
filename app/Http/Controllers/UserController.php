<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Masyarakat;

class UserController extends Controller

{

    public function DaftarPengguna (Request $request){
      $cekemail=User::where('email',$request->email)->first();
      if ($cekemail) {
     
        $pesan ="Email Sudah Digunakan";
  
        return($pesan);

        }else{

          $data = ([
          'username' => $request->username,
          'email' => $request->email,
          // 'email' => $request->get('email'),
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

          $pesan="Selamat Anda Berhasil Daftar, Silahkan Login";
    
         return ($pesan);       
      }

    }

    public function MasukPengguna(Request $request){
    
      $email=$request->input('email');
      $password=$request->input('password');
      $logins= User::where('email', $email)->orWhere('username', $email)->first();
        $token =([
        'token'=> $request->token
        ]);
        $logins->update($token);

      if(Hash::check($password,$logins->password)){
    
          $result["success"] = "1";
          $result["message"] = "success";
          //untuk memanggil data sesi Login
          $result["id"] = $logins->id;
          $result["username"] = $logins->username;
          $result["password"] = $logins->password;
          $result["email"] = $logins->email;
          $result["role"] = $logins->role;

        return response()->json($result);
      }else{

         $result["success"] = "0";
         $result["message"] = "error";
         return response()->json($result);
     }
    }
}
