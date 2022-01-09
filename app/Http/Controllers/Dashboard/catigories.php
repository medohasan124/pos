<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Catigory ;
class catigories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = Catigory::all();

        return view('catigory.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->isAbleTo('cat_c')){
            return view('Catigory.add');
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
    public function store(Request $request)
    {
      $data =   $this->validate($request , [
            'name_en' => 'required' ,
            'name_ar' => 'required' ,
        ]);
         Catigory::create($data);
         notify()->success('Sccess To Add catigory');

        return redirect()->route('catigory.index');
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
         if(auth()->user()->isAbleTo('cat_e')){
          $data = Catigory::find($id);
        return view('catigory.edit' , compact('data'));
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
    public function update(Request $request, $id)
    {


       $data =   $this->validate($request , [
            'name_en' => 'required|unique:catigories,name_en,'.$id ,
            'name_ar' => 'required|unique:catigories,name_en,'.$id ,
        ]);

      

        $cat =  Catigory::find($id);
        $cat->name_en = $request->name_en ;
        $cat->name_ar = $request->name_ar ;
        $cat->save() ;




         notify()->success('Sccess To update catigory');

        return redirect()->route('catigory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(auth()->user()->isAbleTo('cat_e')){

              Catigory::find($id)->delete();

             return redirect()->route('catigory.index');

       }else{
        return back();
       }
    }
}
