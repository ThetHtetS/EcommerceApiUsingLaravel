<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
 
    function index(){
        $data = Category::all(); 
        return response()-> json([
            'category'=> $data
        ]);
    }
    
    function create (Request $request){

        $validator = validator(request()->all(), [   
            'name' => 'required',
            'slug' => 'required',
            
        ]);
              
            if($validator -> fails()){
                    return response()-> json([
                        "message" => $validator->messages()
                    ]);
                    }
                    else{
        $category = new Category;

        $category =Category::create([
            'meta_title' => $request->meta_title ,
            'meta_keyword' => $request->meta_keyword,
            'meta_descrip' => $request->meta_description ,
            'slug' => $request->slug ,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ,
            
           
        ]);
        return response()-> json([
            'status' => 200,
            'message' => 'add successfully'
        ]);
    }
    }


    function edit($id){
        $category = Category::find($id);
        return response()-> json([
            'status'  => 200,
            'category' => $category
        ]);
    }

    function update($id, Request $request){
        $cat = Category::find($id);
        if($cat){
        
            $cat->meta_title = $request->meta_title; 
            $cat->meta_keyword =$request->meta_keyword;
            $cat->meta_descrip = $request->meta_description; 
            $cat-> slug = $request->slug; 
            $cat->name = $request->name;
            $cat->description = $request->description;
            $cat-> status = $request->status; 
            $cat->save();
      
    }
        return response()-> json([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    function delete($id){
        $category = Category::find($id);
        $category->delete();
     
       return response()-> json([
           'status' => 200,
           'message'=> 'Deleted'
       ]);
    }
}
