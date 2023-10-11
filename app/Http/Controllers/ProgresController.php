<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Districts;
use App\Models\Penerima;
use App\Models\Progres;
use App\Models\Province;
use App\Models\Subdistricts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class ProgresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return view('form.perkembangan.index', [
            'penerimas' => Penerima::findOrFail($id),
            'progress' => Progres::where('penerima_id', $id)->get(),
            'provinsi' => Province::all(),
            'kabupaten' => Cities::get(),
            'kecamatan' => Districts::all(),
            'desa' => Subdistricts::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // dd('ini create progres',$id);

        $penerima = Penerima::findOrFail($id);
        $oldNames = $penerima->names ?? [];
        return view('form.perkembangan.create', [
            'id' => $id,
            'penerima' =>  $penerima,
            'desa' => Subdistricts::all(),
            'oldNames' => $oldNames
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // dd($id);
        $validatedData = $request->validate([
            'penerima_id' => ['required'],
            'TahunPengerjaan' => ['required'],
            'jenisPekerjaan' => ['required'],
            'langsirMaterial' => ['required'],
            'jarakLangsir' => ['required'],
            'bedaLangsir' => ['required'],
            'metodeLangsir' => ['required'],
            'KondisiLokasiPekerjaan' => ['required'],
            'KondisiTanahLokasiPekerjaan' => ['required'],
            'PotensiMasalahSosial' => ['required'],
            'TerlampirAktePendirian' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirNPWP' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirBukuRekening' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirRab' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirLembarKerja' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirProgres' => ['file', 'max:5120', 'mimes:png,jpg,jpeg'],
        ]);

        if ($request->input('TahunPengerjaan') === 'lainnya') {
            $validatedData['TahunPengerjaan'] = $request->input('pilihanLainnyaTahunPengerjaan');
        }
        if ($request->input('metodeLangsir') === 'lainnya') {
            $validatedData['metodeLangsir'] = $request->input('pilihanLainnyaMetode');
        }
        if ($request->input('KondisiLokasiPekerjaan') === 'lainnya') {
            $validatedData['KondisiLokasiPekerjaan'] = $request->input('pilihanLainnyaKondisiLokasiPekerjaan');
        }
        if ($request->input('KondisiTanahLokasiPekerjaan') === 'lainnya') {
            $validatedData['KondisiTanahLokasiPekerjaan'] = $request->input('pilihanLainnyaKondisiTanahLokasiPekerjaan');
        }
        if ($request->input('PotensiMasalahSosial') === 'lainnya') {
            $validatedData['PotensiMasalahSosial'] = $request->input('pilihanLainnyaPotensiMasalahSosial');
        }
        if ($request->hasFile('TerlampirAktePendirian')) {
            $petaPdfPath = $request->file('TerlampirAktePendirian')->store('public/pdf');
            $validatedData['TerlampirAktePendirian'] = $petaPdfPath;
        }

        if ($request->hasFile('TerlampirNPWP')) {
            $jaringanPdfPath = $request->file('TerlampirNPWP')->store('public/pdf');
            $validatedData['TerlampirNPWP'] = $jaringanPdfPath;
        }

        if ($request->hasFile('TerlampirBukuRekening')) {
            $dokumentasiPdfPath = $request->file('TerlampirBukuRekening')->store('public/pdf');
            $validatedData['TerlampirBukuRekening'] = $dokumentasiPdfPath;
        }
        if ($request->hasFile('TerlampirProgres')) {
            $progresPath = $request->file('TerlampirProgres')->store('public/images');
            $validatedData['TerlampirProgres'] = $progresPath;
        }
        if ($request->hasFile('TerlampirRab')) {
            $progresPath = $request->file('TerlampirRab')->store('public/pdf');
            $validatedData['TerlampirRab'] = $progresPath;
        }
        if ($request->hasFile('TerlampirLembarKerja')) {
            $progresPath = $request->file('TerlampirLembarKerja')->store('public/pdf');
            $validatedData['TerlampirLembarKerja'] = $progresPath;
        }

        // dd($validatedData);
        try {
            Progres::create($validatedData);
            return redirect("/dashboard/update/perkembangan-daerah-irigasi/$id")->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $progres = Progres::findOrFail($id);
        return response()->json([
            'progres' => $progres,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $progres = Progres::findOrfail($id);
        return view('form.perkembangan.edit', [
            "progres" => $progres,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a = Progres::findOrfail($id);
        // dd($a);
        $validatedData = $request->validate([
            'TahunPengerjaan' => ['nullable'],
            'jenisPekerjaan' => ['nullable'],
            'langsirMaterial' => ['nullable'],
            'jarakLangsir' => ['nullable'],
            'bedaLangsir' => ['nullable'],
            'metodeLangsir' => ['nullable'],
            'KondisiLokasiPekerjaan' => ['nullable'],
            'KondisiTanahLokasiPekerjaan' => ['nullable'],
            'PotensiMasalahSosial' => ['nullable'],
            'TerlampirAktePendirian' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirNPWP' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirBukuRekening' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirRab' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirLembarKerja' => ['file', 'max:5120', 'mimes:pdf'],
            'TerlampirProgres' => ['file', 'max:5120', 'mimes:png,jpg,jpeg'],

        ]);

        if ($request->input('TahunPengerjaan') === 'lainnya') {
            $validatedData['TahunPengerjaan'] = $request->input('pilihanLainnyaTahunPengerjaan');
        }
        if ($request->input('metodeLangsir') === 'lainnya') {
            $validatedData['metodeLangsir'] = $request->input('pilihanLainnyaMetode');
        }
        if ($request->input('KondisiLokasiPekerjaan') === 'lainnya') {
            $validatedData['KondisiLokasiPekerjaan'] = $request->input('pilihanLainnyaKondisiLokasiPekerjaan');
        }
        if ($request->input('KondisiTanahLokasiPekerjaan') === 'lainnya') {
            $validatedData['KondisiTanahLokasiPekerjaan'] = $request->input('pilihanLainnyaKondisiTanahLokasiPekerjaan');
        }
        if ($request->input('PotensiMasalahSosial') === 'lainnya') {
            $validatedData['PotensiMasalahSosial'] = $request->input('pilihanLainnyaPotensiMasalahSosial');
        }

        if ($validatedData['TahunPengerjaan'] == null) {
            $validatedData['TahunPengerjaan'] = $a->TahunPengerjaan;
        }
        if ($validatedData['jenisPekerjaan'] == null) {
            $validatedData['jenisPekerjaan'] = $a->jenisPekerjaan;
        }
        if ($validatedData['langsirMaterial'] == null) {
            $validatedData['langsirMaterial'] = $a->langsirMaterial;
        }
        if ($validatedData['jarakLangsir'] == null) {
            $validatedData['jarakLangsir'] = $a->jarakLangsir;
        }
        if ($validatedData['bedaLangsir'] == null) {
            $validatedData['bedaLangsir'] = $a->bedaLangsir;
        }
        if ($validatedData['metodeLangsir'] == null) {
            $validatedData['metodeLangsir'] = $a->metodeLangsir;
        }
        if ($validatedData['KondisiLokasiPekerjaan'] == null) {
            $validatedData['KondisiLokasiPekerjaan'] = $a->KondisiLokasiPekerjaan;
        }
        if ($validatedData['KondisiTanahLokasiPekerjaan'] == null) {
            $validatedData['KondisiTanahLokasiPekerjaan'] = $a->KondisiTanahLokasiPekerjaan;
        }
        if ($validatedData['PotensiMasalahSosial'] == null) {
            $validatedData['PotensiMasalahSosial'] = $a->PotensiMasalahSosial;
        }




        if ($request->hasFile('TerlampirAktePendirian')) {
            if ($a->TerlampirAktePendirian != null) {
                Storage::delete($a->TerlampirAktePendirian);
            }
            $petaPdfPath = $request->file('TerlampirAktePendirian')->store('public/pdf');
            $validatedData['TerlampirAktePendirian'] = $petaPdfPath;
        }

        if ($request->hasFile('TerlampirNPWP')) {
            if ($a->TerlampirNPWP != null) {
                Storage::delete($a->TerlampirNPWP);
            }
            $jaringanPdfPath = $request->file('TerlampirNPWP')->store('public/pdf');
            $validatedData['TerlampirNPWP'] = $jaringanPdfPath;
        }

        if ($request->hasFile('TerlampirBukuRekening')) {
            if ($a->TerlampirBukuRekening != null) {
                Storage::delete($a->TerlampirBukuRekening);
            }
            $dokumentasiPdfPath = $request->file('TerlampirBukuRekening')->store('public/pdf');
            $validatedData['TerlampirBukuRekening'] = $dokumentasiPdfPath;
        }

        if ($request->hasFile('TerlampirProgres')) {
            if ($a->TerlampirProgres != null) {
                Storage::delete($a->TerlampirProgres);
            }
            $progresPath = $request->file('TerlampirProgres')->store('public/images');
            $validatedData['TerlampirProgres'] = $progresPath;
        }
        if ($request->hasFile('TerlampirRab')) {
            if ($a->TerlampirRab != null) {
                Storage::delete($a->TerlampirRab);
            }
            $progresPath = $request->file('TerlampirRab')->store('public/pdf');
            $validatedData['TerlampirRab'] = $progresPath;
        }
        if ($request->hasFile('TerlampirLembarKerja')) {
            if ($a->TerlampirLembarKerja != null) {
                Storage::delete($a->TerlampirLembarKerja);
            }
            $progresPath = $request->file('TerlampirLembarKerja')->store('public/pdf');
            $validatedData['TerlampirLembarKerja'] = $progresPath;
        }

        // dd($validatedData);
        try {
            Progres::where('id', $id)->update($validatedData);
            return redirect("/dashboard/update/perkembangan-daerah-irigasi/$a->penerima_id")->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd("ini route delete");
        $Progres = Progres::findOrFail($id);
        try {
            $Progres->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function getAkta_pdf(string $id)
    {
        $Progres = Progres::where('id', $id)->pluck('TerlampirAktePendirian')->first(); // Mengambil nilai pertama
        if ($Progres === null) {
            return redirect()->back()->with('fail', 'File Akta Pendirian tidak tersedia.');
        }
        $pdfPath = public_path('storage' . substr($Progres, 6)); // Gantilah dengan nama dan path file PDF yang sesuai
        return Response::make(file_get_contents($pdfPath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=nama-file.pdf',
        ]);
    }
    public function getNpwp_pdf(string $id)
    {
        $Progres = Progres::where('id', $id)->pluck('TerlampirNPWP')->first(); // Mengambil nilai pertama
        if ($Progres === null) {
            return redirect()->back()->with('fail', 'File NPWP tidak tersedia.');
        }
        $pdfPath = public_path('storage' . substr($Progres, 6)); // Gantilah dengan nama dan path file PDF yang sesuai
        return Response::make(file_get_contents($pdfPath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=nama-file.pdf',
        ]);
    }
    public function getRek_pdf(string $id)
    {
        $Progres = Progres::where('id', $id)->pluck('TerlampirBukuRekening')->first(); // Mengambil nilai pertama
        if ($Progres === null) {
            return redirect()->back()->with('fail', 'File Buku Rekening tidak tersedia.');
        }
        $pdfPath = public_path('storage' . substr($Progres, 6)); // Gantilah dengan nama dan path file PDF yang sesuai
        return Response::make(file_get_contents($pdfPath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=nama-file.pdf',
        ]);
    }
    public function getImg(string $id)
    {
        $Progres = Progres::where('id', $id)->pluck('TerlampirProgres')->first(); // Mengambil nilai pertama
        if ($Progres === null) {
            return redirect()->back()->with('fail', 'File tidak tersedia.');
        }
        $imgPath = public_path('storage' . substr($Progres, 6)); // Gantilah dengan nama dan path file gambar yang sesuai
        // return  $imgPath;
        if (file_exists($imgPath)) {
            // Tentukan tipe konten gambar (misalnya, 'image/jpeg' atau 'image/png')
            $contentType = mime_content_type($imgPath);
            // dd($contentType);
            return response()->file($imgPath, [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'inline; filename=nama-file.jpg', // Ganti nama file sesuai dengan tipe konten gambar
            ]);
        } else {
            return redirect()->back()->with('fail', 'File tidak ditemukan.');
        }
    }
}
