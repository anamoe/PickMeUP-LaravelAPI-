<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PimpinanEcoranger;

class PimpinanController extends Controller
{
    //
       public function Pimpinan()
	{
		$hadiahku= PimpinanEcoranger::all();

    foreach ($hadiahku as $value) {
        $array[]=[
            'nama' =>$value->nama,
            'nohp' =>$value->nohp,
            'alamat'=>$value->alamat,
            'role' => $value->user->role
        ];
       
    }
 		return response()->json([
            'pesan' =>'sukses lah',
            'upload' => $array

    	],200);
	}

   	 public function TambahPimpinan (Request $request){
    	$data = new PimpinanEcoranger;
    	$data->nama = $request->input('nama');
    	$data->nohp = $request->input('nohp');
    	$data->alamat = $request->input('alamat');
    	$data->save();

    	return "Berhasil";
    }
   
 
}
