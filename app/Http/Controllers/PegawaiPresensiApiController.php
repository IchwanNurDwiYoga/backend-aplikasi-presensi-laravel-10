<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResources;
use App\Http\Resources\PresensiResource;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\PresensiDetail;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiPresensiApiController extends Controller
{
    public function index()
    {
        // $pegawai = Pegawai::where('nip', 1282158)->get();
        $presensi = Presensi::firstWhere('tgl_presensi', date('d-m-Y', time()));
        $setting = Settings::all();
        $date = date('d-m-Y', time());
        // return response()->json(['pesan' => 'sukses', 'data' => $presensi]);
        if ($presensi == null) {
            return response()->json(['message' => 'Presensi Belum Dibuat', 'data' => 'Presensi Belum Dibuat', 'date' => $date]);

            // return response()->json(['data' => $setting]);
        }
        return response()->json($presensi);
    }

    public function show(Request $request)
    {
    }
    public function presensiMasuk(Request $request, $kode)
    {
        $tgl_presensi = date('Y-m-d', time());
        $latitude = $request->lat_masuk;
        $longitude = $request->long_masuk;
        $nip = $request->nip;
        $presensi = Presensi::firstWhere('kode_presensi', $kode);
        $pengaturan_presensi = Settings::first();
        $waktu_presensi = date('H:i:s', time());
        $cek_presensi_masuk = PresensiDetail::where('kode_presensi', $kode)->where('nip', $nip)->first();
        if ($cek_presensi_masuk->presensi_masuk != null) {
            return response()->json(['pesan' => 'kamu sudah masuk']);
        }
        // CEK APAKAH DIA TERLAMBAT
        if (strtotime($waktu_presensi) > strtotime($pengaturan_presensi->jam_masuk)) {
            $terlambat = 1; // 1 Berarti Telambat
        } else {
            $terlambat = 0; // 0 Berarti tidak terlambat
        }
        function distanceMasuk($lat1, $lon1, $lat2, $lon2, $unit)
        {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            } else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit = strtoupper($unit);

                if ($unit == "K") {
                    return ($miles * 1.609344);
                } else if ($unit == "N") {
                    return ($miles * 0.8684);
                } else {
                    return $miles;
                }
            }
        }
        $jarak_belum_bulat =  (distanceMasuk($pengaturan_presensi->lat, $pengaturan_presensi->long, $latitude, $longitude, "K") * 1000);
        $jarak = ceil($jarak_belum_bulat);
        if ($pengaturan_presensi->batas_jarak < $jarak) {

            return response()->json(['pesan' => 'Kamu berada sejauh ' . $jarak . 'm dari jarak yang ditentukan']);
        }


        $data_presensi = [
            'presensi_masuk' => $waktu_presensi,
            'status_masuk' => $terlambat,
            'lat_masuk' => $latitude,
            'long_masuk' => $longitude,
        ];


        //isi presensi masuk
        $presensi_detail = PresensiDetail::firstWhere('tgl_presensi', $tgl_presensi)->where('kode_presensi', $kode)->where('nip', $nip)->update($data_presensi);

        //menghitung jumlah pegawai masuk
        $jumlah_masuk = ($presensi->jumlah_pegawai_masuk + 1);
        $jumlah_pegawai = ($presensi->total + 1);

        $data_presensi = [
            'jumlah_pegawai_masuk' => $jumlah_masuk,
            'total' => $jumlah_pegawai
        ];

        Presensi::where('kode_presensi', $kode)
            ->update($data_presensi);
        return response()->json(['data' => ['pesan' => 'sukses']]);
    }

    public function presensiPulang(Request $request, $kode)
    {
        $tgl_presensi = date('Y-m-d', time());
        $latitude = $request->lat_pulang;
        $longitude = $request->long_pulang;
        $nip = $request->nip;
        $presensi = Presensi::firstWhere('kode_presensi', $kode);
        $pengaturan_presensi = Settings::first();
        $waktu_presensi = date('H:i', time());
        // CEK APAKAH DIA TERLAMBAT
        $cek_presensi = PresensiDetail::where('kode_presensi', $kode)->where('nip', $nip)->first();
        // dd($cek_presensi_masuk->presensi_masuk);
        if ($cek_presensi->presensi_masuk == null) {
            return response()->json(['pesan' => 'kamu belum masuk']);
        }
        if ($cek_presensi->presensi_pulang != null) {
            return response()->json(['pesan' => 'kamu sudah pulang']);
        }

        function distancePulang($lat1, $lon1, $lat2, $lon2, $unit)
        {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            } else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit = strtoupper($unit);

                if ($unit == "K") {
                    return ($miles * 1.609344);
                } else if ($unit == "N") {
                    return ($miles * 0.8684);
                } else {
                    return $miles;
                }
            }
        }
        $jarak_belum_bulat =  (distancePulang($pengaturan_presensi->lat, $pengaturan_presensi->long, $latitude, $longitude, "K") * 1000);
        $jarak = ceil($jarak_belum_bulat);
        if ($pengaturan_presensi->batas_jarak < $jarak) {

            return response()->json(['pesan' => 'Kamu berada sejauh ' . $jarak . 'm dari jarak yang ditentukan']);
        }

        $data_presensi = [
            'presensi_pulang' => date('H:i:s', time()),
            'status_pulang' => 1,
            'lat_pulang' => $latitude,
            'long_pulang' => $longitude,
        ];
        // return response()->json(['pesan'=>'sukses', 'data'=>$data_presensi]);
        $presensi_detail = PresensiDetail::firstWhere('tgl_presensi', $tgl_presensi)->where('kode_presensi', $kode)->where('nip', $nip)->update($data_presensi);
        $jumlah_pulang = ($presensi->jumlah_pegawai_pulang + 1);

        $data_presensi = [
            'jumlah_pegawai_pulang' => $jumlah_pulang,
        ];

        // $pesan = ['pesan'=>'Berhasil'];
        Presensi::where('kode_presensi', $kode)
            ->update($data_presensi);
        return response()->json(['pesan' => 'sukses']);
    }

    public function presensiIzin(Request $request, $kode)
    {
        $nip = $request->nip;
        $alasan = $request->alasan;
        $kode_presensi = $kode;
        $bukti_izin = '';
        $presensi = Presensi::firstWhere('kode_presensi', $kode);
        $tgl_presensi = date("Y-m-d", time());

        // dd($kode_presensi);

        $cekPresensi = PresensiDetail::where('tgl_presensi', $tgl_presensi)->where('kode_presensi', $kode_presensi)->where('nip', $nip)->first();
        if ($cekPresensi->presensi_pulang) {
            return response()->json("Kamu sudah pulang hari ini. Ajukan izin esok hari");
        }

        $data_presensiPegawai = [
            'izin' => date('H:i:s', time()),
            'status_izin' => 1, //menunggu persetujuan //2 disetujui //3 ditolak
            'alasan' => $alasan,
            'bukti_izin' => $bukti_izin
        ];

        $jumlah_pulang = ($presensi->jumlah_izin + 1);

        $data_presensi = [
            'jumlah_izin' => $jumlah_pulang,
        ];

        $izin = PresensiDetail::where('tgl_presensi', $tgl_presensi)
            ->where('kode_presensi', $kode_presensi)
            ->where('nip', $nip)
            ->update($data_presensiPegawai);
        if ($izin) {
            Presensi::where('kode_presensi', $kode)
                ->update($data_presensi);
            return response()->json('Izin berhasil diajukan');
        }
        return response()->json('Izin gagal diajukan');
    }

    public function riwayat($nip)
    {
        $data = PresensiDetail::where('nip', $nip)->orderBy('tgl_presensi', 'desc')->get();
        // if($data->presensi_masuk != null){
        return response()->json($data);
        // }

    }
}
