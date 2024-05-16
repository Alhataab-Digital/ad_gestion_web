<?php

namespace App\Http\Controllers\CabinetAssurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrimeNetController extends Controller
{
    public function index()
    {
        return view('cabinet_assurance.prime_net.index');
    }
}
