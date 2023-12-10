<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Http\Requests\StoreSettingsRequest;
use App\Http\Requests\UpdateSettingsRequest;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Admin E-Presensi | Pengaturan Presensi';
        $plugin_css = '';
        $plugin_js = '';
        $settings = Settings::first();
        return view('content.settings.index', compact('title', 'plugin_css', 'plugin_js', 'settings'));
    }

    public function store(StoreSettingsRequest $request)
    {
        $lat_long = explode(',', $request->lat_long);
        if ($request->toleransi < $request->jam_masuk) {
            return redirect('/admin/settings')->with('pesan', "
        <script>
                Swal.fire(
                    'opps!',
                    'Toleransi Keterlambatan Tidak Boleh Kecil dari Jam Masuk!',
                    'warning'
                )
            </script>
        ");
        }
        $data = [
            'jam_masuk' => $request->jam_masuk,
            'toleransi' => $request->toleransi,
            'jam_pulang' => $request->jam_pulang,
            'lat' => $lat_long[0],
            'long' => $lat_long[1],
            'batas_jarak' => $request->batas_jarak,
        ];

        Settings::create($data);
        return redirect('/admin/settings')->with('pesan', "
        <script>
                Swal.fire(
                    'Sukses!',
                    'Data Disimpan!',
                    'success'
                )
            </script>
        ");
    }

    public function update(UpdateSettingsRequest $request, $id)
    {
        $lat_long = explode(',', $request->lat_long);
        if ($request->toleransi < $request->jam_masuk) {
            return redirect('/admin/settings')->with('pesan', "
        <script>
                Swal.fire(
                    'opps!',
                    'Toleransi Keterlambatan Tidak Boleh Kecil dari Jam Masuk!',
                    'warning'
                )
            </script>
        ");
        }
        $data = [
            'jam_masuk' => $request->jam_masuk,
            'toleransi' => $request->toleransi,
            'jam_pulang' => $request->jam_pulang,
            'lat' => $lat_long[0],
            'long' => $lat_long[1],
            'batas_jarak' => $request->batas_jarak,
        ];

        Settings::where('id', $id)->update($data);
        return redirect('/admin/settings')->with('pesan', "
        <script>
                Swal.fire(
                    'Sukses!',
                    'Data Disimpan!',
                    'success'
                )
            </script>
        ");
    }
}
