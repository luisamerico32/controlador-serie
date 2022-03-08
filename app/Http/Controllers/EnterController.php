<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnterController extends Controller
{
    public function index()
    {
        return view('enter.index');
    }

    public function enter(Request $request)
    {
        if (! Auth::attempt($request->only(['email', 'password']))) {
            return redirect()
                ->back()
                ->withErrors('Usúario e/ou senha inválidos');
        }

        return redirect()->route('list_series');
    }
}
