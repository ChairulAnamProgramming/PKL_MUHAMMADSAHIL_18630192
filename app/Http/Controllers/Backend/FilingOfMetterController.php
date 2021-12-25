<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\filingOfMatter;
use Illuminate\Http\Request;
use File;

class FilingOfMetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['filingOfMatters'] = filingOfMatter::orderBy('id', 'DESC')->get();
        return view('pages.filing-of-matter.index', $data);
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
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        if ($request->file('icon')) :
            $request->validate([
                'icon' => 'required'
            ]);

            $icon = $request->file('icon')->store('filing-of-matter', 'public');

        else :
            $icon = 'default.png';
        endif;

        $filingOfMatter = filingOfMatter::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'icon' => $icon,
        ]);

        if ($filingOfMatter) :
            return redirect()->back()->with('success', 'Jenis Perkara berhasil di simpan');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\filingOfMatter  $filingOfMatter
     * @return \Illuminate\Http\Response
     */
    public function show(filingOfMatter $filingOfMatter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\filingOfMatter  $filingOfMatter
     * @return \Illuminate\Http\Response
     */
    public function edit(filingOfMatter $filingOfMatter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\filingOfMatter  $filingOfMatter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, filingOfMatter $filingOfMatter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        if ($request->file('icon')) :
            $request->validate([
                'icon' => 'required'
            ]);
            File::delete('storage/' . $filingOfMatter->icon);
            $icon = $request->file('icon')->store('filing-of-matter', 'public');
        else :
            $icon = $filingOfMatter->icon;
        endif;

        $filingOfMatter->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'icon' => $icon,
        ]);

        if ($filingOfMatter) :
            return redirect()->back()->with('success', 'Jenis Perkara berhasil di perbarui');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\filingOfMatter  $filingOfMatter
     * @return \Illuminate\Http\Response
     */
    public function destroy(filingOfMatter $filingOfMatter)
    {
        if ($filingOfMatter->icon != 'default.png') :
            File::delete('storage/' . $filingOfMatter->icon);
        endif;

        $filingOfMatter->delete();
        if ($filingOfMatter) :
            return redirect()->back()->with('success', 'Jenis Perkara berhasil di hapus');
        endif;
    }
}
