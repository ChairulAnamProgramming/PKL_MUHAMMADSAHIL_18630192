<?php

namespace App\Http\Controllers\Backend\V1;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataFOMController extends Controller
{
    public function index()
    {
        $data['submissions'] = Submission::where('user_id', Auth::user()->id)->get();
        return view('backend.v1.pages.my-fom.index', $data);
    }
}
