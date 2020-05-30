<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PetugasKontenReward;

class PetugasKontenRewardController extends Controller
{
    //
         public function PetugasKontenReward()
	{
		$hadiahku= PetugasKontenReward::all();

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

   	 public function TambahPetugasKontenReward (Request $request){
    	$data = new PetugasKontenReward;
    	$data->nama = $request->input('nama');
    	$data->nohp = $request->input('nohp');
    	$data->alamat = $request->input('alamat');
    	$data->save();

    	return "Berhasil";
    }
}
