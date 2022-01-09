<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use App\items;

class itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $q) 
    {

         $data = items::select(['items.*' , 'catigories.name_ar as cat_name'])
            ->join('catigories' , 'catigories.id' ,'=' , 'items.cat_id')
            ->where(function($query) use($q){
                if($q['id']){
                    $query->where('cat_id' , $q['id']);
                }
            })->get();

       

        
           return view('items.index' , compact('data'));  
     
       }
       

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       if(auth()->user()->isAbleTo('c')){
            return view('items.add');
        }else{
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $q)
    {
        $data =   $this->validate($q, [
        'name_en' => 'required',
        'name_ar' => 'required',
        'price' => 'required',
        'cat_id' => 'required',
        'image' => 'image|max:500|min:5|nullable',
       ]);

         if($q->image){
        // open and resize an image file
        $img = Image::make($q->image->getRealPath());
        $img->insert($q->image->getRealPath())->resize(300, null, function ($constraint) {
    $constraint->aspectRatio();
});
        $img->save(public_path('upload/items/'.$q->image->hashName()) );

        $image = $q->image->hashName() ;
    }else{
        $image = 'default.png' ;
    }

    $data['image'] = $image ;

    




     $user =  items::create($data);

       
        

         notify()->success('Sccess To Add Item');

        return redirect()->route('items.index');
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
         if(auth()->user()->isAbleTo('item_e')){

            $data = items::where('id' , $id)->get()->first();


            return view('items.edit' , compact('data' , 'id'));

        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $q, $id)
    {
      

            $data =   $this->validate($q, [
        'name_en' => 'required',
        'name_ar' => 'required',
        'price' => 'required',
        'cat_id' => 'required',
        'image' => 'image|max:500|min:5|nullable',
       ]);

        


            $items = items::where('id' , $id)->get()->first();
            $items->name_en = $q->name_en ;
            $items->name_ar = $q->name_ar ;
            $items->price = $q->price ;
            $items->cat_id = $q->cat_id ;


             

        if($q->image){

            if($items->image !='default.png'){
             $image =  File::delete('upload/items/'.$items->image);
            }

            $img = Image::make($q->image->getRealPath());
            $img->insert($q->image->getRealPath())->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
        $img->save(public_path('upload/items/'.$q->image->hashName()) );

         $items->image = $q->image->hashName() ;

        }

          $items->save();



           
        notify()->success('Sccess To Update Item');

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $items = items::find($id);

     

        if($items->image !='default.png'){
             $image =  File::delete('upload/items/'.$items->image);
        }

        $items->delete() ;

        notify()->success('Sccess To Delete items');

        return redirect()->route('items.index');
    }
}
