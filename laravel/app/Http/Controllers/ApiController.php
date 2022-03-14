<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ApiController extends Controller
{
    /**
     * CREATE THE METHOD getItem RETURNING THE REQUESTED ITEM
     */
        public function getItems(){
            $data = Item::all();
            // return response()->json($data);
            return $data;
        }
        
        public function getItemById($id){
            $data = Item::find($id);
            return $data;
        }
    /**
     * CREATE THE METHOD calculatePrices RETURNING AN ARRAY WITH THE FINAL PRICE AND THE COSTS OF THE TAXES (21%)
     */
        public function calculatePrices(){

        }
}
