@include('layouts.header') 
@include('layouts.slider') 

<div class="content-wrapper" style="margin-left:0px ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      	<div class="container-fluid">
			@yield('content')
		</div>
	</div>
</div>

@include('layouts.footer') ;