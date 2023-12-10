<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class AdminJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Admin E-Presensi | Jabatan Page';
        $plugin_css = '
                <link rel="stylesheet" href="' . url('') . '/assets/vendor/datatables/dataTables.bs4.css" />
                <link rel="stylesheet" href="' . url('') . '/assets/vendor/datatables/dataTables.bs4-custom.css" />
                <link href="' . url('') . '/assets/vendor/datatables/buttons.bs.css" rel="stylesheet" />
        ';

        $plugin_js = '
                <script src="' . url('') . '/assets/vendor/datatables/dataTables.min.js"></script>
                <script src="' . url('') . '/assets/vendor/datatables/dataTables.bootstrap.min.js"></script>
                <script src="' . url('') . '/assets/vendor/datatables/custom/custom-datatables.js"></script>
        ';

        $data = Jabatan::all();
        return view('content.jabatan.index', compact('title', 'plugin_css', 'plugin_js', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Admin E-Presensi | Tambah Jabatan';

        $plugin_css = '';
        $plugin_js = '';
        return view('content.jabatan.jabatan_create', compact('title',  'plugin_css', 'plugin_js'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return('abc');
        $nama_jabatan = $request->nama;
        $data_jabatan = [];
        foreach ($nama_jabatan as $jabatan) {
            array_push($data_jabatan, [
                'nama' => $jabatan
            ]);
        }
        $data = Jabatan::insert($data_jabatan);
        return redirect('/admin/jabatan')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data Disimpan!',
                    'success'
                )
            </script>
        ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $jabatan = Jabatan::where('id', $request->id)->first();
        return view('content.jabatan.jabatan_edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $data = [
            'nama' => $request->nama
        ];
        $update = Jabatan::where('id', $id)->update($data);
        if($update){
            return redirect('/admin/jabatan')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data Perbarui!',
                    'success'
                )
            </script>
            ");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hapus = Jabatan::where('id', $id)->delete();
        if ($hapus) {
            return redirect('/admin/jabatan')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data di hapus!',
                    'success'
                )
            </script>
            ");
        } else {
            return redirect('/admin/jabatan')->with('pesan', "
            <script>
                Swal.fire(
                    'Oop!',
                    'Data gagal di hapus!',
                    'error'
                )
                </script>
            ");
        }
    }
}
