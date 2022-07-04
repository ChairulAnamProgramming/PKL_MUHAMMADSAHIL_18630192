<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\lawyer;
use App\Models\People;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LawyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = Employee::where('type', 'pengacara')->get();
        return view('backend.v1.pages.lawyer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $lawyer = Employee::where('nip', $request->nip)->first();
        $data['employee_id'] = $lawyer->id;
        $create = lawyer::create($data);
        $lawyer->update([
            'type' => 'pengacara'
        ]);
        if ($lawyer) :
            return redirect()->back()->with('success', 'Data pengacara berhasil di simpan');
        endif;
        return redirect()->back()->with('error', 'Data pengacara gagal di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function show(lawyer $lawyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function edit(lawyer $lawyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lawyer $lawyer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
        ]);

        $user = User::find($lawyer->user_id)->update([
            'name' => $request->name,
        ]);

        $lawyer = lawyer::find($lawyer->id)->update([
            'nip' => $request->nip,
        ]);

        if ($lawyer) :
            return redirect()->back()->with('success', 'Data pengacara berhasil di edit');
        endif;
        return redirect()->back()->with('error', 'Data pengacara gagal di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $employee = Employee::find($id);
        lawyer::where('employee_id', $employee->id)->delete();
        $employee->update([
            'type' => 'pegawai'
        ]);
        if ($employee) :
            return redirect()->back()->with('success', 'Data pengacara berhasil di hapus');
        endif;
        return redirect()->back()->with('error', 'Data pengacara gagal di hapus');
    }
}
