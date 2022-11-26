<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderitems;
use App\Models\Order;
use App\Models\Product;
class OrderController extends Controller
{
    function index()
    {
      $orders = Order::where('status', 0)->get();
      return response()-> json([
          'status' => 200,
          'data' => $orders,
          
      ]);
    }
    function detail($id){
      $order = Order::find($id);
      return response()-> json([
          'status'  => 200,
          'data' => $order
      ]);
    }
  
    function update(Request $request, $id){
     $order= Order::find($id);
     $order->status =  $request->status;
     $order->update();
     
     return response()-> json([
      'status'  => 200,
      'message' => 'succesful'
  ]);
   }
   function history($date){
    
    $orders = Order::where('created_at', 'like' ,  '%'. $date. '%')->get();
    return response()-> json([
        'status' => 200,
        'data' => $orders,
    ]);
   }
}
