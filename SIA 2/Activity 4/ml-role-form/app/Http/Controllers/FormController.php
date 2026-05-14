<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create()
    {
        return view('ml_form');
    }

    public function store(Request $request)
{
    $request->validate([
        'player_name' => 'required|min:3',
        'email' => 'required|email',
        'age' => 'required|numeric|min:13',
        'roles' => 'required|array|min:1',
        'roles.*' => 'string',
        'favorite_hero' => 'required|min:3',
        'rank' => 'required',
        'play_style' => 'required|min:10'
    ]);

    return redirect('/ml-form')->with('success', 'Form submitted successfully!');
}
}