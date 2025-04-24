<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confeitaria;
use Inertia\Inertia;

class MapaController extends Controller
{

public function index()
{
    return Inertia::render('Mapa/Index', [
        'confeitarias' => Confeitaria::all()
    ]);
}

}
