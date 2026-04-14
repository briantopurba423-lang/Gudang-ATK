<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = DB::table('user')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->where('role', $request->role)
            ->first();

        if ($user) {
            Session::put('username', $user->username);
            Session::put('role', $user->role);
            Session::put('status', 'login');

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username, password, atau role salah!');
    }

    public function dashboard()
    {
        if (!Session::get('status')) {
            return redirect()->route('login.form');
        }

        return view('dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login.form');
    }
}