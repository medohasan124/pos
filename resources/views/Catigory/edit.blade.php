 @extends('layouts.home')
@section('content')



<div id='app'>

<h1 class='h1'> @lang('user.edit')</h1>
@include('dashboard.errors')



<form action='{{route("catigory.update" , $data->id)}}' method='POST'>

	{{csrf_field()}}
	{{method_field('PUT')}}

	<label>
		name_en
		<input type='text' name='name_en' required class='form-control' value='{{$data->name_en}}'>
	</label>
	<label>
		name_ar
		<input type='text' name='name_ar' required class='form-control' value='{{$data->name_ar}}'>
	</label>
	

	<button type='submit' class='btn btn-success'>Save <i class='fas fa-save'></i></button>
</form>

</div>



@endsection


