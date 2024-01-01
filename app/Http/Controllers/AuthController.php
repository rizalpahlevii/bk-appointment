<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Traits\AppConfig;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AppConfig;

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
                $user = new UserDTO('admin', (object)[
                    'nama' => 'Admin',
                    'username' => 'admin',
                    'password' => 'admin',
                ]);
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
                $user = new UserDTO('dokter', $dokter);
                session(['user' => $user]);
                return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang, Dokter ' . $dokter->nama . '!');
            }

            return redirect()->back()->withInput()->withErrors([
                'email' => 'Kredensial yang Anda masukkan salah.',
            ]);
        }

        if ($pasien = $this->attemptLoginPasien($request)) {
            $user = new UserDTO('pasien', $pasien);
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
        return $request->input('username') === $this->getDefaultAdminUsername() &&
            $request->input('password') === $this->getDefaultAdminPassword();
    }

    private function attemptLoginDokter(Request $request): ?Dokter
    {
        $dokter = Dokter::where('no_hp', $request->input('no_hp'))
            ->first();

        return Hash::check($request->input('password'), $dokter?->password) ? $dokter : null;
    }

    private function attemptLoginPasien(Request $request): ?Pasien
    {
        $pasien = Pasien::where('no_rm', $request->input('no_rm'))
            ->first();

        return Hash::check($request->input('password'), $pasien?->password) ? $pasien : null;
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
