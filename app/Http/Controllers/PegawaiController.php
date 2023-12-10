<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($nip)
    {
        $dataKosong = [
            'nip'=>'Tidak ditemukan',
            'nama'=>'Tidak ditemukan',
            'jenis_kelamin' => 'Tidak ditemukan'
        ];

        $data2 = DB::table('pegawais')
        ->join('jabatans', 'jabatan_id', '=', 'jabatans.id')
        ->where('nip', $nip)
        ->get(['*', 'nama_jabatan']);

        $data = Pegawai::where('nip', $nip)->get();
        if ($data->count() > 0) {
            return response()->json($data2);
        }
        return response()->json([$dataKosong]);
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
    public function store(StorePegawaiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
