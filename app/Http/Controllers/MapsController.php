<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\csv;
use App\Models\Districts;
use App\Models\map_gis;
use ConsoleTVs\Charts\Facades\Charts;
use App\Models\Penerima;
use App\Models\Progres;
use App\Models\Subdistricts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Laravolt\Indonesia\Models\District;

class MapsController extends Controller
{
    public function index()
    {
        return view('dashboard.map', [
            // 'IrigasiDesaTerbangun' => DB::table('penerimas')->sum('IrigasiDesaTerbangun'),
            // 'IrigasiDesaBelumTerbangun' => DB::table('penerimas')->sum('IrigasiDesaBelumTerbangun'),
        ]);
    }
    public function handleChart()
    {
        $penerimas = Penerima::latest()
            ->leftjoin('daerah_irigasis', 'penerimas.daerah_irigasi_id', '=', 'daerah_irigasis.id')
            ->leftJoin('provinces', 'penerimas.kabupaten', '=', 'provinces.id')
            ->leftJoin('cities', 'penerimas.kabupaten', '=', 'cities.id')
            ->leftJoin('districts', 'penerimas.kecamatan', '=', 'districts.id')
            ->leftJoin('subdistricts', 'penerimas.desa', '=', 'subdistricts.id')
            ->select(
                'penerimas.*', // Pilih semua kolom dari tabel 'penerimas'
                'provinces.id as province_id', // Atur alias untuk ID dari 'provinces'
                'cities.id as city_id', // Atur alias untuk ID dari 'cities'
                'districts.id as district_id', // Atur alias untuk ID dari 'districts'
                'subdistricts.id as subdistrict_id', // Atur alias untuk ID dari 'subdistricts'
                'daerah_irigasis.id as daerah_irigasi_id' // Atur alias untuk ID dari 'daerah_irigasis'
            )->get();
        // $userData = Penerima::get();
        $dataArray = [];
        // dd($penerimas);
        foreach ($penerimas as $data) {
            $city = Cities::find($data->Kabupaten);
            $District = Districts::find($data->Kecamatan);
            $Subdistricts = Subdistricts::find($data->Desa);
            // $Subdistricts = Subdistricts::find($data->Desa);
            $dataArray[] = [
                (float)$data->yAx,
                (float)$data->xAx,
                $data->daerah_irigasi_id,
                $data->names,
                $city->city_name,
                $District->dis_name,
                $Subdistricts->subdis_name,
                $data->IrigasiDesaTerbangun,
                $data->IrigasiDesaBelumTerbangun,
                $data->PolaTanamSaatIni,
                $data->JenisVegetasi,
                $data->MendapatkanP4_ISDA,
                $data->TahunMendapatkan,
            ];
        }
        $dataJSON = json_encode($dataArray);
        // dd($dataJSON);
        return view('dashboard.map', [
            'dataA' => $penerimas,
            'dataJSON' => $dataJSON,
        ]);
    }
}
