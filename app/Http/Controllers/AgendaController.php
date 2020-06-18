<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\User;
use Illuminate\Support\Arr;
class AgendaController extends Controller
{

    public function lihatagenda(){
		$upload = Agenda::all();
        return response()->json([
            'pesan' =>'sukses lah',
            'upload' => $upload
        ],200);

	   }

    //
    public function tambahagenda(Request $request){
    //$TGL= \Carbon\Carbon::parse($notif->tanggal)->isoFormat('LLL');
    $tok =User::all();
		$file = $request->input('file_gambar');
		$nama_file = time().".jpeg";
		$tujuan_upload = 'agenda/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) 
      {
        // code...
        $response['msg'] ="Sukses";
        echo "Sukses Photo" . $response['msg'];
      } else {
        // code...
        $response['msg'] ="error";
      }

		  Agenda::create([
			'file_gambar' => $nama_file,
			'nama' => $request->input('nama'),
			'keterangan'=> $request->input('keterangan'),
		  
      ]);

      $agenda= Agenda::where('nama',$request->nama)->orderBy('updated_at', 'DESC')->first();
      $tokenList = Arr::pluck($tok,'token');  // Array data token 

    
      $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
      $token='eCxZoXAFRu-SD_LdGTjjDd:APA91bGdUK_jG6dfEPHOOGqf4tbrQJjuhbMIyikoQI6bzfcYZ2_mqBnLqcSvRS_YB2Imm15De-Z9fxRWSux5rfOu6KxkWAJKIpaoX9bZ1rg4T9HFBCh5RipTKM0wwUh30d3_mUZ5tb-s';
  
      $foto = $agenda->file_gambar;
      $notification = [
        'title'=>$agenda->nama,
        'body' => $agenda->keterangan,
        'sound' => true,
        'image'=>'http://192.168.43.229/relasi/public/agenda/'.$foto,
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



      return response()->json([$response,$result]);
		
    }
	
    public function UpdateAgenda(Request $request,$id)
  {

    $file = $request->input('file_gambar');
    $nama= $request->input('nama');
    $nohp= $request->input('keterangan');
  

    $nama_file = time()."_".".jpeg";
    // $tujuan_upload = '../resource/gambar/';
    $tujuan_upload = 'agenda/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) {
       $pesan = "Update Berhasil";

      }else if ($nama||$nohp) {
 
        $pesan="Update Berhasil ";
      }else{
     
        $pesan ="Update Gagal";
      }
     
      $data =  Agenda::findOrFail($id);
       // $input =$request->all();
      $input =([
          // 'file'=> $nama_file,
          'nama'=> $request->nama,
          'keterangan'=> $request->keterangan
        
        ]);
              
        if ($request->input('file_gambar')) {
            $input['file_gambar'] = $nama_file;
        }

        $data->update($input);

     return response()->json([
         'pesan' =>'sukses lah',
            'upload' => $data
        ],200);
    }

    public function HapusAgenda(Request $request,$id){

       $data =  Agenda::findOrFail($id);
       $input =$request->all();
       $data->delete($input);
       // return "sukses";
     return "berhasil";
  }
}
