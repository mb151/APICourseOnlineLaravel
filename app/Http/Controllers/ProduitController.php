<?php

namespace App\Http\Controllers;

use App\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(){
        $produits = Produit::all();
        return response()->json(
            [
               'produit' => $produits 
            ]);
    }
}
