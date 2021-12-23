<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = Employee::with('user')->orderBy('id', 'DESC')->get();
        return view('pages.employee.index', $data);
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
            'email' => 'required|string|max:255|unique:users',
            'nip' => 'required|string|max:255|unique:employees',
            'position' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'employee',
            'password' => Hash::make('dahaselatan')
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'position' => $request->position,
            'golongan' => $request->golongan,
        ]);

        if ($employee) :
            return redirect()->back()->with('success', 'Data karyawan berhasil di simpan');
        endif;
        return redirect()->back()->with('error', 'Data karyawan gagal di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
        ]);

        $user = User::find($employee->user_id)->update([
            'name' => $request->name,
        ]);

        $employee = Employee::find($employee->id)->update([
            'nip' => $request->nip,
            'position' => $request->position,
            'golongan' => $request->golongan,
        ]);

        if ($employee) :
            return redirect()->back()->with('success', 'Data karyawan berhasil di edit');
        endif;
        return redirect()->back()->with('error', 'Data karyawan gagal di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $user = User::find($employee->user_id);
        $user->delete();
        if ($user) :
            return redirect()->back()->with('success', 'Data karyawan berhasil di hapus');
        endif;
        return redirect()->back()->with('error', 'Data karyawan gagal di hapus');
    }
}
