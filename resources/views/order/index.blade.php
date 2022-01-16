 @extends('layouts.home')
@section('content')


@include('items.searchCleint')
<style>
	.list-group li:hover{
		cursor: pointer;
	}

	.searchCleint{
		    margin: 23px;
	}
</style>


	<h1>@lang('user.orders')</h1>

	<hr>

	<div id='app'>
			   <x:notify-messages />
		@include('dashboard.errors')
		<form action='{{route("lastOrder")}}' method='POST'>
			{{csrf_field()}}
		<div class='row searchCleint'>
			<div class='col-2 h4'>@lang('user.clients')</div>
			<div class='col-3'>

				<input type='text' class='form-control searchClients' required data-toggle="modal" data-target="#exampleModal" />
				<input type='hidden' name='client_id' class='client_id'/>

			</div>

			<div class='col-2'>

				<?php 
				$orderNumber = DB::table('orderhistories')->latest('order_id')->first();
				
				

				if($orderNumber == null){
					$order_number = 1 ;	
				}else{
					$order_number = $orderNumber->order_id + 1 ;
				}
				?>
				@lang('user.order_number')
			</div>

			<div  class='h5 col-md-2'>
					<input type='text' value='{{$order_number}}' name='order_number'class='form-control' readonly />
			</div>


			
		</div>
<div class='row'>
	<div class='col-md-6'>

		<div class='row'>
			<div class='col-md-4 '>

				<div class="card">
					  <div class="card-header">
					  	@lang('user.catigories')
					  </div>
					  <ul class="list-group list-group-flush">
					   @foreach($cat as $row)
							<li  id='{{$row->id}}' class="list-group-item cat_click">{{$row->name_ar}}</li>
						@endforeach
					  </ul>
				</div>
			</div>


			<div class='col-md-8'>

				<div class="card">
					  <div class="card-header">
					  	<div class='row'>
					  		<div class='col'>@lang('user.item')</div>
					  		<div class='col'>@lang('user.price')</div>
					  		<div class='col'>@lang('user.image')</div>
					  		<div class='col'>@lang('user.add')</div>
					  	</div>
					  
					  </div>
		  <ul class="list-group list-group-flush items-list">
		  	<li class='snippit d-none' style='    text-align: center;
    margin: 10px;'>
		  		<div class="spinner-border " role="status">
  					<span class="sr-only">Loading...</span>
				</div>
		  	</li>
				
		  </ul>
				</div>

			</div>
		</div>
	</div>

	<div class='col-md-6'>
		<div class="card">
		  <div class="card-header text-center">
	  			<div class='row'>
				  		<div class='col'>@lang('user.item')</div>
				  		<div class='col'>@lang('user.price')</div>
				  		<div class='col'>@lang('user.count')</div>
				  		<div class='col'>@lang('user.delete')</div>
				  		
				</div>
		  </div>
		  

		  <ul class="list-group list-group-flush itemList">
					  
			</ul>
			 <div class="card-footer text-muted">
    		<h4>@lang('user.total') <strong class='total'>0.00</strong></h4>
    		<br>
    		<button class='btn btn-primary form-control'>@lang('user.sale')   <i class="fas fa-shopping-cart"></i></button>
  			</div>
		</div>
	</div>
</div>
</form>
</div>




@endsection


@push('scripts')
<script>

$(document).ready( function () {
    $('#myTable').DataTable();
} );


$('.cat_click').on('click' , function(){

	$('.items-list').html('');
	$('.items-list').html(`
		<li class='snippit d-none' style='    text-align: center;
    margin: 10px;'>
		  		<div class="spinner-border " role="status">
  					<span class="sr-only">Loading...</span>
				</div>
		  	</li>
		`);

	$('.snippit').removeClass('d-none');

	var id = $(this).attr('id');
	$('.cat_click').removeClass('disabled');
	$(this).addClass('disabled');

	$.ajax({
		url:"{{route('order.index')}}" ,
		method:'get',
		data:{
			_token :'{{csrf_token()}}' ,
			id : id 
		} ,
		success:function(s){
			$('.snippit').addClass('d-none');
			
			
				var data = JSON.parse(s);
				
				$.each(data , function(index,e){

					$('.items-list').append(`

						<li class="list-group-item cat_add">
					
				
						<div class='row '>
						
					
				<div class='col'>${e.name_ar}</div>
				<div class='col'>${e.price}</div>

	<div class='col'><img     width='38px' class='img-fluid' src='{{asset("upload/items") . '/'}}${e.image}' /></div>

				<div class='col buttonAdd'>

				<button data-id='${e.id}' data-name='${e.name_ar}' data-price='${e.price}' class=' btn btn-success addItems' id='b${e.id}'><i class='fas fa-plus'></i>
				</button>

				 <hr>
				 </div>


				</div>

				</li>
				`);


					
				});
		


		},
		error:function(e){
			
		}

	})

});

$('.clientS').on('click' , function(){
	var id = $(this).attr('id');
	var username = $(this).attr('data-name');

	

	

	$('.searchClients').val(username);
	$('.client_id').val(id);

	$('#exampleModal').modal('hide');
});




// start to append items

var total = 0;

var indexs = 0 ;
$(document).on('click' ,'.addItems' , function(){

	indexs++ ;

	$(this).attr('disabled' , true);

	var id = $(this).attr('data-id');
	var name = $(this).attr('data-name');
	var price = $(this).attr('data-price');

	$('.itemList').append(`

		<li class='list-group-item listOfItem' id='row-item-${id}'>
					  	<div class='row text-center'>
					  		<div class='col'>
					  			${name}
					  		</div>

					  		<div id='${id}' class='col priceItem${id} totalAll'>${price}</div>
					  		<input type='hidden' name='price[]' value='${price}' id='price-${id}' />
					  		<input type='hidden' name='id[]' value='${id}'/>
					  		<div class='col'>
					  			
					  			<input id='${id}' name='itemCount[]' data-price='${price}' min='1' type='number' class='form-control itemCount' value='1' required>
					  		</div>

					  		
					  		<div class='col'>
					  			
					  			<button id='${id}' data-price='${price}' class='btn btn-danger delitem'><i class='fas fa-trash'></i></button>
					  		</div>
					  	</div>
					  </li>

		`);

		total += Number(price) ;
		$('.total').text(total.toFixed(2));

	

});


$(document).on('click' , '.delitem' , function(){
	var id = $(this).attr('id');
	var price = $(this).attr('data-price');
	var priceItem = Number($('.priceItem'+id).html());

		

		total -= Number(priceItem) ;
		$('.total').html(total.toFixed(2));


		$('.buttonAdd #b'+ id).removeAttr('disabled');
		$('#row-item-'+id).remove();

		indexs-- ;


});




$(document).on('keyup' , '.itemCount' , function(){
	var price = Number($(this).attr('data-price'));
	var id = $(this).attr('id');

	var changePice = Number($(this).val());

	var change = price * changePice ;
	$('.priceItem'+id).text(change);
	$('#price-'+id).val(change);

	var len = $('.listOfItem').length ;

	var fTotal = 0 ;

	
		
	

	$('.totalAll').each(function(i , ee){
		console.log(i)

		var ids = $(this).attr('id');
		console.log(ids);

		var t = $('#price-'+ids).val();

		

		fTotal += Number(t);

	 	total = Number(fTotal);

	 	console.log(fTotal);
		$('.total').html(total.toFixed(2));
	});
});



</script>

@endpush

