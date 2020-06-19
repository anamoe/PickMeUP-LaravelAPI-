<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poin;
use App\User;
use App\Kode;
use App\Transaksi;
use App\Masyarakat;

class PoinController extends Controller

{

  public function LihatPoin(){

    $poin =Poin::all();
    return response()->json($poin);
    
  }

  public function TambahPoin(Request $request){
    	$data = new Poin;
    	$data->poin = $request->input('poin');
    	$data->save();

    		return "berhasil";
  }

  public function show( $id){
    $data =  Poin::where('user_id',$id)->first();
      $array[]=[
      'id'=> $data->id,
      'poin'=> $data->poin,
    
      ];
        return response()->json($array);
    }


   public function up( $id){
    $data =  User::findOrFail($id);
    $array=[
    'id'=> $data->id,
    'username'=> $data->username,
    'email'=>   $data->email,
       
];
        return response()->json($array);
        
    }

   public function UpdatePoin(Request $request, $id){

      $data =  Masyarakat::where('user_id',$id)->first();

       $input =([
          'poin'=>$request->poin,
           'user_id'=>$data->user->id,
      
     ]);
     $data->update($input);
        $i =$data->user_id;
    $mas = new Transaksi;
    $mas->nama_hadiah =$request->nama_hadiah;
    $mas->harga_hadiah =$request->harga_hadiah;
    $mas->sisapoin =$request->sisapoin;
    $mas->user_id =$i;
    $mas->save();

    
    //    $poin=User::findOrFail($i);
    // //          $input2 =([

    //      ]);
    // $poin->update($input2);
     // $data->update($input);
    return response()->json([
           'pesan' =>'sukses lah',
           'upload' => $data,$mas

    ],200);
      // return "Berhasil";
}
// public function tukarcode()
//     {
//         $masyarakat = Masyarakat::find(1);
//         return view('tukarcode', compact('masyarakat'));
//     }

    public function pushtukarcode(Request $request)
    {
        $poin = Kode::where('kode_reward', $request->kode_reward)->first();

        $data = ([
            'masyarakat_id' => 1,
            'kode_reward' => 'qwertyuipolaksshgfjhsgfnBCVZM892179462' ,
        ]);

        $poin->update($data);

        $masyarakat = Masyarakat::findOrFail(1);
       
        $poins =([

        $poin_baru = $poin->nilai,
         $poin_lama = $masyarakat->poin,
        $total_poin = $poin_baru + $poin_lama,
          'poin'=> $total_poin,
        ]);

        // dd($total_poin);
        $masyarakat->update($poins);
        // alert()->success('Sukses');
        // return back();
        
        return response()->json([$poin,$masyarakat]);
    }
}
