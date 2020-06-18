<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hadiah;
use Illuminate\Support\Arr;
use App\User;

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
    $tok =User::all();
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->input('file_gambar');
		$nama_file = time().".jpeg";
		// $tujuan_upload = '../resource/gambar/';
		$tujuan_upload = 'hadiah/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) {
        // code...
        $pesan ="Sukses";
        // echo "Sukses" . $pesan;
        } else {
        // code...
        $pesan ="error";

      }

  		Hadiah::create([
  			'file_gambar' => $nama_file,
  			'nama' => $request->input('nama'),
  			'deskripsi' => $request->input('deskripsi'),
  			'harga_hadiah'	=> $request->input('harga_hadiah'),
        'jumlah_hadiah' => $request->input('jumlah_hadiah'),
  		]);

      $hadiah= Hadiah::where('nama',$request->nama)->orderBy('updated_at', 'DESC')->first();
      $tokenList = Arr::pluck($tok,'token');  // Array data token 

      
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token='eCxZoXAFRu-SD_LdGTjjDd:APA91bGdUK_jG6dfEPHOOGqf4tbrQJjuhbMIyikoQI6bzfcYZ2_mqBnLqcSvRS_YB2Imm15De-Z9fxRWSux5rfOu6KxkWAJKIpaoX9bZ1rg4T9HFBCh5RipTKM0wwUh30d3_mUZ5tb-s';
        
          $foto = $hadiah->file;
          $notification = [
            'title'=>$hadiah->nama,
            'body' => $hadiah->deskripsi.''.$hadiah->harga_hadiah.''.$hadiah->jumlah_hadiah,
            'sound' => true,
            'image'=>'http://192.168.43.229/relasi/public/hadiah/'.$foto,
           
          ];
        
          $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

          $fcmNotification = [
            'registration_ids' => $tokenList, //multple token array
            // 'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AAAAuYgA5bE:APA91bFSdM8CYQpIvYOiUSqa6xv_52FeZ7oagezJUd0Nwo5EARHYmPWgVT4Uajj4Bo8orvgYP9sc8CZj6JYhCwfp9uid9-Kn_uC57SedJu3VirHBwXIyHucG_sgWKCUtiBVv0UEMxA7L',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

      return response()->json([$pesan,$result]);
		 // return redirect()->back();

	   }

     public function UpdateHadiah(Request $request,$id){

    $file = $request->input('file_gambar');
    $nama= $request->input('nama');
    $deskripsi= $request->input('deskripsi');
    $harga_hadiah= $request->input('harga_hadiah');
    $jlm_hadiah= $request->input('jumlah_hadiah');

    $nama_file = time().".jpeg";
    // $tujuan_upload = '../resource/gambar/';
    $tujuan_upload = 'hadiah/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) {
      
      $pesan ="Update Berhasil";

      } else if ($nama||$deskripsi||$harga_hadiah||$jlm_hadiah) {
        // code...
        // $response['code'] =2;
        $pesan ="Update Berhasil";
      }else{
         // $response['code'] =0;
        $response['msg'] ="Update Gagal";
      }
      
      $data =  Hadiah::findOrFail($id);
       // $input =$request->all();
        $input =([
       
          'nama'=> $request->nama,
          'deskripsi'=> $request->deskripsi,
          'harga_hadiah'=> $request->harga_hadiah,
          'jumlah_hadiah'=> $request->jumlah_hadiah
         
        ]);

        if ($request->input('file_gambar')){
        $input['file_gambar'] = $nama_file;
        
        }
         
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

    public function UpdateJumlahHadiah(Request $request,$id){
        $data =  Hadiah::findOrFail($id);
        $input =$request->all();
        $data->update($input);

      return response()->json([
         'pesan' =>'sukses lah',
            'upload' => $data
        ],200);

    }

}
