<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
class AgendaController extends Controller
{


  public function lihatagenda()
  {
		$upload = Agenda::all();
        return response()->json([
            'pesan' =>'sukses lah',
            'upload' => $upload
        ],200);

	}
    //
  public function tambahagenda(Request $request)
  {

		$file = $request->input('file');
		$nama_file = time()."_".".jpeg";
		$tujuan_upload = 'agenda/';

      if (file_put_contents($tujuan_upload . $nama_file , base64_decode($file))) 
      {
        // code...
        $response['code'] =1;
        $response['msg'] ="Sukses";
        echo "Sukses Photo" . $response['msg'];
      } else {
        // code...
        $response['code'] =0;
        $response['msg'] ="error";
      }

		  Agenda::create([
			'file' => $nama_file,
			'nama_agenda' => $request->input('nama_agenda'),
			'keterangan'=> $request->input('keterangan'),
		  ]);


      return response()->json(['code']);
		
	}
	
  public function UpdateAgenda(Request $request,$id)
  {
      $data =  Agenda::findOrFail($id);
       $input =$request->all();
       $data->update($input);
       // return "sukses";

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
