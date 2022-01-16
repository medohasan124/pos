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
	      <th scope="col">first_name</th>
	      <th scope="col">last_name</th>
	      <th scope="col">email</th>
	      <th scope="col">image</th>
	      <th scope="col">Controle</th>
	    </tr>
	  </thead>
	  <tbody>

	  	<div class='search'>
	  		<div class='container'>
	  			<div class='row'>

	  				<div class='col-4'>
	  					<input type="text" name="search" placeholder="search" class='form-control' />
	  				</div>


	  				<div class='col-3'>
	  					
	  					<button class='btn btn-primary'><i class='fas fa-search'></i>  @lang('user.search')</button>


	  					@if(auth()->user()->isAbleTo('c'))
	  					<a href='{{route('users.create')}}' class='btn btn-success'><i class='fas fa-plus'></i>  @lang('user.add')</a>
	  					@endif
	  				</div>
	  				
	  			</div>
	  		</div>
	  	</div>


	  	@foreach($data as $row)

	  	<tr>
	  		<td>{{$row->id}}</td>
	  		<td>{{$row->first_name}}</td>
	  		<td>{{$row->last_name}}</td>
	  		<td>{{$row->email}}</td>

	  		<td><img src="{{asset('upload/users/'.$row->image)}}" width='50px' height='50px' class='img-fluid img-thumbnails'></td>
	  		<td>

	  			@if(auth()->user()->isAbleTo('e'))

	  			<a href='{{route("users.edit" , $row->id)}}' class="btn btn-primary">@lang('user.edit') <i class='fa fa-edit'></i></a>
	  			@endif
	  			
	  			@if(auth()->user()->isAbleTo('d'))

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

	$('.modalAction').attr('action' , '{{url("users")}}/'+id);

	
})


</script>

@endpush

