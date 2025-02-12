<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class RegisterController extends Controller
{
    //
    public function show () {
        return view('register');
    }

    public function submit(RegisterRequest $request) {
        // $request->input('phone_number') = '+62'.$request->input('phone_number');
        // return $request;

        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']);
        $validated['photo'] = "template.svg";
        $validated['is_active'] = 1;
        $validated['role_id'] = $request->role;

        $create = User::create($validated);
        if($create) {
            // harus ada ini supaya bisa nyimpen data user, dan web jadi tau user ini yg punya kendaraan ini
            Auth::login($create);
            if($request->role == 2) return redirect()->route('vehicle.show');
            else return redirect()->route('home');
        }

        return abort(500);
    }
}
