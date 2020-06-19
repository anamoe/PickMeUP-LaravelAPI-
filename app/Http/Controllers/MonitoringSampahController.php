<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonitoringSampah;
use App\User;
use Illuminate\Support\Arr;

class MonitoringSampahController extends Controller

{
	// public function __construct(){
	// 	parent::__construct();
	// }

	public function MonitoringSampah()
	{
		$lihat= MonitoringSampah::all();



 		return response()->json([
            'pesan' =>'sukses',
            'monitoring' => $lihat

    	],200);
	
	}

	public function NotifikasiSampah()
	{
			$monitoring = MonitoringSampah::where('keterangan',1)->orderBy('updated_at','DESC')->get();

    	return response()->json($monitoring);
	}

		public function PushNotifSampah(Request $request)
	{

        $tok =User::all();
        $monitoring=MonitoringSampah::all();



        MonitoringSampah::create([
            'nama' =>$request->input('nama'),
             'lat' =>'-11',
              'lng' =>'88',
            'keterangan'=> '1'


        ]); //ambil data user
        //whre('nama',$request->nama)
        $agenda= MonitoringSampah::where('nama',$request->nama)->orderBy('updated_at', 'DESC')->first();
            $tokenList = Arr::pluck($tok,'token');  // Array data token 

			
    	 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    $token='eCxZoXAFRu-SD_LdGTjjDd:APA91bGdUK_jG6dfEPHOOGqf4tbrQJjuhbMIyikoQI6bzfcYZ2_mqBnLqcSvRS_YB2Imm15De-Z9fxRWSux5rfOu6KxkWAJKIpaoX9bZ1rg4T9HFBCh5RipTKM0wwUh30d3_mUZ5tb-s';
    

    $notification = [
    	'title'=>$agenda->nama,
        'body' => $agenda->lat,
        'sound' => true,
        'image'=>'https://www.ecoranger.id/wp-content/uploads/2019/03/blue-17.png',
         
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


    return response()->json($result);
	}	
}
