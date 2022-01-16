<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\items ;
use App\User ;
use DB ;
use App\Client ;
use App\orderhistory ;
class lastOrder extends Controller
{
    public function sale(Request $q){
    	

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

    }

   public function history(){
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
   }



   public function detales(Request $id){

    $orderId = $id->id ;


   	$order = orderhistory::where('order_id' , $id->id)->get()->first();



   	$user = User::where('id' , $order->user_id)->get()->first();

   		
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

    

    

    

	
   	

   	return view('order.detales' , compact('user' , 'client' , 'order' , 'sumitem' , 'somorderOk' , 'somorderBack' ,'sumTotal' , 'orderId') );
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
   }


}
