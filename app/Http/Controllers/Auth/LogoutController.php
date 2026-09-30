<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $role = Auth::user()->role ?? 'customer';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (in_array($role, ['admin'])) {
            return redirect()
                ->route('login')
                ->with('success', 'Anda berhasil logout.');
        }

        return redirect()
            ->route('home')
            ->with('success', 'Anda berhasil logout.');
    }
}
