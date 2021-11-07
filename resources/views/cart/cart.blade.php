<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Cart')

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_home','active')


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
<style type="text/css">
	
	@media(max-width: 992px){
		div[data-error]{
		    left: 101%!important;
		    top: -2%!important;
		}
	}

</style>
@endsection

@section('content')
<!-- Home -->
<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url(images/cart.jpg)"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{Route('index')}}">Home</a></li>
									<li>Shopping Cart</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Cart Info -->

<div class="cart_info">
	<div class="container">
		<div class="row">
			<div class="col">
				<!-- Column Titles -->
				<div class="cart_info_columns clearfix">
					<div class="cart_info_col cart_info_col_product">Product</div>
					<div class="cart_info_col cart_info_col_price">Price</div>
					<div class="cart_info_col cart_info_col_quantity">Quantity</div>
					<div class="cart_info_col cart_info_col_total">Total</div>
				</div>
			</div>
		</div>
		<div class="row cart_items_row">
			<div class="col">


				<!-- auth - для работы аутентифицированными пользователями -->
				@auth('web')

				<?php 
					
					
					
					
					
					
					

					

					
					
					
					
					
				?>
				

				
				 
				<!-- записываем в переменную все выбранные клиентом товары -->
				@php 
					$getContent = \Cart::session(@auth()->user()->id)->getContent();
				@endphp

				@if ( isset($getContent) )
					@if ( $getContent->count() > 0 )
						@foreach ( $getContent as $value )

						<!-- Cart Item -->
						<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start" data-idproduct="{{$value->id}}">
							<!-- Name -->
							<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
								<div class="cart_item_image" style="overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
									<div><img style="object-fit: fill;width: 100%;max-height: 100%;" src="{{$value->attributes->img}}" alt=""></div>
								</div>
								<!--  -->
								<div class="cart_item_name_container">
									<div class="cart_item_name"><a href="{{ Route('showProduct', ['slug' => $value->attributes->slug]) }}">{{$value->name}}</a></div>
									<div class="cart_item_edit" data-edit="{{$value->id}}"><a href="#">Edit Product</a></div>
									<div class="cart_item_edit" data-delete="{{$value->id}}">
										<a href="">Delte</a>
									</div>
								</div>
							</div>
							<!-- Price -->
							<div class="cart_item_price" data-price_id="{{ $value->id }}"></div>
							<!-- Quantity -->
							<div class="cart_item_quantity">
								<div class="product_quantity_container">
									<div class="product_quantity clearfix" data-response="{{ $value->id }}" style="position:relative;overflow: inherit;">
										<span>Qty</span>
										<!-- pattern="[0-9]*" -->
										<input class="quantity_input" type="text"  value="{{$value->quantity}}" style="width: 50px;">
										<div data-error class="response_{{ $value->id }}" style="position: absolute;width: 100%;left: 0;border-radius: 0;top: 102%;"></div>

									</div>

									
								</div>
								

							</div>
							<!-- Total -->
							<div class="cart_item_total" data-sum_price_id="{{ $value->id }}"></div>
						</div>


						<script type="text/javascript">
							$(function(){
								
								function makeMoney(number) {
								    return '$ ' + parseFloat(number).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
								}

								
								$('.cart_item_price[data-price_id="{{ $value->id }}"]').
								text(makeMoney( '{{ $value->price }}' ));


								
								$('.cart_item_total[data-sum_price_id="{{ $value->id }}"]').
								text(makeMoney( '{{ $value->price * $value->quantity }}' ));
							})
						</script>

						@endforeach
					@else 
						<span style="display: block;
									 width: 100%;
									 text-align: center;
									 font-size: 25px;">
							Корзина пуста !
						</span>
					@endif
				@endif
				@endauth
				


			</div>
		</div>
		<div class="row row_cart_buttons">
			<div class="col">
				<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
					<div class="button continue_shopping_button"><a href="{{Route('products')}}">Continue shopping</a></div>
					<div class="cart_buttons_right ml-lg-auto">
						<div class="button clear_cart_button"><a href="">Clear cart</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row_extra">
			<div class="col-lg-4">
			</div>
			<div class="col-lg-6 offset-lg-2">
				<div class="cart_total">
					<div class="section_title">Cart total</div>
					<div class="section_subtitle">Final info</div>
					<div class="cart_total_container">
						<ul>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="cart_total_title">Total</div>
								<div class="cart_total_value ml-auto" data-total_price></div>	
							</li>
						</ul>
					</div>
					<div class="button checkout_button"><a href="{{ Route('checkout') }}">Proceed to checkout</a></div>
				</div>
			</div>
		</div>
	</div>		
</div>

<h1 class="c">c</h1>

@endsection

@section('script_js')
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/cart.js"></script>

