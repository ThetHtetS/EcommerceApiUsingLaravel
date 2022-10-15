<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Image;
use Image;
//use Intervention\Image\Facades\Image;
//use Intervention\Image\Exception\NotReadableException;
use File;
//use App\Fileupload;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* $data= $request->all();
       return response()-> json(
         [  
        'mess'=>'success',
        'data'=> $data,
         ]);
         */
    
    
         $course = new Course();

        
          /*  if($request->get('file'))
            {
               $image = $request->get('file');
               $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
               \Image::make($request->get('file'))->save(public_path('images/').$name);
             }
             
           */
           $file = $request->file;
            $name = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
            $location = public_path('images/'.$name);
            Image::make($file)->save($location);
            $course->thumbnail = $name;
           // $file = $request->file('photo');
           // $extension = $file->getClientOriginalExtention();
            //$filename = time().'.'.$extention;

         //  $name->move();
       //  $course->thumbnail = 'uploads/product/'.$name;
        

       $course->title = $request->title;
        $course->save();
        return response()->json('Successfully added');
      //  return $name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
