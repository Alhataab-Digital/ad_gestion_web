<?php

namespace App\Http\Controllers\CabinetAssurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index()
    {
        return view('cabinet_assurance.marque.index');
    }
}
