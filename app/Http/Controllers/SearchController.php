<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $request)
    {
        $result = new Product;
        $search = $request->search;
        if($request->category_id == 'All'){
            $result= Product::where('name', 'like' , '%'.$search . '%')->get();

  
        }
        else{
            $result= Product::where('category_id', $request->category_id )->where('name', 'like' , '%'.$search . '%')->get();
        }
        return response()-> json([
            'status' => 200,
            'result'=> $result,
       
        ]);
    }
}
