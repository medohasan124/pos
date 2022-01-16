@extends('layouts.home')
@section('content')



<h1 class='h1'> @lang('user.add')</h1>
@include('dashboard.errors')



     <x:notify-messages />
     
<form action="{{route('items.update' , $data->id)}}" method='POST' enctype="multipart/form-data">
	<input type="hidden" name="_token" value='{{csrf_token()}}'>
{{method_field('PUT')}}


	
<div class='add'>
	<div class='container'>
		<div class='row'>
			  
			<div class='col-6'>
				<label>@lang('user.name_en')</label>
				<input type="text" name="name_en" class='form-control' required value='{{$data->name_en}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.name_ar')</label>
				<input type="text" name="name_ar" class='form-control' required value='{{$data->name_ar}}'>
			</div>

			<div class='col-6'>
				<?php 
				$catigory = \App\Catigory::all();
				?>
				<label>@lang('user.catigories')</label>
				<select name='cat_id' class='form-control' required >

					@foreach($catigory as $cat)
					<option value='{{$cat->id}}'

						@if($cat->id == $data->cat_id)
						selected
						@endif
						>{{$cat->name_ar}}</option>
					@endforeach
					
				</select>
			</div>

			

			<div class='col-6'>
				<label>@lang('user.price')</label>
				<input type="number" name="price" class='form-control' required value='{{$data->price}}'>
			</div>

			<div class='col-6'>
				<label>@lang('user.store')</label>
				<input type="number" name="store" class='form-control' required value='{{$data->store}}'>
			</div>


			<div class='col-6'>
				<label>@lang('user.image')</label>
				<input type="file" name="image" class='form-control' >
			</div>

			<div class='col-6'>
				
				<image src='{{asset("upload/items").'/'.$data->image}}' class='image-fluid image-thumbnails'>
			</div>
			<hr>
			
			
		</div>

		
<button class='btn btn-success'><i class='fas fa-plus'></i> @lang('user.add')</button>
	</div>
</div>
</form>

<br />


@endsection


