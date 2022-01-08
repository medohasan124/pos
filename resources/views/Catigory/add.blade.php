 @extends('layouts.home')
@section('content')



<div id='app'>

<h1 class='h1'> @lang('user.add')</h1>
@include('dashboard.errors')



<form action='{{route("catigory.store")}}' method='POST'>

	{{csrf_field()}}

	<label>
		name_en
		<input type='text' name='name_en' required class='form-control'>
	</label>
	<label>
		name_AR
		<input type='text' name='name_ar' required class='form-control'>
	</label>
	

	<button type='submit' class='btn btn-success'>Save <i class='fas fa-save'></i></button>
</form>

</div>



@endsection


