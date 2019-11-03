<?php

namespace App\Http\Controllers;

use App\Produit;
use App\Panier;
use App\Commande;
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

    public function getAllProduct(){
        $produits = DB::table('produits')
                    ->join('types', 'produits.idType', '=', 'types.idType')
                    ->select('produits.*','types.*')->get();
        return response()->json([
            'allproduit' => $produits
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
                        ->select('produits.reference','produits.image','produits.idProd','magasins.nom','prodmag.*', 'types.*')
                        ->where('types.idType', $id)->get();
                        //->where('magasins.idMag', $idmag)->get();
        return response()->json(
            [
               'produits' => $produits 
            ]);
    }

    public function getProductDetail($id){
        $prod = DB::table('produits')
                ->join('prodmag', function($join){
                    $join->on('produits.idProd','=','prodmag.idProd');
                })
                ->select('produits.*','prodmag.*')
                ->where('produits.idProd', $id)
                ->get();
            return response()->json([
                'prod' => $prod
            ]);
    }


    public function saveToFavorite(Request $request)
    {
        $request->validate([
            'totale'=>'required',
            'idProd'=>'required'
        ]);
        $panier= new Panier([
            'totale' => $request->get('totale'),
            'idProd' => $request->get('idProd'),
        ]);

        $panier->save();
        return response()->json([
            'panier' => $panier
        ]);
    }

    public function getAllPanier(){
        $panier = Panier::all();
        return response()->json([
            'panier' => $panier
        ]);
    }

    public function getAllCommande(){
        $commande = Commande::all();
        return response()->json([
            'commande' => $commande
        ]);
    }
}