<script type="text/javascript">
	$(function(){



		
		function makeMoney(number) {
		    return '$ ' + parseFloat(number).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
		}



		
		$('div[data-total_price]').html(makeMoney(

			@auth('web')
			<?= \Cart::session(@auth()->user()->id)->getTotal() ?>
			@endauth

			@guest('web')
			0
			@endguest
		))

		

		
		$('.cart_item_edit[data-edit]').click(function(e){
			e.preventDefault();

			
			let id_product = $(this).data('edit');
			

			
			let parent = $(this).closest('.cart_item');
			
			let count = $(parent).find('.quantity_input').val();
			

			
			let price_old = $(parent).find('.cart_item_total');
			let price_old_value = $(parent).find('.cart_item_total').text();
			price_old_value = price_old_value.split('$').pop();
			


			let product_obj = { 
				"id"    : id_product ,
				"count" : count ,
			};

			$.ajax({
				url: "{{ Route('cart.editCart') }}",
				type: 'POST',
				
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				dataType: "json",

				contentType: "application/json",
				
				
			    
			    
				data: JSON.stringify({ 
					id    : product_obj.id ,
					count : product_obj.count
				}),
								
				success:(data) => {
					console.log(data);

					if(data.result == 'success'){
						
						
						$('div[data-total_price]').html(makeMoney(data['all_price']))

						
						$('#count_products_in_cart').text(data['all_count']);
						
						
						
						price_old.text(makeMoney(data['price']));

						
						$(`.product_quantity.clearfix[data-response="${id_product}"]`).css('border','2px solid #d0d0d0');
						$(`.response_${id_product}`).removeClass( "alert alert-danger" ).text(''); 
	
					}
				},


				error: function (data) {
				    console.log(data)

				    
				   	if( data.status === 422 ) {

			            let message_errors = data.responseJSON.errors;

			            
			            $(message_errors).each(function(key, data){
			            	console.log('key = ' + key  +'\n'+ 'data = ' + data)

			            	
			            	$.each(data, function(index,value) {
							    console.log('index = ' + index +'\n'+ 'value = ' + value);

							    
							    $(`.response_${id_product}`).addClass("alert alert-danger").text(value); 
							});

			            });

			            $(`.product_quantity.clearfix[data-response="${id_product}"]`).css('border','1px solid red');
			              
			        }




			        
			        if (data.status === 403) {

			        	
						if (confirm("Для управления корзиной вы должны войти на сайт\nПерейти к странице входа ?")){
							window.location.href = "{{ Route('auth.login') }}"; 
						}
			        }

				},
			});	
		});	








		
		$('.cart_item_edit[data-delete]').click(function(e){
			e.preventDefault();

			let id_product = $(this).data('delete');
			

			let id_product_obj = { 
				"id" : parseInt(id_product) ,
			};

			$.ajax({
				url: "{{ Route('cart.delElemCart') }}",
				type: 'POST',
				
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				dataType: "json",

				contentType: "application/json",
				
				
			    
			    
				data: JSON.stringify({ 
					id : id_product_obj.id
				}),
					
				
				success:(data) => {
					console.log(data)
					
					
					

					if(data.result == 'success'){

						
						$(`div[data-idproduct=${data['id']}]`).remove();

						
						$('div[data-total_price]').html(makeMoney(data['all_price']))

						
						$('#count_products_in_cart').text(data['all_count']);

						
						$(`.product_quantity.clearfix[data-response="${id_product}"]`).css('border','2px solid #d0d0d0');
						$(`.response_${id_product}`).removeClass( "alert alert-danger" ).text(''); 
					}
				},

				
				error: function(data) {
  					console.log(data)
  					

  					
				   	if( data.status === 422 ) {
				   		let message_errors = data.responseJSON.errors;

			            
			            $(message_errors).each(function(key, data){
			            	console.log('key = ' + key  +'\n'+ 'data = ' + data)

			            	
			            	$.each(data, function(index,value) {
							    console.log('index = ' + index +'\n'+ 'value = ' + value);

							    
							    $(`.response_${id_product}`).addClass("alert alert-danger").text(value); 
							});

			            });
			            
			            $(`.product_quantity.clearfix[data-response="${id_product}"]`).css('border','1px solid red');
			              
			        }

			        
			        if (data.status === 403) {

			        	
						if (confirm("Для управления корзиной вы должны войти на сайт\nПерейти к странице входа ?")){
							window.location.href = "{{ Route('auth.login') }}"; 
						}
			        }
  				}
			});
		});








		
		$('.button.clear_cart_button').click(function(e){
			e.preventDefault();

			$.ajax({
				url: "{{ Route('cart.clearCart') }}",
				type: 'POST',
				
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
					
				success:(data) => {
					console.log(data);
					if(data.result == 'success'){

						
						$('div[data-idproduct]').remove();

						
						$('div[data-total_price]').text('$ 0.00');

						
						$('#count_products_in_cart').text('0');
					}
				},

				
				error: function(data) {
  					console.log(data)
  					

			        
			        if (data.status === 403) {

			        	
						if (confirm("Для управления корзиной вы должны войти на сайт\nПерейти к странице входа ?")){
							window.location.href = "{{ Route('auth.login') }}"; 
						}
			        }
  				}
			});
		});	
	});
	
</script>
@endsection


