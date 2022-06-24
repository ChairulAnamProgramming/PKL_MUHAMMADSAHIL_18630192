<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\People;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlaintiffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['submissions'] = Submission::with('user')->orderBy('id', 'DESC')->get();
        return view('backend.v1.pages.plaintiff.index', $data);
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
            'nik' => 'required|string|max:255',
            'address' => 'required|string',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|string',
            'gender' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'people',
            'password' => Hash::make('dahaselatan'),
        ]);

        $people = People::create([
            'user_id' => $user->id,
            'type' => 'penggugat',
            'nik' => $request->nik,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
        ]);

        if ($people) :
            return redirect()->back()->with('success', 'Data penggugat berhasil di simpan');
        endif;
        return redirect()->back()->with('error', 'Data penggugat gagal di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_people)
    {
        $people = People::find($id_people);
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'address' => 'required|string',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|string',
            'gender' => 'required|string',
        ]);

        User::find($people->user_id)->update([
            'name' => $request->name,
        ]);

        $people->update([
            'nik' => $request->nik,
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
        ]);

        if ($people) :
            return redirect()->back()->with('success', 'Data penggugat berhasil di edit');
        endif;
        return redirect()->back()->with('error', 'Data penggugat gagal di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_people)
    {
        $people = People::find($id_people);
        $user = User::find($people->user_id);
        $user->delete();
        if ($user) :
            return redirect()->back()->with('success', 'Data penggugat berhasil di hapus');
        endif;
        return redirect()->back()->with('error', 'Data penggugat gagal di hapus');
    }
}
