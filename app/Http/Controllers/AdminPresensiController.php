<?php

namespace App\Http\Controllers;

use tidy;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\PresensiDetail;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Admin E-Presensi | Presensi Page';
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

        $presensi = Presensi::firstWhere('tgl_presensi', date('d-m-Y', time()));
        $riwayat_presensi = Presensi::all();
        return view('content.presensi.index', compact('title', 'plugin_css', 'plugin_js', 'presensi', 'riwayat_presensi'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

        $presensi = Presensi::firstWhere('tgl_presensi', date('d-m-Y', time()));
        if ($presensi !== null) {
            return redirect('/admin/presensi')->with('pesan', "
                <script>
                    Swal.fire(
                        'Oops!',
                        'Presensi Hari Ini Sudah Dibuat',
                        'error'
                    )
                </script>
            ");
        }


        $pegawai = Pegawai::all();
        if ($pegawai->count() == 0) {
            return redirect('/admin/presensi')->with('pesan', "
                <script>
                    Swal.fire(
                        'Oops!',
                        'Tidak Dapat Membuat Daftar Presensi <br> Jumlah Pegawai 0 <br> Daftarkan Pegawai Dahulu',
                        'error'
                    )
                </script>
            ");
        }

        $settings = Settings::first();
        if ($settings == null) {
            return redirect('/admin/presensi')->with('pesan', "
                <script>
                    Swal.fire(
                        'Oops!',
                        'Pengaturan Jarak dan Lokasi Belum Dibuat.<br>Silahkan Masuk Ke Pengaturan Presensi.',
                        'error'
                    )
                </script>
            ");
        }



        $kode_presensi = Str::random(25);
        // dd($setting->id);

        $data_presensi = [
            'kode_presensi' => $kode_presensi,
            'jumlah_pegawai' => $pegawai->count(),
            'jumlah_pegawai_masuk' => null,
            'jumlah_pegawai_pulang' => null,
            'jumlah_izin' => null,
            'total_izin' => null,
            'total' => null,
            'tgl_presensi' => date('d-m-Y', time())
        ];

        $presensi_detail = [];

        foreach ($pegawai as $item) {
            array_push($presensi_detail, [
                'tgl_presensi' => date('Y-m-d', time()),
                'kode_presensi' => $kode_presensi,
                'nip' => $item->nip,
            ]);
        }

        Presensi::create($data_presensi);
        PresensiDetail::insert($presensi_detail);

        return redirect('/admin/presensi')->with('pesan', "
        <script>
        Swal.fire(
            'Sukses!',
            'Presensi Hari Ini Berhasil Dibuat.',
            'success'
        );
        </script>
        ");
    }

    /**
     * Display the specified resource.
     */
    public function showPresensiDetail($kode_presensi)
    {
        $presensi = Presensi::where('kode_presensi', $kode_presensi)->first();
        $detailPresensi = PresensiDetail::with('pegawai')->where('kode_presensi', $kode_presensi)->get();
        $title = 'Presensi Tanggal '.$presensi->tgl_presensi;
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
        return view('content.presensi.detail_presensi_harian', compact('title', 'plugin_css', 'plugin_js', 'presensi', 'detailPresensi'));
    }
    public function presensiBulanan()
    {
        $title = 'Laporan Presensi';
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
        $data = PresensiDetail::where('tgl_presensi', 'like', '%'.date('m', time()).'%')->get();
        return view('content.presensi.laporan_presensi_bulanan', compact('title', 'plugin_css', 'plugin_js', 'data',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editIzin(Request $request)
    {
        $date = date('Y-m-d', time());
        $data = PresensiDetail::with('pegawai')
            ->where('tgl_presensi', $date)
            ->where('kode_presensi', $request->kode_presensi)
            ->where('nip', $request->nip)
            ->first();
        return view('content.izin.persetujuan_izin', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateIzin(Request $request, $nip)
    {
        // dd($request->all());
        $date = date('Y-m-d', time());
        $status = $request->status_izin;

        $presensi = Presensi::firstWhere('kode_presensi', $request->kode_presensi);
        $dataPresensi = $presensi->first();
        $jumlah_pulang = $presensi->jumlah_pegawai_pulang;
        $jumlah_izin = $presensi->jumlah_izin;

        $presensiDetail = PresensiDetail::where('tgl_presensi', $date)
            ->where('kode_presensi', $request->kode_presensi)
            ->where('nip', $nip);
        $dataPresensiDetail = $presensiDetail->first();
        //cek persetujuan izin
        if ($status == 1) {
            return redirect('/home')->with('pesan', "
                <script>
                Swal.fire(
                    '',
                    'Harap Menyetujui Atau Menolak Pengajuan Izin!',
                    'warning'
                );
                </script>
                ");
        }
        // dd(['jam masuk'=> $dataPresensiDetail->presensi_masuk, 'jam pulang' => $dataPresensiDetail->presensi_pulang, 'status'=> $status]);
        //cek presensi masuk dan pulang
        if ($dataPresensiDetail->presensi_masuk != null && $dataPresensiDetail->presensi_pulang == null && $status == 3) //ditolak dan belum pulang
        {
            $data = [
                'status_izin' => $status
            ];
            $update = $presensiDetail->update($data);
            if ($update) {
                return redirect('/home')->with('pesan', "
                <script>
                Swal.fire(
                    '',
                    'Pengajuan Izin Ditolak!',
                    'success'
                );
                </script>
                ");
            }
        } else if ($dataPresensiDetail->presensi_masuk != null && $dataPresensiDetail->presensi_pulang == null && $status == 2) //diizinkan tapi belum pulang
        {
            $data = [
                'presensi_pulang' => date('H:i:s', time()),
                'status_izin' => $status
            ];

            $update = $presensiDetail->update($data);

            if ($update) {
                Presensi::where('kode_presensi', $request->kode_presensi)
                    ->update([
                        'jumlah_pegawai_pulang' => $presensi->jumlah_pegawai_pulang + 1,
                        'jumlah_izin' => $presensi->jumlah_izin + 1,
                    ]);
                return redirect('/home')->with('pesan', "
                <script>
                Swal.fire(
                    '',
                    'Pengajuan Izin Diterima',
                    'success'
                );
                </script>
                ");
            }
        } else if ($dataPresensiDetail->presensi_masuk == null && $dataPresensiDetail->presensi_pulang == null && $status == 3) //ditolak dan sama sekali belum masuk
        {
            // dd('ke tolak kan?');
            $data = [
                'status_izin' => $status
            ];
            $update = $presensiDetail->update($data);
            if ($update) {
                return redirect('/home')->with('pesan', "
                <script>
                Swal.fire(
                    '',
                    'Pengajuan Izin Ditolak!',
                    'success'
                );
                </script>
                ");
            }
        } else if ($dataPresensiDetail->presensi_masuk == null && $dataPresensiDetail->presensi_pulang == null && $status == 2) //diizinkan, sama sekali gak masuk
        {
            // dd('ke terima?');
            $data = [
                'presensi_masuk' => 'izin',
                'presensi_pulang' => 'izin',
                'status_izin' => $status
            ];
            $update = $presensiDetail->update($data);
            if ($update) {
                Presensi::where('kode_presensi', $request->kode_presensi)
                    ->update([
                        'jumlah_izin' => $presensi->jumlah_izin + 1,
                    ]);
                return redirect('/home')->with('pesan', "
                <script>
                Swal.fire(
                    '',
                    'Pengajuan Izin Diterima.',
                    'success'
                );
                </script>
                ");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
