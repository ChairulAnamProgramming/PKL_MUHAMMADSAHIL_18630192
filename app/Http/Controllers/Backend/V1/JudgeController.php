<?php

namespace App\Http\Controllers\Backend\V1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::where('type', 'hakim')->get();
        return view('backend.v1.pages.judge.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        $judge = Employee::where('nip', $request->nip)->first();
        $judge->update([
            'type' => 'hakim'
        ]);
        if ($judge) :
            return redirect()->back()->with('success', 'Data hakim berhasil di simpan');
        endif;
        return redirect()->back()->with('error', 'Data hakim gagal di simpan');
    }

    public function destroy(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update([
            'type' => 'pegawai'
        ]);
        if ($employee) :
            return redirect()->back()->with('success', 'Data hakim berhasil di hapus');
        endif;
        return redirect()->back()->with('error', 'Data hakim gagal di hapus');
    }
}
