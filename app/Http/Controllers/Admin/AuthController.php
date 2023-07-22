<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        if ($this->request->method() === 'POST') {
            $credentials = [
                'username' => $this->postField('username'),
                'password' => $this->postField('password')
            ];
            if ($this->isAuth($credentials)) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->back()->with('failed', 'Periksa Kembali Username dan Password Anda');
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
