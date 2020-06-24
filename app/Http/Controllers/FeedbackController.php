<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\User;
use Illuminate\Support\Arr;

class FeedbackController extends Controller

{
    public function lihatfeedback(){

	   $feedback= Feedback::all();
   		return response()->json([
            'pesan' =>'sukses lah',
            'upload' => $feedback

    	],200);

	}
 
	 public function tambahfeedback(Request $request){
      $tok =User::all();
  		// menyimpan data file yang diupload ke variabel $file
  		$file = $request->input('file_gambar');
      $email= $request->input('email');
      $kritik_saran= $request->input('kritik_saran');
  		$nama_file = time().".jpeg";
  		// $tujuan_upload = '../resource/gambar/';
  		$tujuan_upload = 'feedback/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) {
         
          $pesan = "Kritik dan Saran Berhasil Ditambahkan";
      
        }else if ($email&&$kritik_saran) {
       
          $pesan = "Kritik dan Saran Berhasil Ditambahkan";
       
        }else{
           // $response['code'] =0;
          $pesan="Terjadi Kesalahan";
        }

  		Feedback::create([
  			'file_gambar' => $nama_file,
  			'email' => $request->input('email'),
  			'kritik_saran' => $request->input('kritik_saran'),
  		]);

      $feedback= Feedback::where('email',$request->email)->orderBy('updated_at', 'DESC')->first();
      $tokenList = Arr::pluck($tok,'token');  // Array data token 
  
      $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
      $token='eCxZoXAFRu-SD_LdGTjjDd:APA91bGdUK_jG6dfEPHOOGqf4tbrQJjuhbMIyikoQI6bzfcYZ2_mqBnLqcSvRS_YB2Imm15De-Z9fxRWSux5rfOu6KxkWAJKIpaoX9bZ1rg4T9HFBCh5RipTKM0wwUh30d3_mUZ5tb-s';
      
      $foto = $feedback->file_gambar;
      $notification = [
          'title'=>$feedback->email,
          'body' => $feedback->kritik_saran,
          'sound' => true,
          'image'=>'http://192.168.43.229/relasi/public/feedback/'.$foto,   
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

      return response()->json([$result,$pesan]);
		

    }

    public function HapusFeedback(Request $request,$id){

        $data =  Feedback::findOrFail($id);
        $input =$request->all();
        $data->delete($input);
     return "berhasil";

}
  public function webview()
  {
    return view('feedback');
    # code...
  }
}
