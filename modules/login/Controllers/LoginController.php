<?php

namespace Modules\Login\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Modules\Login\Services\LoginService;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function create()
    {
        return view('login::login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $result = $this->loginService->loginAndGetMenu($attributes);
        if ($result['status'] == 'success') {
            return redirect('dashboard')->with(['success' => $result['message']]);
        } else {
            return back()->withErrors(['email' => $result['message']]);
        }
    }

    public function destroy()
    {
        session()->forget('menuRoles');
        Auth::logout();
        session()->flush();
        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}