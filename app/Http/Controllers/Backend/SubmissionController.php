<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
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
        $request->validate([
            'filing_of_matter_id' => 'required|exists:filing_of_matters,id'
        ]);

        $lastSubmission = Submission::orderBy('id', 'DESC')->first();

        if ($lastSubmission) :
            $substr = (int) substr($lastSubmission->number, 0, 3);
            $substr++;
            $number = sprintf("%03s", $substr);
        else :
            $number = '001';
        endif;

        $submission = Submission::create([
            'filing_of_matter_id' => $request->filing_of_matter_id,
            'user_id' => Auth::user()->id,
            'number' => $number,
            'status' => 'proses',
        ]);

        if ($submission) :
            return redirect()->back()->with('success', 'Perkara berhasil di ajukan');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'status' => 'required|in:proses,reject,payment,scheduling,success'
        ]);

        if ($request->status === 'scheduling') :
            $proof_of_payment = $request->file('proof_of_payment')->store('proof_of_payment', 'public');
            $submission->update([
                'proof_of_payment' => $proof_of_payment
            ]);
        endif;

        if ($request->status === 'success') :
            $data = $request->all();
            $data['number'] = $request->number;
            $data['timetable'] = $request->timetable;
            $data['time'] = $request->time;
            $data['father_name'] = $request->father_name;
            $data['defendant_name'] = $request->defendant_name;
            $submission->update($data);
            $submission->judges()->attach($request->hakim);
            $submission->lawyers()->attach($request->pengacara);
            $submission->rooms()->attach($request->room);
        endif;


        $status = $submission->update([
            'status' => $request->status
        ]);

        if ($status) :
            return redirect()->back()->with('success', 'Status pengajuan berhasil di perbaharui');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();

        if ($submission) :
            return redirect()->back()->with('success', 'Pengajuan perkara berhasil di batalkan.');
        endif;
    }
}
