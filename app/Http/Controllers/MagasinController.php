<?php

namespace App\Http\Controllers;

use App\Magasin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MagasinController extends Controller
{
    public function index(){
        // $magsin = Magasin::all();

        $magsin = DB::table('categories')
                    ->join('magasins','magasins.idCateg','=','categories.idCateg')
                    ->select('magasins.nom','magasins.image','categories.nomCateg')
                    ->get();
        return response()->json(
            [
               'magasin' => $magsin 
            ]);
    }
}
