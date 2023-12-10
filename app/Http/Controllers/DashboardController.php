<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PresensiDetail;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Admin E-Presensi';
        $plugin_css = '
        <link rel="stylesheet" href="' . url('') . '/assets/vendor/datatables/dataTables.bs4.css" />
        <link rel="stylesheet" href="' . url('') . '/assets/vendor/datatables/dataTables.bs4-custom.css" />
        <link href="' . url('') . '/assets/vendor/datatables/buttons.bs.css" rel="stylesheet" />
        ';
        $plugin_js = '
        <script src="' . url('') . '/assets/vendor/datatables/dataTables.min.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/custom/custom-datatables.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/buttons.min.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/jszip.min.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/pdfmake.min.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/vfs_fonts.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/html5.min.js"></script>
        <script src="' . url('') . '/assets/vendor/datatables/buttons.print.min.js"></script>	
        ';
        $setting = Settings::first();
        $jumlahPegawai = Pegawai::all()->count();
        $data = PresensiDetail::where('tgl_presensi', date('Y-m-d', time()))->with('pegawai');
        $presensi = $data->get();
        $presensiDetail = $data->first();
        $rekapPresensi = DB::table('presensi_details')
            ->selectRaw('count(presensi_masuk) as jmlHadir, SUM(IF(presensi_masuk > "' . $setting->toleransi . '",1,0)) as jmlTelat, SUM(IF(presensi_masuk < "' . $setting->toleransi . '",1,0)) as jmlTepatwaktu')
            ->where('tgl_presensi', date('Y-m-d', time()))
            ->first();
        $rekapIzin =
            DB::table('presensi_details')
            ->selectRaw('count(izin) as jmlIzin')
            ->where('tgl_presensi', date('Y-m-d', time()))
            ->first();

        return view('content.dashboard.dashboard', compact('jumlahPegawai', 'plugin_css', 'plugin_js', 'presensi', 'rekapPresensi', 'rekapIzin', 'presensiDetail', 'title'));
    }
}
