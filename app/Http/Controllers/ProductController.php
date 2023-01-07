<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;
use File;
class ProductController extends Controller
{  
       function slug($slug)
    {
        $product= Product::where('slug', $slug )->get();
       if($product){
        return response()->json([
            'status' => 200,
            'product' => $product
        ]);
    }
    else{
        return response()->json([
            "message" => 'No product available'
        ]);
    }
}


    public function index()
    {
            $data = Product::all(); 
            return response()-> json([
                'status'=> 200,
                'product'=> $data
            ]);
    }

    
   public function store(Request $request)
   {
      $validator = validator($request->all(), [   
            'name' => 'required',
            'slug' => 'required',
            //'image'=> 'required',
            'seeling_price'=>'required',
            'original_price' => 'required',
            'brand'=> 'required',
            'qty'=>'required',
            'category_id' => 'required'
        ]);
              
            if($validator -> fails()){
                    return response()-> json([
                        "message" => $validator->messages()
                    ]);
                    }
                    else{
                             $product = new Product;
                             $product-> category_id= $request->category_id;
                             $product-> meta_title = $request->meta_title;
                             $product->  meta_keyword = $request->meta_keyword;
                             $product->  meta_descrip = $request->meta_description ;
                             $product-> slug = $request->slug ;
                             $product-> name = $request->name;
                             $product->description = $request->description;
                             $product->seeling_price = $request->seeling_price;
                             $product->original_price=$request->original_price;
                             $product->brand=$request-> brand;
                             $product->qty= $request->qty;
            
                            /* if ($request->hasFile('image')) {
                                $file = $request->file('photo');
                                $extension = $file->getClientOriginalExtention();
                                $filename = time().'.'.$extention;
                                $file->move('uploads/product', $filename);
                                $product->image = 'uploads/product/'.$filename;
                                }
                                */
                            $file = $request->image;
                                $name = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
                                $location = public_path('uploads/product/'.$name);
                                Image::make($file)->save($location);
                                $product->image = 'uploads/product/'.$name;

                              $product->  featured = $request->featured == true ? '1' :'0';
                              $product->   popular= $request->popular == true ? '1' :'0';
                              $product->  status = $request->status == true ? '1' :'0';
                              $product->save();

      
                             return response()-> json([
                              'status' => 200,
                              'message' => 'add successfully'
                                     ]);
            }
    }

    public function edit($id)
    {   
        $product = Product::find($id);
        return response()-> json([
            'status' => 200,
            'product' => $product
        ]);
    }

    public function update($id, Request $request)
    {
        $validator = validator($request->all(), [   
            'name' => 'required',
            'slug' => 'required',
            'image'=> 'required',
            'seeling_price'=>'required',
            'original_price' => 'required',
            'brand'=> 'required',
            'qty'=>'required',
            'category_id' => 'required'
        ]);
              
            if($validator -> fails()){
                    return response()-> json([
                        "message" => $validator->messages()
                    ]);
                    }
             else{
                     $product = Product::find($id);
                     $product-> category_id= $request->category_id;
                     $product-> meta_title = $request->meta_title;
                     $product->  meta_keyword = $request->meta_keyword;
                     $product->  meta_descrip = $request->meta_description ;
                     $product-> slug = $request->slug ;
                     $product-> name = $request->name;
                     $product->description = $request->description;
                     $product->seeling_price = $request->seeling_price;
                     $product->original_price=$request->original_price;
                     $product->brand=$request-> brand;
                     $product->qty= $request->qty;
                  
                    $file = $request->image;
                    $name = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
                    $location = public_path('uploads/product/'.$name);
                    Image::make($file)->save($location);
                    $product->image = 'uploads/product/'.$name;

                     $product->  featured = $request->featured == true ? '1' :'0';
                     $product->   popular= $request->popular == true ? '1' :'0';
                     $product->  status = $request->status == true ? '1' :'0';
                     $product->save();

                     return response()-> json([
                    'status' => 200,
                    'message' => 'update successfully'          
                  ]);

                       /* if ($request->hasFile('image')) {
                                $file = $request->file('photo');
                                $extension = $file->getClientOriginalExtention();
                                $filename = time().'.'.$extention;
                                $file->move('uploads/product', $filename);
                                $product->image = 'uploads/product/'.$filename;
                                }
                                */
              }

    }

    
    function Delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        if(File::exists(public_path($product->image))){
        File::delete(public_path($product->image));
        }
       return response()-> json([
           'status' => 200,
           'message'=> 'Deleted'
       ]);
    }

    
    function productQty()
    {
        $result = new Product;
        
       
            $result= Product::where('qty',  '<', 5 )->get();

  
        return response()-> json([
            'status' => 200,
            'result'=> $result,
       
        ]);
    }

    
}
