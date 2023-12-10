<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\PresensiDetail;
use App\Http\Requests\StorePresensiRequest;
use App\Http\Requests\UpdatePresensiRequest;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePresensiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        // $nip = '1282158';
        // $kode = 'PXzZenVM0qFKDSqRCgO55Oim1';
        // $presensi_detail = PresensiDetail::where('kode_presensi', $kode)->where('nip', $nip)->first();
        // return view('edit', compact('presensi_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kode, $nip)
    {
        $pengaturan_presensi = Settings::first();
        $waktu_presensi = date('H:i', time());
        $lat = $request->lat_masuk;
        $long = $request->longitude_masuk;
        // CEK APAKAH DIA TERLAMBAT
        if (strtotime($waktu_presensi) > strtotime($pengaturan_presensi->jam_masuk)) {
            $terlambat = 1; // 1 Berarti Telambat
        } else {
            $terlambat = 0; // 0 Berarti tidak terlambat
        }
        $data_presensi = [
            'presensi_masuk' => time(),
            'status_masuk' => $terlambat,
            'latitude_masuk' => $lat,
            'longitude_masuk' => $long,
        ];

        $update = PresensiDetail::where('kode_presensi', $kode)->where('nip', $nip)->update($data_presensi);
        if($update){
            return 'berhasil';
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        //
    }
}
