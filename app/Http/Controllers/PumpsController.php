<?php

namespace App\Http\Controllers;

use App\Pump;
use Illuminate\Http\Request;

class PumpsController extends Controller
{
    public function show($id)
    {
        $pump = Pump::findOrFail($id);
        return view('pumps.show', compact('pump'));
    }
}
