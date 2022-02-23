<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
       if (url()->previous() == url("/client/login")) {
        
        $request->authenticate("web");

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);

    } else if (url()->previous() == url("/admin/login")){
       
        $request->authenticate("admin");

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN);
    }
   

}

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect()->route('index');
    }
}
