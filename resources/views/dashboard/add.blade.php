@extends('layouts.home')
@section('content')



<h1 class='h1'> @lang('user.add')</h1>
@include('dashboard.errors')



     <x:notify-messages />
     
<form action="{{route('users.store')}}" method='post'>
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
			<hr>
			<div class='col-6'>
				<button class='btn btn-success'><i class='fas fa-plus'></i> @lang('user.add')</button>
			</div>
			
		
		</div>
	</div>
</div>
</form>




@endsection


