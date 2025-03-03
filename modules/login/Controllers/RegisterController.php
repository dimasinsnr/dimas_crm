<?php

namespace modules\Login\Controllers;

use App\Models\User;
use Modules\Login\Models\UserModel;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function create()
    {
        return view('login::register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );

        

        session()->flash('success', 'Your account has been created.');
        $user = UserModel::create($attributes);
        Auth::login($user); 
        return redirect('/dashboard');
    }
}
