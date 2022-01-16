<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client ;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = Client::all();
        return view('client.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->isAbleTo('client_c')){
            return view('client.add');
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
            'username' => 'required' ,
            'number' => 'required' ,
            'location' => 'required',
            'email' => 'email|required',
        ]);

         
         Client::create($data);
         notify()->success('Sccess To Add Client');

        return redirect()->route('client.index');
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
         if(auth()->user()->isAbleTo('client_e')){
          $data = Client::find($id);
        return view('client.edit' , compact('data'));
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
             'username' => 'required' ,
            'number' => 'required' ,
            'location' => 'required',
            'email' => 'email|required',
        ]);

        $client =  Client::find($id);
        $client->username = $request->username ;
        $client->number = $request->number ;
        $client->location = $request->location ;
        $client->email = $request->email ;
        $client->save() ;

        notify()->success('Sccess To update Client');

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(auth()->user()->isAbleTo('client_e')){

              Client::find($id)->delete();

              notify()->success('Sccess To Delete Client');

             return redirect()->route('client.index');

       }else{
        return back();
       }
    }
}
