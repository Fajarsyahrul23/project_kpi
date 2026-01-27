<?php

namespace App\Http\Controllers;

use App\Models\Bpd;
use App\Models\Kpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KpiImport;

class KpiController extends Controller
{
    public function index($id_bpd)
    {
        $bpd = Bpd::where('id_bpd', $id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        $kpis = Kpi::where('id_bpd', $id_bpd)->with(['bpd.department']) ->get();

        return view('kpi.index', compact('bpd', 'kpis'));
    }

    public function create($id_bpd)
    {
        $bpd = Bpd::where('id_bpd', $id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        return view('kpi.create', compact('bpd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bpd' => 'required|exists:tbl_bpds,id_bpd',
            'definition' => 'nullable|string',
            'periode' => 'nullable|date',
            'com_target' => 'nullable|numeric',
            'com_actual' => 'nullable|numeric',
            'target' => 'nullable|string',
            'actual' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        // Verify BPD ownership
        $bpd = Bpd::where('id_bpd', $request->id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        Kpi::create([
            'id_bpd' => $request->id_bpd,
            'definition' => $request->definition,
            'periode' => $request->periode,
            'com_target' => $request->com_target,
            'com_actual' => $request->com_actual,
            'target' => $request->target,
            'actual' => $request->actual,
            'note' => $request->note,
            'created_by' => Session::get('department_id'),
        ]);

        return redirect()->route('kpi.index', $request->id_bpd)->with('success', 'KPI added successfully.');
    }

    public function edit($id_kpi)
    {
        $kpi = Kpi::findOrFail($id_kpi);

        // Verify ownership via BPD
        $bpd = Bpd::where('id_bpd', $kpi->id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        return view('kpi.edit', compact('kpi'));
    }

    public function update(Request $request, $id_kpi)
    {
        $kpi = Kpi::findOrFail($id_kpi);

        // Verify ownership via BPD
        $bpd = Bpd::where('id_bpd', $kpi->id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        $request->validate([
            'definition' => 'nullable|string',
            'periode' => 'nullable|date',
            'target' => 'nullable|string',
            'actual' => 'nullable|string',
            'com_target' => 'nullable|numeric',
            'com_actual' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        $kpi->update([
            'definition' => $request->definition,
            'periode' => $request->periode,
            'target' => $request->target,
            'actual' => $request->actual,
            'com_target' => $request->com_target,
            'com_actual' => $request->com_actual,
            'note' => $request->note,
        ]);

        return redirect()->route('kpi.index', $kpi->id_bpd)->with('success', 'KPI updated successfully.');
    }

    public function destroy($id_kpi)
    {
        $kpi = Kpi::findOrFail($id_kpi);

        // Verify ownership
        $bpd = Bpd::where('id_bpd', $kpi->id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        $id_bpd = $kpi->id_bpd;
        $kpi->delete();

        return redirect()->route('kpi.index', $id_bpd)->with('success', 'KPI deleted successfully.');
    }

    public function importView($id_bpd)
    {
        $bpd = Bpd::where('id_bpd', $id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        return view('kpi.import', compact('bpd'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'id_bpd' => 'required|exists:tbl_bpds,id_bpd',
            'file' => 'required|file|mimes:csv,xlsx,txt|max:10240',
        ]);

        $bpd = Bpd::where('id_bpd', $request->id_bpd)
            ->where('id_department', Session::get('department_id'))
            ->firstOrFail();

        $file = $request->file('file');

        try {
            Excel::import(new KpiImport($bpd->id_bpd), $file);

            return redirect()
                ->route('kpi.index', $bpd->id_bpd)
                ->with('success', 'KPIs imported successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Error importing file: ' . $e->getMessage()]);
        }
    }


    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="kpi_template.csv"',
        ];

        $columns = [
            'definition',
            'periode',
            'target',
            'actual',
            'com_target',
            'com_actual',
            'note'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');

            // delimiter ; untuk 
            fputcsv($file, $columns, ';');

            fclose($file);
        };


        return response()->stream($callback, 200, $headers);
    }
}