 @extends('layouts.home')
@section('content')



<div id='app'>

<h1 class='h1'> @lang('user.add')</h1>
@include('dashboard.errors')



<form action='{{route("client.store")}}' method='POST'>

	{{csrf_field()}}
<div class='row'>

	<div class='col-md-3'>
		<label>
			username
			<input type='text' name='username' required class='form-control' value='{{old("username")}}'>
		</label>

	</div>

	<div class='col-md-3'>
		<label>
			number
			<input type='number' name='number' required class='form-control' value='{{old("number")}}'>
		</label>
	</div>

	<div class='col-md-3'>
		<label>
			location
			<input type='text' name='location' required class='form-control' value='{{old("location")}}'>
		</label>
	</div>


	<div class='col-md-3'>
		<label>
			email
			<input type='text' name='email' required class='form-control' value='{{old("email")}}'>
		</label>
	</div>
</div>

	
	
	

	<button type='submit' class='btn btn-success'>Save <i class='fas fa-save'></i></button>
</form>

</div>



@endsection


