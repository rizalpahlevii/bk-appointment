<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function attemptLogin(Request $request)
    {
        $type = $request->input('type');

        if ($type === 'admin') {
            if ($this->attemptLoginAdmin($request)) {
                return redirect()->route('dashboard');
            }
            return redirect()->back()->withInput()->withErrors([
                'email' => 'Kredensial yang Anda masukkan salah.',
            ]);
        }

        if ($type === 'dokter') {
            if ($this->attemptLoginDokter($request)) {
                return redirect()->route('dashboard');
            }

            return redirect()->back()->withInput()->withErrors([
                'email' => 'Kredensial yang Anda masukkan salah.',
            ]);
        }

        if ($this->attemptLoginPasien($request)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withInput()->withErrors([
            'email' => 'Kredensial yang Anda masukkan salah.',
        ]);
    }

    private function attemptLoginAdmin(Request $request): bool
    {
        return \Auth::guard('admin')->attempt(
            $request->only('username', 'password')
        );
    }

    private function attemptLoginDokter(Request $request): bool
    {
        return \Auth::guard('dokter')->attempt(
            $request->only('nama', 'no_hp')
        );
    }

    private function attemptLoginPasien(Request $request): bool
    {
        return \Auth::guard('pasien')->attempt(
            $request->only('nama', 'no_ktp')
        );
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('login');
    }
}
