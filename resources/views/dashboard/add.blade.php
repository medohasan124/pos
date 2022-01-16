@extends('layouts.home')
@section('content')



<h1 class='h1'> @lang('user.add')</h1>
@include('dashboard.errors')



     <x:notify-messages />
     
<form action="{{route('users.store')}}" method='POST' enctype="multipart/form-data">
	<input type="hidden" name="_token" value='{{csrf_token()}}'>

	
<div class='add'>
	<div class='container'>
		<div class='row'>
			  
			<div class='col-6'>
				<label>@lang('user.username')</label>
				<input type="text" name="username" class='form-control' value='{{old("username")}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.password')</label>
				<input type="text" name="password" class='form-control' value='{{old("password")}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.f_name')</label>
				<input type="text" name="f_name" class='form-control' value='{{old("f_name")}}'>
			</div>

			

			<div class='col-6'>
				<label>@lang('user.Config_password')</label>
				<input type="text" name="password_confirmation" class='form-control' value='{{old("password_confirmation")}}'>
			</div>

			

			<div class='col-6'>
				<label>@lang('user.l_name')</label>
				<input type="text" name="l_name" class='form-control' value='{{old("l_name")}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.email')</label>
				<input type="text" name="email" class='form-control' value='{{old("email")}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.image')</label>
				<input type="file" name="image" class='form-control'>
			</div>
			<hr>
			
				
		
		</div>
		<h2>Permitions</h2>

		<br>
		@php

$roles = ['user' , 'catigory' , 'item' , 'client'];
$permissions = DB::table('permissions')->get();



@endphp

<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">

    	@foreach($roles as $index => $row)
    	<a class="list-group-item list-group-item-action {{ $active = $index == 0 ? 'active' : '' }}" id="list-home-list" data-toggle="list" href="#list-{{$row}}" role="tab" aria-controls="home" >{{$row}}</a>
    	@endforeach
     
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
    	@foreach($roles as $index => $row)

    		{{-- Users Permissions --}}
    		  <div class="tab-pane fade show {{ $active = $index == 0 ? 'active' : '' }}" id="list-{{$row}}" role="tabpanel" aria-labelledby="list-home-list">
    		  	
    		  	@foreach($permissions as $rows)
    		  	@if($rows->description == $row)
    		  	<label><input type='checkbox' name='permission[]' value='{{$rows->id}}'> {{$rows->display_name}}</label>
    		  	@endif
    		  	@endforeach
    		  </div>


    		 



    		 

    	

    	@endforeach
    </div>
  </div>
</div>


<button class='btn btn-success'><i class='fas fa-plus'></i> @lang('user.add')</button>
	</div>
</div>
</form>

<br />


@endsection


