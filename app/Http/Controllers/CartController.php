<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
class CartController extends Controller
{
    function index(){
        $data = Cart::all(); 
        return response()-> json([
            'cartitem'=> $data
        ]);
    }
    
    function create (Request $request)
    {
        $cart = new Cart;
        $user_id= auth('sanctum')->user()->id;
        $cartitem =Cart::create([
            'user_id' => $user_id ,
            'product_id' => $request->product_id ,
            'product_qty' => $request->qty 

        ]);
        return response()-> json([
            'status' => 200,
            'message' => 'add successfully'
        ]);
    
    }
   
    function update($id, $scope){
        $user_id= auth('sanctum')->user()->id;
        $cartitem = Cart::where('id', $id)->where('user_id', $user_id)->first();
        
        if($scope == 'inc'){
            $cartitem->product_qty += 1;
        }
        else if($scope == 'dec'){
            $cartitem->product_qty -= 1;
        }
        $cartitem->update();
        return response()-> json([
            'status' => 200,
            'message' => 'update successfully'
        ]);

    }

  

    function delete($id){
        $cartitem = Cart::find($id);
        $cartitem->delete();
     
       return response()-> json([
           'status' => 200,
           'message'=> 'Deleted'
       ]);
    }
}
