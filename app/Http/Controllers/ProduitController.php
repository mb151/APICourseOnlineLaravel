<?php

namespace App\Http\Controllers;

use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    public function index(){
        $produits = Produit::get()->take(6);
        return response()->json(
            [
               'produit' => $produits 
            ]);
    }

    public function getProductOfAppropriateMagasin($id){
        $produits = DB::table('types')
                     ->join('produits', function($join){
                        $join->on('types.idType', '=', 'produits.idType');
                     })
                     ->join('prodmag', function($join){
                         $join->on('types.idType','=','prodmag.idType');
                     })
                     ->join('magasins', function($join){
                        $join->on('prodmag.idMag','=','magasins.idMag');
                    })
                        ->select('produits.reference','produits.image','magasins.nom','prodmag.*', 'types.*')
                        ->where('types.idType', $id)->get();
                        //->where('magasins.idMag', $idmag)->get();
        return response()->json(
            [
               'produits' => $produits 
            ]);
    }
}
