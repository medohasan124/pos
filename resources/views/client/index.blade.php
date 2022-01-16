 @extends('layouts.home')
@section('content')



<div id='app'>

	@include('dashboard.modalDelete')
<div class='tables'>
	   <x:notify-messages />

	<table class="table table-striped text-center" id='test'>
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">username</th>
	      <th scope="col">Number</th>
	      <th scope="col">location</th>
	      <th scope="col">email</th>
	      <th scope="col">Controller</th>
	    </tr>
	  </thead>
	  <tbody>

	  	<div class='search'>
	  		<div class='container'>
	  			<div class='row'>



	  				<div class='col-3'>
	  					@if(auth()->user()->isAbleTo('client_c'))
	  					<a href='{{route('client.create')}}' class='btn btn-success'><i class='fas fa-plus'></i>  @lang('user.add') </a>
	  					@endif
	  				</div>
	  				
	  			</div>
	  		</div>
	  	</div>


	  	@foreach($data as $row)

	  	<tr>
	  		<td>{{$row->id}}</td>
	  		<td>{{$row->username}}</td>
	  		<td>{{$row->number}}</td>
	  		<td>{{$row->location}}</td>
	  		<td>{{$row->email}}</td>
	  		
	  		

	  			<td>
	  			@if(auth()->user()->isAbleTo('client_e'))
	  			
	  			<a href='{{route("client.edit" , $row->id)}}' class="btn btn-primary">@lang('user.edit') <i class='fa fa-edit'></i></a>
	  			
	  			@endif
	  		
	  			@if(auth()->user()->isAbleTo('client_d'))
		  			
		  			<a  id='{{$row->id}}' href='#' data-toggle="modal" data-target="#delete-{{$row->id}}" class="btn btn-danger deleteBtn">@lang('user.delete') <i class='fa fa-trash'></i></a>
		  			
	  			@endif


	  		</td>
	  	</tr>
	  	@endforeach
		


	  </tbody>
</table>
</div>

</div>



@endsection

@push('scripts')

<script>
	
	$(document).ready( function () {
    $('#test').DataTable();
} );


$('.deleteBtn').on('click' , function(){
	var id = $(this).attr('id');

	var datatarget = $(this).attr('data-target');

	var ids = datatarget.split('#');

	

	$('.deleteModal').attr('id' , ids[1]);



	var urls = $('.modalAction').attr('action');

	var splets = urls.split('/') ;
	splets.pop();
	splets.push(id) ;
	splets[1] = '/';

	console.log(splets);

	$('.modalAction').attr('action' , '{{url("client")}}/'+id);

	
})


</script>

@endpush

