<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        if (session()->has('user')) {
            return redirect()->route('dashboard');
        }

        return view('pages.login');
    }

    public function attemptLogin(Request $request): RedirectResponse
    {
        if (session()->has('user')) {
            return redirect()->route('dashboard');
        }
        $type = $request->input('type');
        if ($type === 'admin') {
            if ($this->attemptLoginAdmin($request)) {
                $user = new UserDTO('admin', 'admin');
                session(['user' => $user]);
                return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang, Admin!');
            }
            return redirect()->back()->withInput()->withErrors([
                'email' => 'Kredensial yang Anda masukkan salah.',
            ]);
        }

        if ($type === 'dokter') {
            if ($dokter = $this->attemptLoginDokter($request)) {
                $user = new UserDTO('dokter', $dokter->id);
                session(['user' => $user]);
                return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang, Dokter ' . $dokter->nama . '!');
            }

            return redirect()->back()->withInput()->withErrors([
                'email' => 'Kredensial yang Anda masukkan salah.',
            ]);
        }

        if ($pasien = $this->attemptLoginPasien($request)) {
            $user = new UserDTO('pasien', $pasien->id);
            session(['user' => $user]);
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang, Pasien ' . $pasien->nama . '!');
        }

        return redirect()->back()->withInput()->withErrors([
            'email' => 'Kredensial yang Anda masukkan salah.',
        ]);
    }

    private function attemptLoginAdmin(Request $request): bool
    {
        return $request->input('username') === 'admin' && $request->input('password') === 'admin';
    }

    private function attemptLoginDokter(Request $request): ?Dokter
    {
        return Dokter::where('nama', $request->input('nama'))
            ->where('no_hp', $request->input('no_hp'))
            ->first();
    }

    private function attemptLoginPasien(Request $request): ?Pasien
    {
        return Pasien::where('nama', $request->input('nama'))
            ->where('no_ktp', $request->input('no_ktp'))
            ->first();
    }

    public function logout(): RedirectResponse
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }
        session()->flush();
        return redirect()->route('login');
    }
}
