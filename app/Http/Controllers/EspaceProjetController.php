<?php

namespace App\Http\Controllers;

use App\Models\TypeGestion;
use Illuminate\Http\Request;

class EspaceProjetController extends Controller
{
    public function index()
    {
        $gestions = TypeGestion::orderBy('gestion')->get();
        return view('espace_projet', compact('gestions'));
    }

}
