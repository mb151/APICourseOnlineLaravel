<?php

namespace App\Http\Controllers;

use App\Magasin;
use Illuminate\Http\Request;

class MagasinController extends Controller
{
    public function index(){
        $magsin = Magasin::all();
        return response()->json(
            [
               'magasin' => $magsin 
            ]);
    }
}
