<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Masyarakat;
use App\User;

class MasyarakatController extends Controller
{

  public function Masyarakat()
	{
		$hadiahku= Masyarakat::all();

    foreach ($hadiahku as $value) {
        $array[]=[
            'id'=>$value->id,
            'nama' =>$value->nama,
            'nohp' =>$value->nohp,
            'alamat'=>$value->alamat,
            'email' => $value->user->email,
            'username'=>$value->user->username
  
        ];
    
       
    }
        return response()->json($array);
 		// return response()->json([
   //          'pesan' =>'sukses lah',
   //          'upload' => $hadiahku

   //  	],200);
	}
  
  public function TambahMasyarakat (Request $request)
  {
    	$data = new Masyarakat;
    	$data->nama = $request->input('nama');
    	$data->nohp = $request->input('nohp');
    	$data->alamat = $request->input('alamat');
    	$data->save();

    	return "Berhasil";
  }

  public function edit(Request $request, $id)
  {
    
    $file = $request->input('file');
    $nama= $request->input('naa');
    $nohp= $request->input('nohp');
    $alamat= $request->input('alamat');
    $nama_file = time()."_".".jpeg";
    // $tujuan_upload = '../resource/gambar/';
    $tujuan_upload = 'foto_user/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) 
      {
        // code...
        // $response['code'] =1;
        $response['msg'] ="Kritik dan Saran Berhasil Ditambahkan";
        echo "Sukses Photo" . $response['msg'];

      } else if ($nama&&$nohp&&$alamat) {
        // code...
        // $response['code'] =2;
        $response['msg'] ="Kritik dan Saran Berhasil Ditambahkan";
      }else{
         // $response['code'] =0;
        $response['msg'] ="Terjadi Kesalahan";
      }
        // $data =  Masyarakat::findOrFail($id);
        $data =  Masyarakat::where('user_id',$id)->first();
       // $input =$request->all();
       // $data->update($input);
       $input =([
          'file'=> $nama_file,
          'nama'=> $request->nama,
          'nohp'=> $request->nohp,
          'alamat'=> $request->alamat,
          'user_id'=>$data->user->id
        
        ]);

        $i =$data->user_id;

        $user=User::findOrFail($i);
        $input2 =([
        'username'=> $request->username,
          'email'=> $request->email
        ]);
        $user->update($input2);
        $data->update($input);
        return response()->json([
             'pesan' =>'sukses lah',
             'upload' => $user,$data

      ],200);
        // return "Berhasil";
    }
   
  public function show( $id)

  {
    // $data =  Masyarakat::findOrFail($id);
      $data =  Masyarakat::where('user_id',$id)->first();
      $array[]=[
          'id'=> $data->id,
          'nama'=> $data->nama,
          'nohp'=> $data->nohp,
          'alamat'=>   $data->alamat,
          'username'=> $data->user->username,
          'email'=>   $data->user->email,
          'file'=>$data->file
      
    ];
      // return response()->json([
//          'pesan' =>'sukses lah',
//          'upload' => $hadiahku

//   ],200);
    return response()->json($array);
  }
   
 
}
