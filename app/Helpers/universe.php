<?php


use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Support\Facades\Route;
if (!function_exists('getLoggedType')) {
    function getLoggedType()
    {
        return session('user')->type;
    }
}

if (!function_exists('set_active')) {
    function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else if (Route::is($uri)) {
            return $output;
        }

        return '';
    }
}
if (!function_exists('getLoggedId')) {
    function getLoggedInstance()
    {
        $user = session('user');
        $id = $user->identifierID;
        $type = $user->type;

        if ($type === "pasien") {
            return Pasien::find($id);
        }

        if ($type === "dokter") {
            return Dokter::find($id);
        }

        if ($type === "admin") {
            return $user;
        }

        return null;
    }
}


if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return session('user')->type === "admin";
    }
}

if (!function_exists('isDokter')) {
    function isDokter()
    {
        return session('user')->type === "dokter";
    }
}

if (!function_exists('isPasien')) {
    function isPasien()
    {
        return session('user')->type === "pasien";
    }
}
