<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KontenAnimasi;
use App\User;
use Illuminate\Support\Arr;

class KontenAnimasiController extends Controller
{
    public function lihatkonten(){
		  $upload = KontenAnimasi::all();
        return response()->json([
            'pesan' =>'Konten Edukasi',
            'upload' => $upload
        ],200);
	
    }
 
	   public function tambahkonten(Request $request){

        $tok =User::all();
    		// menyimpan data file yang diupload ke variabel $file
    		$file = $request->input('file_gambar');
    		$nama_file = time().".jpeg";
    		// $tujuan_upload = '../resource/gambar/';
    		$tujuan_upload = 'animasi/';

        if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) {
        
          $pesan="Sukses";
         
        } else {
 
          $pesan="error";
        }

    		KontenAnimasi::create([
    			'file_gambar' => $nama_file,
    			'nama' => $request->input('nama'),
    			'deskripsi' =>$request->input('deskripsi'),
    		]);

        $konten= KontenAnimasi::where('nama',$request->nama)->orderBy('updated_at', 'DESC')->first();
        $tokenList = Arr::pluck($tok,'token');  // Array data token 

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token='eCxZoXAFRu-SD_LdGTjjDd:APA91bGdUK_jG6dfEPHOOGqf4tbrQJjuhbMIyikoQI6bzfcYZ2_mqBnLqcSvRS_YB2Imm15De-Z9fxRWSux5rfOu6KxkWAJKIpaoX9bZ1rg4T9HFBCh5RipTKM0wwUh30d3_mUZ5tb-s';

        $foto = $konten->file_gambar;
        $notification = [
          'title'=>$konten->nama,
          'body' => $konten->deskripsi,
          'sound' => true,
          'image'=>'http://192.168.43.229/relasi/public/animasi/'.$foto,
           
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
		
  	}

    public function UpdateKonten(Request $request, $id){

      $file = $request->input('file_gambar');
      $nama= $request->input('nama_konten');
      $nohp= $request->input('deskripsi');
      $nama_file = time()."_".".jpeg";
      // $tujuan_upload = '../resource/gambar/';
      $tujuan_upload = 'animasi/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))){
        // code...
        // $response['code'] =1;
        $response['msg'] ="Update berhasil";
        echo "Sukses Photo" . $response['msg'];

      } else if ($nama||$nohp) {
        // code...
        // $response['code'] =2;
        $pesan ="Update Berhasil ";
      }else{
         // $response['code'] =0;
        $pesan ="Terjadi Kesalahan";
      }

      $konten =  KontenAnimasi::findOrFail($id);
       // $input =$request->all();
      $input =([
          // 'file'=> $nama_file,
          'nama'=> $request->nama,
          'deskripsi'=> $request->deskripsi,
           
        ]);
             if ($request->input('file_gambar')) {
            $input['file_gambar'] = $nama_file;
        }
         
       $konten->update($input);
       // return "sukses";

     return response()->json([
         'pesan' =>'sukses lah',
            'upload' => $konten
        ],200);
    }

    public function HapusKonten(Request $request,$id){

       $data =  KontenAnimasi::findOrFail($id);
       $input =$request->all();
       $data->delete($input);
       // return "sukses";

      return "berhasil";
   
    }

}
