<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\filingOfMatter;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $data['filingOfMatters'] = filingOfMatter::orderBy('name', 'ASC')->get();
        return view('pages.report.index', $data);
    }
}
