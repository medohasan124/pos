<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\settings;
use Image;
use File;
class settingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $data = settings::where('id' , 1)->get()->first();

        return view('dashboard.settings' , compact('data'));
        
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
        //
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
    public function update(Request $q, $id)
    {
     



            $this->validate($q, [
                'sitename_en' => 'required',
                'sitename_ar' => 'required',
                'email' => 'required',
                'description' => 'required',
                'phone1' => 'required',
                'phone2' => 'required',
           ]);

        


            $settings = settings::where('id' , $id)->get()->first();
            $settings->sitename_en = $q->sitename_en ;
            $settings->sitename_ar = $q->sitename_ar ;
            $settings->email = $q->email ;
            $settings->description = $q->description ;
            $settings->phone1 = $q->phone1 ;
            $settings->phone2 = $q->phone2 ;
            
          

        if($q->logo){

            if($settings->logo !='default.png'){
             $image =  File::delete('upload/settings/'.$settings->logo);
            }

            $img = Image::make($q->logo->getRealPath());
            $img->insert($q->logo->getRealPath())->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
        $img->save(public_path('upload/settings/'.$q->logo->hashName()) );

         $settings->logo = $q->logo->hashName() ;

        }


       

          $settings->save();
           

              notify()->success('Sccess To Update settings');

        return redirect()->back();
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
