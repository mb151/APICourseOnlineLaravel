<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index(){
        $categorie = Categorie::all();
        return response()->json(
            [
               'categorie' => $categorie 
            ]);
    }
}
