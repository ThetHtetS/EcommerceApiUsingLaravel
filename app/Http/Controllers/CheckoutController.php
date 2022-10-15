<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
class CheckoutController extends Controller
{
    function placeorder(Request $request)
   {
    $validator = validator(request()->all(), [   
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'email' => 'required',
        'state' => 'required',
        'city'=> 'required'        
    ]);
          
        if($validator -> fails()){
                return response()-> json([
                    "message" => $validator->messages()
                ]);
                }
                else{
    $order = new Order;
    $user_id= auth('sanctum')->user()->id;
    $order =Order::create([
        'user_id'=>$user_id,
        'name' => $request->name ,
        'phone' => $request->phone,
        'email' => $request->email ,
        'address' => $request->address ,
        'town' => $request->city,
        'state' => $request->state,
        'remark' => '',
    ]);
    
    $cart = Cart::where('user_id', $user_id)->get();
     $orderitem=[];
    foreach($cart as $item){
        $orderitem[]= [
            
            'product_id'=>$item->product_id,
            'qty'=> $item->product_qty,
            'price'=> $item->product->seeling_price
        ];
       $item->product->update([
           'qty'=> $item->product->qty - $item->product_qty
       ]);

    }
   $order->orderitems()->createMany($orderitem);
Cart::destroy($cart);
    return response()-> json([
        'status' => 200,
        'message' => 'add successfully'
    ]);
}
   }
}
