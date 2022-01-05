<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User ;
use App\DataTables\UsersDataTable;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = User::all();

        return view('dashboard.users' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(auth()->user()->isAbleTo('c')){
            return view('dashboard.add');
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




       $this->validate($q, [

        'username' => 'required',
        'password' => 'required|confirmed',
        'l_name' => 'required',
        'f_name' => 'required',
        'email' => 'required',
       ]);

       $password =  bcrypt($q->password); 
        
    


        $user =  User::create([
             'first_name' => $q->f_name ,
             'last_name' => $q->l_name ,
             'email' => $q->email ,
             'password' => $password ,

         ]);

        $user->syncPermissions($q->permission);

         notify()->success('Sccess To Add User');

        return redirect()->route('users.index');


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
         if(auth()->user()->isAbleTo('e')){

            $data = User::where('id' , $id)->get()->first();




            return view('dashboard.editUser' , compact('data' , 'id'));

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
        if($q->password == null){

            $this->validate($q, [
                'username' => 'required',
                'l_name' => 'required',
                'f_name' => 'required',
                'email' => 'required',
           ]);

        }else{

            $this->validate($q, [
                'username' => 'required',
                'password' => 'required|confirmed',
                'l_name' => 'required',
                'f_name' => 'required',
                'email' => 'required',
           ]);

        }


            $user = User::where('id' , $id)->get()->first();
            $user->first_name = $q->f_name ;
            if($q->password != null){
                $user->password = $q->password ;
            }
            $user->last_name = $q->l_name ;
            $user->email = $q->email ;
            
            $user->save();

            $user->syncPermissions($q->permission_Users);



              notify()->success('Sccess To Update User');

        return redirect()->route('users.index');


         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete() ;

        notify()->success('Sccess To Delete User');

        return redirect()->route('users.index');
    }
}
