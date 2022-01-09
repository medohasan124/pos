<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User ;
use App\DataTables\UsersDataTable;
use Image ;
use File;
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
        'image' => 'image|max:500|min:5|nullable',
       ]);

       $password =  bcrypt($q->password); 
        
    

    if($q->image){
        // open and resize an image file
        $img = Image::make($q->image->getRealPath());
        $img->insert($q->image->getRealPath())->resize(300, null, function ($constraint) {
    $constraint->aspectRatio();
});
        $img->save(public_path('upload/users/'.$q->image->hashName()) );

        $image = $q->image->hashName() ;
    }else{
        $image = 'default.png' ;
    }


        $user =  User::create([
             'first_name' => $q->f_name ,
             'last_name' => $q->l_name ,
             'email' => $q->email ,
             'password' => $password ,
             'image' => $image ,

         ]);

        if($q->permission){
            $user->syncPermissions($q->permission);
        }
        

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
            
          

        if($q->image){

            if($user->image !='default.png'){
             $image =  File::delete('upload/users/'.$user->image);
            }

            $img = Image::make($q->image->getRealPath());
            $img->insert($q->image->getRealPath())->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            });
        $img->save(public_path('upload/users/'.$q->image->hashName()) );

         $user->image = $q->image->hashName() ;

        }

          $user->save();

            if($q->permission_Users){
                 $user->syncPermissions($q->permission_Users);
            }
           



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

     

        if($user->image !='default.png'){
             $image =  File::delete('upload/users/'.$user->image);
        }

        $user->delete() ;

        notify()->success('Sccess To Delete User');

        return redirect()->route('users.index');
    }
}
