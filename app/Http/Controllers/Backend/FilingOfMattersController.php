<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\filingOfMatter;
use App\Models\Lawyer;
use App\Models\Room;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use File;
use Illuminate\Support\Facades\Auth;

class FilingOfMattersController extends Controller
{
    public function index()
    {
        $data['filingOfMatters'] = FilingOfMatter::orderBy('name', 'DESC')->get();
        $data['title'] = '';
        if (Auth::user()->role !== 'people') :
            $data['submissions'] = Submission::orderBy('id', 'DESC')->get();
            $data['rooms'] = Room::orderBy('name', 'ASC')->get();
            $data['lawyers'] = Lawyer::all();
        else :
            $data['submissions'] = Submission::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        endif;

        return view('backend.v1.pages.filing-of-matters.index', $data);
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data['filingOfMatter'] = filingOfMatter::find($id);
        return view('pages.filing-of-matters.create', $data);
    }
}
