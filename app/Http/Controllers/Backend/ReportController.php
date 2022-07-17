<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\filingOfMatter;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReportController extends Controller
{
    public function index()
    {
        $data['filingOfMatters'] = filingOfMatter::orderBy('name', 'ASC')->get();
        $data['employees'] = Employee::all();
        return view('backend.v1.pages.report.index', $data);
    }

    public function filing_of_matter(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'firstDate' => 'required|date',
            'lastDate' => 'required|date',
            'status' => 'in:proses,reject,payment,scheduling,success',
            'employee_id' => 'required|string|exists:employees,id'
        ]);

        $firstDate = $request->firstDate;
        $lastDate = $request->lastDate;
        $status = $request->status;
        $data['employee'] = Employee::find($request->employee_id);

        $data['data'] = Submission::where('filing_of_matter_id', $id)
            ->where('status', $status)
            ->whereBetween('created_at', [$firstDate, $lastDate])
            ->get();
        $data['status'] = $status;
        $data['title'] = 'Laporan ' . filingOfMatter::find($id)->name . ' tanggal ' . $firstDate . ' sampai ' . $lastDate . ' status <b>' . $status . '</b>';
        return view('backend.v1.pages.report.pages.filingOfMatter', $data);
    }
}
