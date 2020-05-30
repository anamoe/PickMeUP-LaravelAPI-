<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
class FeedbackController extends Controller
{
    //
    public function lihatfeedback(){

	$feedback= Feedback::all();

    // foreach ($feedback as $value) {
    //     $array[]=[
    //         'email' =>$value->email,
    //         'kritik_saran' =>$value->kritik_saran,
    //         'file'=>$value->file,
    //         'username' => $value->user->username
  
    //     ];
    
    //    }
    // }
 		return response()->json([
            'pesan' =>'sukses lah',
            'upload' => $feedback

    	],200);


		// $upload = Feedback::all();
  //       return response()->json([
  //           'pesan' =>'sukses lah',
  //           'upload' => $upload
  //       ],200);
		// $gambar = upload::get();
		// return view('upload',['gambar' => $gambar]);
	}
 
	public function tambahfeedback(Request $request){

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->input('file');
     $email= $request->input('email');
      $kritik_saran= $request->input('kritik_saran');
    
		$nama_file = time()."_".".jpeg";
		// $tujuan_upload = '../resource/gambar/';
			$tujuan_upload = 'feedback/';

 if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) {
        // code...
        // $response['code'] =1;
        $response['msg'] ="Kritik dan Saran Berhasil Ditambahkan";
        echo "Sukses Photo" . $response['msg'];

      } else if ($email&&$kritik_saran) {
        // code...
        // $response['code'] =2;
        $response['msg'] ="Kritik dan Saran Berhasil Ditambahkan";
      }else{
         // $response['code'] =0;
        $response['msg'] ="Terjadi Kesalahan";
      }

		Feedback::create([
			'file' => $nama_file,
			'email' => $request->input('email'),
			'kritik_saran' => $request->input('kritik_saran'),
		]);


  return response()->json($response);
		 // return redirect()->back();

}
}
