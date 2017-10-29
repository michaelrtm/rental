<?php

namespace App\Http\Controllers;

use App\Pump;
use Illuminate\Http\Request;

class PumpsController extends Controller
{
    public function show($id)
    {
        $pump = Pump::find($id)->firstOrFail();
        return view('pumps.show', compact('pump'));
    }
}
