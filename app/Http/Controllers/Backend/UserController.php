<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\People;
use App\Models\User;
use Illuminate\Http\Request;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $people = People::where('user_id', $user->id)->first();

        if ($request->file('ktp')) :
            if ($people->ktp !== 'default.png') :
                File::delete('storage/' . $people->ktp);
            endif;
            $KTP = $request->file('ktp')->store('KTP', 'public');
        else :
            $KTP = $people->ktp;
        endif;

        if ($request->file('kk')) :
            if ($people->kk !== 'default.png') :
                File::delete('storage/' . $people->kk);
            endif;
            $KK = $request->file('kk')->store('KK', 'public');
        else :
            $KK = $people->kk;
        endif;

        $user->update([
            'name' => $request->name
        ]);
        $people->update([
            'nik' => $request->nik,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'ktp' => $KTP,
            'kk' => $KK,
        ]);

        if ($user || $people) :
            return redirect()->back()->with('success', 'Data anda berhasil di perbaharui.');
        endif;
        return redirect()->back()->with('danger', 'Data anda gagal di perbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
