<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\DaerahIrigasi;
use App\Models\Districts;
use App\Models\Penerima;
use App\Models\Province;
use App\Models\Subdistricts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            )
            ->filter(['search' => request()->input('search')])
            ->orderBy('penerimas.created_at', 'desc')
            ->get();

        return view('form.daftar_p3tgai.index', [
            "penerimas" => $penerimas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $a = Province::get();
        $b = Cities::all();
        $c = Districts::all();
        $d = Subdistricts::all();
        return view('form.daftar_p3tgai.create', [
            'DaerahIrigasi' => DaerahIrigasi::all(),
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'd' => $d,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'daerah_irigasi_id' => ['required'],
            'Kabupaten' => ['required'],
            'provinsi' => ['required'],
            'Desa' => ['required'],
            'xAx' => ['nullable'],
            'yAx' => ['nullable'],
            'Kecamatan' => ['required'],
            'IrigasiDesaTerbangun' => ['nullable', 'regex:/^[0-9]+(\.[0-9]+)?$/'],
            'IrigasiDesaBelumTerbangun' => ['nullable', 'regex:/^[0-9]+(\.[0-9]+)?$/'],
            'PolaTanamSaatIni' => ['nullable'],
            'JenisVegetasi' => ['nullable'],
            'MendapatkanP4_ISDA' => ['nullable', 'regex:/^[0-9]+(\.[0-9]+)?$/'],
            'TahunMendapatkan' => ['nullable'],
            'names' => ['required'], // Mengganti 'names.*' menjadi 'names'
            'peta_pdf' => ['file', 'max:5120', 'mimes:pdf'],
            'jaringan_pdf' => ['file', 'max:5120', 'mimes:pdf'],
            'dokumentasi_pdf' => ['file', 'max:5120', 'mimes:pdf'],
        ]);
        DB::beginTransaction();
        try {
            if ($request->input('daerah_irigasi_id') === 'lainnya') {
                $validatedData['daerah_irigasi_id'] = $request->input('pilihanLainnyadaerah_irigasi_id');
                $daerahIrigasi = DaerahIrigasi::create([
                    'nama' => $validatedData['daerah_irigasi_id'],
                ]);
                $validatedData['daerah_irigasi_id'] = $daerahIrigasi->id;
            }
            if ($request->hasFile('peta_pdf')) {
                $petaPdfPath = $request->file('peta_pdf')->store('public/pdf');
                $validatedData['peta_pdf'] = $petaPdfPath;
            }

            if ($request->hasFile('jaringan_pdf')) {
                $jaringanPdfPath = $request->file('jaringan_pdf')->store('public/pdf');
                $validatedData['jaringan_pdf'] = $jaringanPdfPath;
            }

            if ($request->hasFile('dokumentasi_pdf')) {
                $dokumentasiPdfPath = $request->file('dokumentasi_pdf')->store('public/pdf');
                $validatedData['dokumentasi_pdf'] = $dokumentasiPdfPath;
            }
            // $originalName = $request->file('peta_pdf')->getClientOriginalName();
            // dd($originalName);
            Penerima::create($validatedData);
            DB::commit();
            return redirect('/dashboard/daerah-irigasi')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('fail', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penerima = Penerima::findOrFail($id);
        $provinsi = Province::where('id', $penerima->provinsi)->get();
        $kabupaten = Cities::where('id', $penerima->Kabupaten)->get();
        $kecamatan = Districts::where('id', $penerima->Kecamatan)->get();
        $desa = Subdistricts::where('id', $penerima->Desa)->get();
        // dd($provinsi, $kabupaten, $kecamatan, $desa);
        return view('form.daftar_p3tgai.edit', [
            "Penerimas" => $penerima,
            "DaerahIrigasi" => DaerahIrigasi::get(),
            "kabupatenList" => $kabupaten,
            "provinsiList" => $provinsi,
            "kecamatanList" => $kecamatan,
            "desaList" => $desa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a = Penerima::findOrfail($id);

        $validatedData = $request->validate([
            'daerah_irigasi_id' => ['required'],
            'xAx' => ['nullable'],
            'yAx' => ['nullable'],
            'Kabupaten' => ['required'],
            'Desa' => ['required'],
            'Kecamatan' => ['required'],
            'IrigasiDesaTerbangun' => ['nullable', 'regex:/^[0-9]+(\.[0-9]+)?$/'],
            'IrigasiDesaBelumTerbangun' => ['nullable', 'regex:/^[0-9]+(\.[0-9]+)?$/'],
            'PolaTanamSaatIni' => ['nullable'],
            'JenisVegetasi' => ['nullable'],
            'MendapatkanP4_ISDA' => ['nullable', 'regex:/^[0-9]+(\.[0-9]+)?$/'],
            'TahunMendapatkan' => ['nullable'],
            'names' => ['required'], // Mengganti 'names.*' menjadi 'names'
            'peta_pdf' => ['file', 'max:5120', 'mimes:pdf'],
            'jaringan_pdf' => ['file', 'max:5120', 'mimes:pdf'],
            'dokumentasi_pdf' => ['file', 'max:5120', 'mimes:pdf'],
        ]);

        if ($request->hasFile('peta_pdf')) {
            if ($a->peta_pdf != null) {
                Storage::delete($a->peta_pdf);
            }
            $petaPdfPath = $request->file('peta_pdf')->store('public/pdf');
            $validatedData['peta_pdf'] = $petaPdfPath;
        }

        if ($request->hasFile('jaringan_pdf')) {
            if ($a->jaringan_pdf != null) {
                Storage::delete($a->jaringan_pdf);
            }
            $jaringanPdfPath = $request->file('jaringan_pdf')->store('public/pdf');
            $validatedData['jaringan_pdf'] = $jaringanPdfPath;
        }

        if ($request->hasFile('dokumentasi_pdf')) {
            if ($a->dokumentasi_pdf != null) {
                Storage::delete($a->dokumentasi_pdf);
            }
            $dokumentasiPdfPath = $request->file('dokumentasi_pdf')->store('public/pdf');
            $validatedData['dokumentasi_pdf'] = $dokumentasiPdfPath;
        }

        try {
            Penerima::where('id', $id)->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect('/dashboard/daerah-irigasi')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd("ini delete");
        $penerima = Penerima::findOrFail($id);
        try {
            $penerima->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        } catch (\Exception $e) {
            return back()->with('fail', $e->getMessage());
        }
    }
    public function getDataDariDatabase()
    {
        $dataDariDatabase = Penerima::all(); // Mengambil data dari model

        return view(
            'form.daftar_p3tgai.index',
            [
                'dataDariDatabase' => $dataDariDatabase
            ]
        );
    }
    public function getPeta_pdf(string $id)
    {
        $penerima = Penerima::where('id', $id)->pluck('peta_pdf')->first(); // Mengambil nilai pertama
        if (empty($penerima)) {
            return redirect()->back()->with('fail', 'File Peta tidak tersedia.');
        }
        $pdfPath = public_path('storage' . substr($penerima, 6)); // Gantilah dengan nama dan path file PDF yang sesuai
        // dd( $pdfPath,$penerima);
        // dd( );
        return Response::make(file_get_contents($pdfPath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=nama-file.pdf',
        ]);
    }
    public function getJaringan_pdf(string $id)
    {
        $penerima = Penerima::where('id', $id)->pluck('jaringan_pdf')->first(); // Mengambil nilai pertama
        if (empty($penerima)) {
            return redirect()->back()->with('fail', 'File Jaringan tidak tersedia.');
        }
        $pdfPath = public_path('storage' . substr($penerima, 6)); // Gantilah dengan nama dan path file PDF yang sesuai
        return Response::make(file_get_contents($pdfPath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=nama-file.pdf',
        ]);
    }
    public function getDokumen_pdf(string $id)
    {
        $penerima = Penerima::where('id', $id)->pluck('dokumentasi_pdf')->first(); // Mengambil nilai pertama
        if (empty($penerima)) {
            return redirect()->back()->with('fail', 'File Dokumentasi tidak tersedia.');
        }
        $pdfPath = public_path('storage' . substr($penerima, 6)); // Gantilah dengan nama dan path file PDF yang sesuai
        return Response::make(file_get_contents($pdfPath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=nama-file.pdf',
        ]);
    }
    public function getProvinsi()
    {
        $provinsi = Province::all();
        return response()->json($provinsi);
    }
    public function getKabupaten($provinsiId)
    {
        $Kabupaten = Cities::where('prov_id', $provinsiId)->get();
        return response()->json($Kabupaten);
    }
    public function getKecamatan($cityId)
    {
        $Kecamatan = Districts::where('city_Id', $cityId)->get();
        return response()->json($Kecamatan);
    }
    public function getDesa($dis_id)
    {
        $Desa = Subdistricts::where('dis_id', $dis_id)->get();
        return response()->json($Desa);
    }
    public function coba()
    {
        return view('/dashboard/coba');
    }
}
