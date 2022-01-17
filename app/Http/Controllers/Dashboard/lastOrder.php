<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\items ;
use App\User ;
use App\settings ;
use DB ;
use App\Client ;
use App\orderhistory ;
class lastOrder extends Controller
{
    public function sale(Request $q){

       if(auth()->user()->isAbleTo('item_c')){
    	

    	$data = $this->validate($q , [

    		'client_id' => 'required',
    		'id' => 'required',
    		'price' => 'required',
    		'order_number' => 'required',
    		'itemCount' => 'required',
    	]);



    	$user_id = auth()->user()->id ;

    	foreach($data['id'] as $index => $row){

    			$count = $data['itemCount'][$index] ;
    			$price = $data['price'][$index] ;
    			$lastPrice = $count * $price  ;

    		  orderhistory::create([
    		  	'user_id' => $user_id ,
    		  	'client_id' => $data['client_id'] ,
    		  	'item_id' => $data['id'][$index] ,
    		  	'order_id' => $data['order_number'] ,
    		  	'price' => $lastPrice ,
    		  	'active' => '0' ,
    		  	'item_count' => $data['itemCount'][$index] ,
    		  ]);

    	}



    	
		 notify()->success('the order at wating to Active');

        return redirect()->route('order.index');

      }else{
        return redirect()->back();
      }

    }

   public function history(){

    if(auth()->user()->isAbleTo('item_c')){
   		$data = orderhistory::select([
   			'users.first_name' ,
   			'clients.username' ,
   			'items.name_ar',
   			'orderhistories.*',
   			
   		])
   		->join('users' , 'users.id' , '=' , 'orderhistories.user_id')
   		->join('clients' , 'clients.id' , '=' , 'orderhistories.client_id')
   		->join('items' , 'items.id' , '=' , 'orderhistories.item_id')
   		->groupBy('order_id')
   		->get();

   		



   		return view('order.history' , compact('data'));
   }else{
    return redirect()->back();
   }

 }



   public function detales(Request $id){

    if(auth()->user()->isAbleTo('item_c')){

    $orderId = $id->id ;


   	$order = orderhistory::where('order_id' , $id->id)->get()->first();



   	$settings = settings::all();

   		
   	$client = Client::where('id' , $order->client_id)->get()->first();

    $sumitem =  orderhistory::where('order_id' , $id->id)->get()->count();
    $somorderOk =  orderhistory::where('order_id' , $id->id)
    ->where('active' , 1)
    ->get()->count();
    $somorderBack =  orderhistory::where('order_id' , $id->id)
    ->where('active' , 2)
    ->get()->count();

    $sumTotal =  orderhistory::where('order_id' , $id->id)
    ->where('active' , '!=' ,2)->sum('price');

    

    

    

	
   	

   	return view('order.detales' , compact('settings' , 'client' , 'order' , 'sumitem' , 'somorderOk' , 'somorderBack' ,'sumTotal' , 'orderId') );
   }else{
   return redirect()->back();
   }

 }

   public function singelback(request $q){
    $id = $q->id ;

    $order = orderhistory::find($id);
    $order->active = 2 ;

    $order->save();

      notify()->success('Sccess To  update Order');

        return redirect()->back();
    

   
   }

   public function backAll(request $q){
    

      $order = DB::table('orderhistories')->where('order_id' , $q->id)->update(['active' => '2']);
    

       notify()->success('Sccess To  Back Order');

        return redirect()->back();
   }


 public function checkAll(request $q){

  if(auth()->user()->isAbleTo('item_c')){
    
    

    $id = $q->id ;

 

   $itemcount =  DB::table('orderhistories')
   ->where('order_id' , $id)
   ->where('active' , 0)
   ->get();

    

    foreach($itemcount as $index => $row){

     
      $item = items::find($itemcount[$index]->item_id);



      //item_count
      $minus = $item->store - $itemcount[$index]->item_count ;


      $item->store =  $minus;
      $item->save() ;
    }


    DB::table('orderhistories')->where('order_id' , $id) ->where('active' , 0)->update(['active' => '1']);

       notify()->success('Sccess To  check Orders');

        return redirect()->back();
   }else{
    
        return redirect()->back();
   }

 }

 public function print(request $q , $id){

    $order = orderhistory::where('order_id' , $id)->get();


      $item =DB::table('orderhistories')->select([
        'items.name_ar',
        'items.price as item_price',
        'orderhistories.*',
        
      ])

      ->join('items' , 'items.id' , '=' , 'orderhistories.item_id')
      ->where('order_id' , $order[0]->order_id)
      ->get();

    

    $totalAll = orderhistory::where('order_id' , $id)->sum('price');
 $clien_id = $order[0]->client_id  ;
   
    $settings = settings::get()->first();
    $client = Client::find($clien_id);


    

 $sumitem =  orderhistory::where('order_id' , $id)->get()->count();
    $somorderOk =  orderhistory::where('order_id' , $id)
    ->where('active' , 1)
    ->get()->count();
    $somorderBack =  orderhistory::where('order_id' , $id)
    ->where('active' , 2)
    ->get()->count();

    $sumTotal =  orderhistory::where('order_id' , $id)
    ->where('active' , '!=' ,2)->sum('price');


    


    return view('order.print' ,compact('order' , 'settings' , 'client' , 'totalAll' , 'item' , 'sumitem' , 'somorderOk' , 'somorderBack' , 'sumTotal'));

   }


}
