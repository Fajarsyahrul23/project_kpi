<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        if (Session::has('department_id')) {
            return redirect()->route('bpd.index');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'pin' => 'required|numeric',
        ]);

        $department = Department::where('pin', $request->pin)->first();

        if ($department) {
            Session::put('department_id', $department->id_department);
            Session::put('department_name', $department->dept_name);
            return redirect()->route('bpd.index');
        }

        return back()->withErrors([
            'pin' => 'The provided PIN is incorrect.',
        ]);
    }

    public function logout()
    {
        Session::forget(['department_id', 'department_name']);
        return redirect()->route('login');
    }
}
