<?php

namespace App\Http\Controllers\CabinetAssurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DureeController extends Controller
{
    public function index()
    {
        return view('cabinet_assurance.duree.index');
    }
}
