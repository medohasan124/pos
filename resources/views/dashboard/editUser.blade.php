@extends('layouts.home')
@section('content')



<h1 class='h1'> @lang('user.edit')</h1>
@include('dashboard.errors')



     <x:notify-messages />
     
<form action="{{route('users.update' , $id)}}" method='POST' enctype='multipart/form-data'>
	{{csrf_field()}}
	{{method_field('PUT')}}


<div class='add'>
	<div class='container'>
		<div class='row'>
			  
			<div class='col-6'>
				<label>@lang('user.username')</label>
				<input type="text" name="username" class='form-control' value='{{$data->first_name}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.password')</label>
				<input type="text" name="password" class='form-control' value='{{old("password")}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.f_name')</label>
				<input type="text" name="f_name" class='form-control' value='{{$data->first_name}}'>
			</div>

			

			<div class='col-6'>
				<label>@lang('user.Config_password')</label>
				<input type="text" name="password_confirmation" class='form-control' value='{{old("password")}}'>
			</div>

			

			<div class='col-6'>
				<label>@lang('user.l_name')</label>
				<input type="text" name="l_name" class='form-control' value='{{$data->last_name}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.email')</label>
				<input type="text" name="email" class='form-control' value='{{$data->email}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.image')</label>
				<input type="file" name="image" value='' class='form-control'>
			</div>

			<div class='col-6'>
				<img src='{{asset("upload/users")."/".$data->image}}' width='100px' height='100px' class='img-fluid img-thumbnails'>
			</div>
			<hr>
			
				
		
		</div>
		<h2>Permitions</h2>

		<br>
		@php

$roles = ['user' , 'catigory' , 'item' , 'client'];
$permissions = DB::table('permissions')->get();
$permission_user = DB::table('permission_user')->where('user_id' , $id)->orderBy('permission_id' , 'desc')->get('permission_id');



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

    		  <div class="tab-pane fade show {{ $active = $index == 0 ? 'active' : '' }}" id="list-{{$row}}" role="tabpanel" aria-labelledby="list-home-list">

    		  	@foreach($permissions as $indexs => $rows)

    		  	@if($rows->description == $row)
    		  	<label><input type='checkbox'

    		  		@if($data->isAbleTo($rows->name))
    		  			checked
    		  		@endif

    		  	 name='permission_Users[]' value='{{$rows->id}}'> {{$rows->display_name}}</label>
    		  	 @endif


    		  	@endforeach
    		  </div>
    	@endforeach
    </div>
  </div>
</div>


<button class='btn btn-success'><i class='fas fa-pen'></i> @lang('user.edit')</button>
	</div>
</div>
</form>

<br />


@endsection


