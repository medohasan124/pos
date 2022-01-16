 @extends('layouts.home')
@section('content')


<div id='app'>
	@include('order.modal')
<div class='tables'>

	<h1>@lang('user.history')</h1>
	   <x:notify-messages />

	  	

	<table class="table table-striped text-center" id='myTable'>
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">@lang('user.order_number')</th>
	      <th scope="col">@lang('user.username')</th>
	      <th scope="col">@lang('user.clients')</th>
	      
	      <th scope="col">@lang('user.leveles')</th>
	     
	      <th scope="col">@lang('user.detalse')</th>
	      
	    </tr>
	  </thead>
	  <tbody>


	  	<?php 
	  	$total = 0 ;
	  	?>
	  	@foreach($data as $index => $row)

	  	<tr>
	  		
	  		<td>@if(isset($index)){{$index + 1 }}@endif</td>
	  		<td>{{$row->order_id}}</td>
	  		<td>{{$row->first_name}}</td>
	  		<td>{{$row->username}}</td>
	  		
	  		
	  		<td>
	  			
	  			@if($row->active == 0)
	  			<p class='badge badge-warning'>@lang('user.wait')</p>
	  			@endif

	  			@if($row->active == 1)
	  			<p class='badge badge-success'>@lang('user.active')</p>
	  			@endif

	  			@if($row->active == 2)
	  			<p class='badge badge-danger'>@lang('user.back')</p>
	  			@endif
	  		</td>
	  		
	  		<td>
	  			

	  			<a href='{{route("detales" , [$row->order_id])}}' target='_blank' class='btn btn-primary'> <i class=' fas fa-info'></i></a>
	  			


	  			

	  			
	  		</td>

	  		
	  	</tr>
	  	@endforeach

	  	<tr>
	  		<td>
	  			@if(isset($index))
	  			{{$index + 2}}
	  			@endif
	  		
	  	</td>
	  		<td class='h3'>@lang('user.total')</td>
	  		<td>-</td>
	  		<td>-</td>
	  		<td>-</td>
	  		<td class='h5'>{{$total}}</td>
	  		
	  		
	  	</tr>
		


	  </tbody>
</table>
</div>

</div>



@endsection

@push('scripts')

<script>
	
	$(document).ready( function () {
    $('#myTable').DataTable();
});


$('.paied').click(function(){
	$('.modal-body').html('Are Yot Sure To Paid 500');
});

</script>

@endpush

