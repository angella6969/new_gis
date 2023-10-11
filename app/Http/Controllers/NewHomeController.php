<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use App\Models\Progres;
use Illuminate\Http\Request;

class NewHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerimas = Penerima::latest()
            ->with(['daerahIrigasi', 'Progres'])
            ->leftJoin('provinces', 'penerimas.kabupaten', '=', 'provinces.id')
            ->leftJoin('cities', 'penerimas.kabupaten', '=', 'cities.id')
            ->leftJoin('districts', 'penerimas.kecamatan', '=', 'districts.id')
            ->leftJoin('subdistricts', 'penerimas.desa', '=', 'subdistricts.id')
            ->select(
                'penerimas.*', // Pilih semua kolom dari tabel 'penerimas'
                'provinces.id as province_id', // Atur alias untuk ID dari 'provinces'
                'cities.id as city_id', // Atur alias untuk ID dari 'cities'
                'districts.id as district_id', // Atur alias untuk ID dari 'districts'
                'subdistricts.id as subdistrict_id' // Atur alias untuk ID dari 'subdistricts'
            )
            ->filter(request()->only('search'))
            ->orderBy('penerimas.created_at', 'desc')
            ->get();
        return view('content.newhome', [
            'penerimas' => Penerima::with(['Progres'])->get(),
            'penerimas' =>  $penerimas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
