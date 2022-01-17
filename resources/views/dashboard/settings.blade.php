@extends('layouts.home')
@section('content')



<h1 class='h1'> @lang('user.settings')</h1>
@include('dashboard.errors')



     <x:notify-messages />
     
<form action="{{route('settings.update' , $data->id)}}" method='POST' enctype='multipart/form-data'>
	{{csrf_field()}}
	{{method_field('PUT')}}


<div class='add'>
	<div class='container'>
		<div class='row'>
			  
			<div class='col-6'>
				<label>@lang('user.name_en')</label>
				<input type="text" name="sitename_en" class='form-control' value='{{$data->sitename_en}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.name_ar')</label>
				<input type="text" name="sitename_ar" class='form-control' value='{{$data->sitename_ar}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.email')</label>
				<input type="email" name="email" class='form-control' value='{{$data->email}}'>
			</div>

			

			<div class='col-6'>
				<label>@lang('user.description')</label>
				<input type="text" name="description" class='form-control' value='{{$data->description}}'>
			</div>

			

			<div class='col-6'>
				<label>@lang('user.phone1')</label>
				<input type="text" name="phone1" class='form-control' value='{{$data->phone1}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.phone2')</label>
				<input type="text" name="phone2" class='form-control' value='{{$data->phone2}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.logo')</label>
				<input type="file" name="logo" value='' class='form-control'>
			</div>

			<div class='col-6'>
				<img src='{{asset("upload/settings")."/".$data->logo}}' width='100px' height='100px' class='img-fluid img-thumbnails'>
			</div>
			<hr>
			
		</div>


<button class='btn btn-success'><i class='fas fa-pen'></i> @lang('user.edit')</button>
	</div>
</div>
</form>

<br />


@endsection


