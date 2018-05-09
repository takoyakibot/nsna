<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;

class CharacterController extends Controller
{
    protected function index()
    {
        $characters = Character::orderBy('id', 'desc')->paginate(10);
        return view('characters', compact('characters'));
    }
}
