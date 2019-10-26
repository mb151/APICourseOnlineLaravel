<?php

namespace App\Http\Controllers;

use App\Magasin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MagasinController extends Controller
{
    public function index(){
        $magasin = Magasin::all();
        return response()->json([
            'magasin' => $magasin,
        ]);
    }

    public function getMagasinFromAppropriateCategorie($id){
        $magsin = DB::table('magasins')
                    ->join('categories', function($join){
                        $join->on('magasins.idCateg', '=', 'categories.idCateg');
                    })
                    ->select('categories.nomCateg', 'magasins.*')
                    ->where('categories.idCateg', $id)
                    ->get();
        return response()->json(
            [
               'magasin' => $magsin 
            ]);
    }

    public function geTypeFromAppropriateCategorieOfMagasin($id){
        $types = DB::table('types')
                    ->join('categories', function($join){
                        $join->on('types.idCategorie', '=', 'categories.idCateg');
                    })
                    ->select('categories.nomCateg', 'types.*')
                    ->where('categories.idCateg', $id)
                    ->get();
        return response()->json(
            [
               'types' => $types 
            ]);
    }
    
}
