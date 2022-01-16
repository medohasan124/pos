 @extends('layouts.home')
@section('content')



<div id='app'>

	@include('dashboard.modalDelete')
<div class='tables'>

	<h1>@lang('user.item')</h1>
	   <x:notify-messages />
	  	<div class='search'>
	  		<div class='container'>
	  			<div class='row'>

	  				


	  				<div class='col-3'>
	  					@if(auth()->user()->isAbleTo('item_c'))
	  					<a href='{{route('items.create')}}' class='btn btn-success'><i class='fas fa-plus'></i>  @lang('user.add')</a>
	  					@endif
	  				</div>

	  				<div class='col-9'>

	  					<h3>@lang('user.catigories')</h3>

	  					<?php
	  					$catigories = \App\Catigory::all();
	  					?>
	  					<a class='btn btn-success' href='{{route('items.index')}}'>@lang('user.all')</a>
	  					@foreach($catigories as $cat)
	  					<a class='btn btn-primary' href="{{route('items.index' , ['id' => $cat->id])}}">{{$cat->name_ar}}</a>
	  					@endforeach
	  				</div>
	  				
	  			</div>
	  		</div>
	  	</div>

	<table class="table table-striped text-center" id='myTable'>
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">nme_en</th>
	      <th scope="col">nme_ar</th>
	      <th scope="col">price</th>
	      <th scope="col">store</th>
	      <th scope="col">catigory</th>
	      <th scope="col">image</th>
	      <th scope="col">Controle</th>
	    </tr>
	  </thead>
	  <tbody>



	  	@foreach($data as $row)

	  	<tr>
	  		<td>{{$row->id}}</td>
	  		<td>{{$row->name_en}}</td>
	  		<td>{{$row->name_ar}}</td>
	  		<td>{{$row->price}}</td>
	  		<td>{{$row->store}}</td>
	  		<td>{{$row->cat_name}}</td>

	  		<td><img src="{{asset('upload/items/'.$row->image)}}" width='50px' height='50px' class='img-fluid img-thumbnails'></td>
	  		<td>

	  			@if(auth()->user()->isAbleTo('item_e'))

	  			<a href='{{route("items.edit" , $row->id)}}' class="btn btn-primary">@lang('user.edit') <i class='fa fa-edit'></i></a>
	  			@endif
	  			
	  			@if(auth()->user()->isAbleTo('item_d'))

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
    $('#myTable').DataTable();
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



	$('.modalAction').attr('action' , '{{url("items")}}/'+id);

	
})


</script>

@endpush

