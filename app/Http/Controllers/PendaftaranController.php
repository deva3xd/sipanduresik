<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function index() {
        $title = "Pendaftaran";
        return view('pendaftaran.index', ['title' => $title]);
    }
    
    public function status() {
        $title = "Status";
        $pendaftarans = Pendaftaran::all();
        return view('pendaftaran.status', ['title' => $title, 'pendaftarans' => $pendaftarans]);
    }

    public function store(Request $request)
    {
        $validateData = validator($request->all(), [
            'nokk' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'permohonan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ])->validate();

        $pendaftaran = new Pendaftaran($validateData);
        $pendaftaran->save();
        alert()->success('Sukses', 'Data Berhasil Ditambahkan!');
        return redirect(route('pendaftaran'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->nokk = $request->input('12121');
        $pendaftaran->nik = $request->input('909090');
        $pendaftaran->permohonan = $request->input('email');
        $pendaftaran->status = $request->input('tidak aktif');
        $pendaftaran->save();
        return redirect()->back()->with('status','Status Updated Successfully');
    }

    public function delete(Pendaftaran $id)
    {
        $id->delete();
        alert()->success('Sukses', 'Data Berhasil Dihapus!');
        return redirect(route('status'))->with('success', 'Data Berhasil Dihapus');
    }
}
