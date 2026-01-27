<?php

namespace App\Http\Controllers;

use App\Models\Bpd;
use App\Models\MasterBpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class BpdController extends Controller
{
 public function index(Request $request)
{
    $departmentId = Session::get('department_id');
    $sort = $request->get('sort', 'asc');

    $bpds = Bpd::where('id_department', $departmentId)
                ->orderBy('no_bpd', $sort)
                ->paginate(5)
                ->appends(['sort' => $sort]);

    $masterBpds = MasterBpd::all();

    return view('bpd.index', compact('bpds', 'masterBpds', 'sort'));
}



    public function exportPdf()
    {
        $departmentId = Session::get('department_id');
        $bpds = Bpd::where('id_department', $departmentId)->get();

        $pdf = Pdf::loadView('bpd.pdf', compact('bpds'));
        return $pdf->download('bpd_list.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_bpd' => 'required|unique:tbl_bpds,no_bpd',
            'objective' => 'required',
        ]);

        Bpd::create([
            'id_department' => Session::get('department_id'),
            'no_bpd' => $request->no_bpd,
            'objective' => $request->objective,
            'created_by' => Session::get('department_id'), // Assuming department creates it
        ]);

        return redirect()->route('bpd.index')->with('success', 'BPD created successfully.');
    }

    public function update(Request $request, Bpd $bpd)
    {
        // Ensure BPD belongs to current department
        if ($bpd->id_department != Session::get('department_id')) {
            abort(403);
        }

        $request->validate([
            'no_bpd' => 'required|unique:tbl_bpds,no_bpd,' . $bpd->id_bpd . ',id_bpd',
            'objective' => 'required',
        ]);

        $bpd->update([
            'no_bpd' => $request->no_bpd,
            'objective' => $request->objective,
        ]);

        return redirect()->route('bpd.index')->with('success', 'BPD updated successfully.');
    }

    public function destroy(Bpd $bpd)
    {
        // Ensure BPD belongs to current department
        if ($bpd->id_department != Session::get('department_id')) {
            abort(403);
        }

        $bpd->delete();

        return redirect()->route('bpd.index')->with('success', 'BPD deleted successfully.');
    }
}
