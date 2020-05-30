<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\MonitoringSampah;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	$tgl = Carbon::now();
    	$tgl1 = $tgl->subDays(1);

    	$monitoring = MonitoringSampah::where('keterangan',1)->orderBy('updated_at','DESC')->get();

    	return response()->json($monitoring);
    }
}
