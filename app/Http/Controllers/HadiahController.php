<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hadiah;
class HadiahController extends Controller
{
    //

    public function LihatHadiah(Request $request){

    $hadiahku= Hadiah::all();
     return response()->json([
         'pesan' =>'sukses lah',
            'upload' => $hadiahku
        ],200);


}
    	public function tambahhadiah(Request $request){

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->input('file');
		$nama_file = time().".jpeg";
		// $tujuan_upload = '../resource/gambar/';
			$tujuan_upload = 'hadiah/';

 if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) {
        // code...
        $response['code'] =1;
        $response['msg'] ="Sukses";
        echo "Sukses Photo" . $response['msg'];
      } else {
        // code...
        $response['code'] =0;
        $response['msg'] ="error";

  
        }

		Hadiah::create([
			'file' => $nama_file,
			'nama_hadiah' => $request->input('nama_hadiah'),
			'deskripsi' => $request->input('deskripsi'),
			'jumlah_poin'	=> $request->input('jumlah_poin')
		]);


  return response()->json($response);
		 // return redirect()->back();

	}

     public function UpdateHadiah(Request $request,$id){

      $data =  Hadiah::findOrFail($id);
       $input =$request->all();
       $data->update($input);
       // return "sukses";

     return response()->json([
         'pesan' =>'sukses lah',
            'upload' => $data
        ],200);


}
public function HapusHadiah(Request $request,$id){

  
      $data =  Hadiah::findOrFail($id);
       $input =$request->all();
       $data->delete($input);
       // return "sukses";

     return "berhasil";
}
}
