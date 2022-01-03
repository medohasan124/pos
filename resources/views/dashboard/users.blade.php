@extends('layouts.home')
@section('content')

<?php 


?>


<div class='tables'>
	   <x:notify-messages />

	<table class="table table-striped text-center">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">first_name</th>
	      <th scope="col">last_name</th>
	      <th scope="col">email</th>
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

	  					<a href='{{route('users.create')}}' class='btn btn-success'><i class='fas fa-plus'></i>  @lang('user.add')</a>
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
	  		<td>
	  			<a href='#' class="btn btn-primary">Edit <i class='fa fa-edit'></i></a>
	  			<a href='#' class="btn btn-danger">Delete <i class='fa fa-trash'></i></a>
	  		</td>
	  	</tr>
	  	@endforeach
		


	  </tbody>
</table>
</div>

@endsection


