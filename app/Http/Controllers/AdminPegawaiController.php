<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Admin E-Presensi | Pegawai Page';
        $plugin_css = '
                <link rel="stylesheet" href="' . url('') . '/assets/vendor/datatables/dataTables.bs4.css" />
                <link rel="stylesheet" href="' . url('') . '/assets/vendor/datatables/dataTables.bs4-custom.css" />
                <link href="' . url('') . '/assets/vendor/datatables/buttons.bs.css" rel="stylesheet" />
                <link rel="stylesheet" href="' . url('') . '/assets/vendor/bs-select/bs-select.css" />

        ';
        $plugin_js = '
                <script src="' . url('') . '/assets/vendor/bs-select/bs-select.min.js"></script>
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

        $pegawai = Pegawai::with('jabatan')->get();
        $jabatan = Jabatan::all();
        return view('content.pegawai.index', compact('title', 'plugin_css', 'plugin_js', 'pegawai', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Admin E-Presensi | Tambah Pegawai';

        $plugin_css = '
                <link rel="stylesheet" href="' . url('') . '/assets/vendor/bs-select/bs-select.css" />
                ';
        $plugin_js = '
                <script src="' . url('') . '/assets/vendor/bs-select/bs-select.min.js"></script>
                <script src="' . url('') . '/assets/vendor/bs-select/bs-select-custom.js"></script>
        ';

        $jabatan = Jabatan::all();
        return view('content.pegawai.pegawai_create', compact('title', 'plugin_css', 'plugin_js', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cekNip = Pegawai::where('nip', $request->nip)->count();
        $cekEmail = Pegawai::where('email', $request->email)->count();
        if ($cekNip != null) {
            return back()->with('pesan', "
            <script>
                Swal.fire(
                    'Opps!',
                    'Nip sudah pernah dipakai!',
                    'warning'
                )
            </script>
        ");
        } else if ($cekEmail != null) {
            return back()->with('pesan', "
            <script>
                Swal.fire(
                    'Opps!',
                    'Email sudah pernah dipakai!',
                    'warning'
                )
            </script>
        ");
        }
        $rules = [
            'nip' => 'required|max:255|unique:pegawais',
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'jabatan_id' => 'required',
            'email' => 'required|unique:pegawais',
            'gambar' => 'image|file',
        ];

        $validatedData = $request->validate($rules);
        // cek apakah ada gambar yang di upload
        if ($request->file('gambar')) {
            $validatedData['foto'] = str_replace('assets/img/pegawai/', '', $request->file('gambar')->store('assets/img/pegawai'));
        } else {
            $validatedData['foto'] = '';
        }

        $validatedData['password'] = $request->nip;
        $validatedData['is_active'] = 1;
        $validatedData['role'] = 2;

        Pegawai::create($validatedData);
        return redirect('/admin/pegawai')->with('pesan', "
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
        $pegawai = Pegawai::where('nip', $request->nip)->with('jabatan')->first();
        $jabatan = Jabatan::all();
        return view('content.pegawai.pegawai_edit', compact('pegawai', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nip)
    {
        if ($request->password == null) {
            $data = [
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email' => $request->email,
                'is_active' => $request->is_active,
            ];
            $update = Pegawai::where('nip', $nip)->update($data);
            if ($update) {
                return redirect('/admin/pegawai')->with(
                    'pesan',
                    "<script>
                Swal.fire(
                    'Sukses!',
                    'Data berhasil diubah',
                    'success'
                )
            </script>"
                );
            } else {
                return redirect('/admin/pegawai')->with(
                    'pesan',
                    "<script>
                Swal.fire(
                    'Oops!',
                    'Data gagal diubah',
                    'warning'
                )
            </script>"
                );
            }
        } else {
            $data = [
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active,
            ];
            $update = Pegawai::where('nip', $nip)->update($data);
            if ($update) {
                return redirect('/admin/pegawai')->with(
                    'pesan',
                    "<script>
                Swal.fire(
                    'Sukses!',
                    'Data berhasil diubah',
                    'success'
                )
            </script>"
                );
            } else {
                return redirect('/admin/pegawai')->with(
                    'pesan',
                    "<script>
                Swal.fire(
                    'Oops!',
                    'Data gagal diubah',
                    'warning'
                )
            </script>"
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Pegawai::where('nip', $request->nip)->delete();
        return redirect('/admin/pegawai')->with('pesan', "
            <script>
                Swal.fire(
                    'Sukses!',
                    'Data di hapus!',
                    'success'
                )
            </script>
        ");
    }
}
