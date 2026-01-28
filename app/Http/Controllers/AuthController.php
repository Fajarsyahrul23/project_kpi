<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'pin' => 'required|numeric|min_digits:6',
        ]);

        // Optimization: Use cursor() to iterate through departments with low memory usage.
        // Since we only have the PIN, we must verify each hash using Hash::check().
        // For production: Ensure the number of departments is relatively small,
        // as BCrypt checks are computationally expensive.
        foreach (Department::cursor() as $department) {
            if (Hash::check($request->pin, $department->pin)) {
                Session::put('department_id', $department->id_department);
                Session::put('department_code', $department->dept_code);

                return redirect()->route('bpd.index');
            }
        }

        return back()->withErrors([
            'pin' => 'The provided PIN is incorrect.',
        ])->withInput();
    }

    public function logout()
    {
        Session::forget(['department_id', 'department_code']);
        return redirect()->route('login');
    }
}