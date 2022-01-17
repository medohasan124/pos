 @extends('layouts.home')
@section('content')


<div id='app'>
		   <x:notify-messages />
	@include('order.modal')
<div class='tables'>

	<h1>@lang('user.detalse')</h1>
	<br>
	<hr>
	  
	  <div class='row'>

	  	<div class='col-6'>
	  		<h1>@lang('user.invoice') #:{{$order->order_id}}  </h1>
	  	</div>

	  	<div class='col-6 '>
	  		<ul>
	  			<li><strong>@lang('user.date')</strong> : {{$order->created_at}}</li>
	  			<li><strong>@lang('user.invoice')</strong> : {{$order->order_id}}</li>
	  		</ul>
	  	</div>


	  	
	  </div>

	  <hr>

	  <div class='row'>
	  	
	  	
	  	<div class='col'>
	  		
	  		<div class="card" style="width: 18rem;">
			  <div class="card-header">
			   <h2 class='h4'>@lang('user.client_info')</h2>
			  </div>
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item"><strong>@lang('user.username')</strong> :
			    	{{$client->username}}
			    </li>

			     <li class="list-group-item"><strong>@lang('user.number')</strong> :
			    	{{$client->number}}
			    </li>

			     <li class="list-group-item"><strong>@lang('user.location')</strong> :
			    	{{$client->location}}
			    </li>

			    <li class="list-group-item"><strong>@lang('user.email')</strong> :
			    	{{$client->email}}
			    </li>
			   
			  </ul>
			</div>

	  	</div>
	  </div>

	  <h3 class='h3'>@lang('user.item')</h3>

	  <?php 
	  
	  $data =DB::table('orderhistories')->select([
   			'items.name_ar',
   			'orderhistories.*',
   			
   		])

   		->join('items' , 'items.id' , '=' , 'orderhistories.item_id')
   		->where('order_id' , $order->order_id)
   		->get();

   		
	  ?>

	<table class="table table-striped text-center" id='myTable'>
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">@lang('user.item_name')</th>
	      <th scope="col">@lang('user.price')</th>
	      <th scope="col">@lang('user.item_count')</th>
	      <th scope="col">@lang('user.active')</th>
	      <th scope="col">@lang('user.time')</th>
	      <th scope="col">@lang('user.controle')</th>
	     
	     
	     
	    </tr>
	  </thead>
	  <tbody>

	  	<?php 
	  		$total = 0 ;
	  	?>
	  @foreach($data as $index => $row)
	  	<tr>
	  		<td>{{$index + 1}}</td>
	  		<td>{{$row->name_ar}}</td>
	  		<td>{{$row->price}}

	  			<?php 
	  			$total += $row->price ;
	  			?>

	  		</td>
	  		<td>{{$row->item_count}}</td>
	  		<td>
	  			

	  			@if($row->active == 0)
	  			<div class='badge badge-warning'>@lang('user.wait')</div>
	  			@endif

	  			@if($row->active == 1)
	  			<div class='badge badge-success'>@lang('user.active')</div>
	  			@endif

	  			@if($row->active == 2)
	  			<div class='badge badge-danger'>@lang('user.back')</div>
	  			@endif
	  		</td>
	  		<td>{{$row->created_at}}</td>
	  		<td><button class='btn btn-danger singlBack' data-target='#back' data-toggle='modal' id='{{$row->id}}' @if($row->active == 2 || $row->active == 1) disabled @endif>@lang('user.back')</button></td>
	  	</tr>
	  @endforeach
	  	<tr>
	  		<td class='h4'>@lang('user.total')</td>
	  		<td></td>
	  		<td class='h5'>{{$total}}</td>
	  		<td></td>
	  		<td></td>
	  		<td></td>
	  		<td></td>
	  		
	  	</tr>

	  </tbody>
</table>

<div class='row'>
		  	<div class='col-6  '>
	  		
	  		<div class="card" style="width: 18rem;">
			  <div class="card-header">
			    <h2 class='h4'>@lang('user.info')</h2>
			  </div>

			  
			  
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item"><strong>@lang('user.item_count')</strong> :{{$sumitem}}
			    	
			    </li>

			    <li class="list-group-item"><strong>@lang('user.active')</strong> :{{$somorderOk}}
			    	
			    </li>

			    <li class="list-group-item"><strong>@lang('user.back')</strong> :{{$somorderBack}}
			    	
			    </li>

			     <li class="list-group-item"><strong>@lang('user.total')</strong> :{{$sumTotal}}
			    	
			    </li>

			    <il>

			    	


		@if( $sumitem != $somorderBack && $sumitem != $somorderOk && $somorderOk == 0 )

			
			    	 <div class='row'>
    	<div class='col-6'>
    		<button class='btn btn-success checkAll' id='{{$orderId}}' data-target='#checkAll' data-toggle='modal'>@lang('user.active')<i class='fas fa-check'></i></button>
    	</div>

    	<div class='col-6'>
    		<button id='{{$orderId}}' class='btn btn-danger backAll' data-target='#backAll' data-toggle='modal'>@lang('user.back')<i class='fas fa-trash'></i></button>
    	</div>
    </div>
    		
    		@endif
			    </il>


			    
			   
			  </ul>
			</div>

	  	</div>

	</div>


</div>

</div>



@endsection


@push('scripts')

<script>



$('.singlBack').on('click' , function(){
	var id = $(this).attr('id');

	var datatarget = $(this).attr('data-target');



	var ids = datatarget.split('#');

	var urls = $('.modalActionback').attr('action');

	var splets = urls.split('/') ;
	splets.pop();
	splets.push(id) ;
	splets[1] = '/';



	$('.modalActionback').attr('action' , '{{url("singelback")}}/'+id);

	
});


$('.backAll').on('click' , function(){
	var id = $(this).attr('id');

	var datatarget = $(this).attr('data-target');



	var ids = datatarget.split('#');

	var urls = $('.modalActionbackAll').attr('action');

	var splets = urls.split('/') ;
	splets.pop();
	splets.push(id) ;
	splets[1] = '/';



	$('.modalActionbackAll').attr('action' , '{{url("backAll")}}/'+id);

	
});



$('.checkAll').on('click' , function(){
	var id = $(this).attr('id');

	var datatarget = $(this).attr('data-target');



	var ids = datatarget.split('#');

	var urls = $('.modalActioncheckAll').attr('action');

	var splets = urls.split('/') ;
	splets.pop();
	splets.push(id) ;
	splets[1] = '/';



	$('.modalActioncheckAll').attr('action' , '{{url("checkAll")}}/'+id);

	
});


</script>

@endpush





