<?php

namespace App\Http\Controllers;

use ConsoleTVs\Charts\Facades\Charts;
use App\Models\Penerima;
use App\Models\Progres;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard', [
            // 'IrigasiDesaTerbangun' => DB::table('penerimas')->sum('IrigasiDesaTerbangun'),
            // 'IrigasiDesaBelumTerbangun' => DB::table('penerimas')->sum('IrigasiDesaBelumTerbangun'),
        ]);
    }
    public function handleChart()
    {
        $a = DB::table('penerimas')->sum('IrigasiDesaTerbangun');
        $formattedValueA = str_replace(',', '.', number_format($a, 0));
        $b = DB::table('penerimas')->sum('IrigasiDesaBelumTerbangun');
        $formattedValueB = str_replace(',', '.', number_format($b, 0));





        $userData = Penerima::select('Kabupaten', DB::raw('SUM(MendapatkanP4_ISDA) as total_mendapatkan'))
            ->groupBy('Kabupaten')
            ->get();
        $dataArray = [];
        foreach ($userData as $data) {
            $dataArray[] = [$data->Kabupaten, $data->total_mendapatkan];
        }
        $dataJSON = json_encode($dataArray);
        // dd($dataJSON);
        return view('dashboard.dashboard', [
            'dataJSON' => $dataJSON,
            'userData' => $userData,
            'users' => User::all(),
            'DaerahIrigasi' => Penerima::all(),
            'IrigasiDesaTerbangun' => $formattedValueA,
            'IrigasiDesaBelumTerbangun' => $formattedValueB,
        ]);
    }
}
