<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Product')

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_home','active')


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="/styles/bootstrap4/bootstrap.min.css">
<link href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/styles/product.css">
<link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">

<style>

.img-sm {
 width: 46px;
 height: 46px;
}
.panel {
 box-shadow: 0 2px 0 rgba(0,0,0,0.075);
 border-radius: 0;
 border: 0;
 margin-bottom: 15px;
}
.panel .panel-footer, .panel>:last-child {
 border-bottom-left-radius: 0;
 border-bottom-right-radius: 0;
}
.panel .panel-heading, .panel>:first-child {
 border-top-left-radius: 0;
 border-top-right-radius: 0;
}
.panel-body {
 padding: 25px 20px;
}
.media-block .media-left {
 display: block;
 float: left
}
.media-block .media-right {
 float: right
}
.media-block .media-body {
 display: block;
 overflow: hidden;
 width: auto
}
.middle .media-left,
.middle .media-right,
.middle .media-body {
 vertical-align: middle
}
.thumbnail {
 border-radius: 0;
 border-color: #e9e9e9
}
.tag.tag-sm, .btn-group-sm>.tag {
 padding: 5px 10px;
}
.tag:not(.label) {
 background-color: #fff;
 padding: 6px 12px;
 border-radius: 2px;
 border: 1px solid #cdd6e1;
 font-size: 12px;
 line-height: 1.42857;
 vertical-align: middle;
 -webkit-transition: all .15s;
 transition: all .15s;
}
.text-muted, a.text-muted:hover, a.text-muted:focus {
 color: #acacac;
}
.text-sm {
 font-size: 0.9em;
}
.text-5x, .text-4x, .text-5x, .text-2x, .text-lg, .text-sm, .text-xs {
 line-height: 1.25;
}
.btn-trans {
 background-color: transparent;
 border-color: transparent;
 color: #929292;
}
.btn-icon {
 padding-left: 9px;
 padding-right: 9px;
}
.btn-sm, .btn-group-sm>.btn, .btn-icon.btn-sm {
 padding: 5px 10px !important;
}
.mar-top {
 margin-top: 15px;
}
</style>
@endsection

@section('content')
	
<!-- Home -->

<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url('{{$product->categories->img_label}}')"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">{{$product->categories->title}}<span>.</span></div>
							<div class="home_text"><p>{{$product->categories->announcement}}</p></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Product Details -->

<div class="products" style="padding: 89px 0">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="products_title">{{$product->title}}</div>
			</div>
		</div>
	</div>
</div>

<div class="product_details">
	<div class="container">
		<div class="row details_row" style="margin-top: 0;">


			@php
			$count_img = 0;
			if(count($product->images) > 0){
				$count_img = count($product->images);
				$name_img = $product->images[0]->img;
			}else{
				$name_img = '/images/not_file.png';
			}
			if($product->in_stock){
				$stock = 'In Stock';
			}else{
				$stock = 'Not Stock';
			}
			@endphp


	

			<!-- Product Image -->
			<div class="col-lg-6">
				<div class="details_image">
					<div class="details_image_large"><img src="{{$name_img}}" alt=""></div>
					<div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
						
						@if($count_img != 0)
							@foreach($product->images as $images)
							<!-- если кол-во картинок будет = 1 то запишем что всетаки 2 чтобы картинка которая находится под главной была маленького размера а не как главная картинка -->
							<div class="details_image_thumbnail" style="width: calc((100% - 51px) / {{($count_img == 1)?2:$count_img;}});" data-image="{{$images->img}}"><img src="{{$images->img}}" alt=""></div>
							@endforeach
						@endif

					</div>
				</div>
			</div>

			<!-- Product Content -->
			<div class="col-lg-6">
				<div class="details_content">
					<div class="details_name">{{$product->categories->title}}</div>
					@if(!isset($product->new_price))
						<div class="details_price">${{$product->price}}</div>
					@else
						<div class="details_discount">${{$product->price}}</div>
						<div class="details_price">${{$product->new_price}}</div>
					@endif
					

					<!-- In Stock -->
					<div class="in_stock_container">
						<div class="availability">Availability:</div>
						<span>{{$stock}}</span>
					</div>
					<div class="details_text">
						<p>{{$product->announcement}}</p>
					</div>

					<!-- Product Quantity -->
					<div class="product_quantity_container">
						<div class="product_quantity clearfix">
							<span>Qty</span>
							<input id="quantity_input" type="text" max="100" min="1" pattern="[0-9]*" value="1" style="width: 60px;">
							<div class="quantity_buttons">
								<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
								<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
							</div>
						</div>
						<div class="button cart_button"><a href="#">Add to cart</a></div>
						
						<!-- для вывода ошибок -->
						<div data-error class="response_{{ $product->id }}" style="position: absolute;width: 100%;left: 0;border-radius: 0;top: 103%;"></div>
					</div>

					<!-- Share -->
					<div class="details_share">
						<span>Share:</span>
						<ul>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row description_row">
			<div class="col">
				<div class="description_title_container">
					<div class="description_title">Description</div>
				</div>
				<div class="description_text">
					<p>{{$product->description}}</p>
				</div>
			</div>
		</div>

		

	</div>
</div>

<!-- Products -->



<!-- Comments -->

<div class="newsletter">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="newsletter_border"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div  class="newsletter_content text-center">
					<div class="newsletter_title">Coments</div>
					<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
					<div class="panel">
						<div class="panel-body">

							<!-- form comments -->
							<form id="form_comments" method="POST" action="{{ Route('comment', ['slug' => $product->slug]) }}">


								@csrf

								<textarea name="text" class="form-control" rows="2" placeholder="Добавьте Ваш комментарий">{{ old('text') }}</textarea>

								<!-- вывод ошибок c использованием ajax -->
								<div id="errors" class="alert alert-danger" style="display:none;border-radius: 0 0 22px 22px;"></div>

								<!-- вывод ошибок без использования ajax -->
								@error('text')
									<span style="display: block;font-size: 12px;color: red;text-align: center;width: 100%;">{{ $message }}</span>
								@enderror
								
								<div class="mar-top clearfix">
									<button class="btn btn-sm btn-primary pull-right" type="submit">
										<i class="fa fa-pencil fa-fw"></i> Добавить
									</button>
								</div>

							</form>

						</div>
					</div>

					<div id="check_add_html_ajax">
						@if(isset($comments))
							@foreach($comments as $comment)
								<div class="panel">
									<div class="panel-body">
										<div class="media-block" style="background-color: aliceblue;">
											<div class="media-body">
												<div class="mar-btm">
													<span href="#" class="btn-link text-semibold media-heading box-inline">
														{{ $comment->user->name }}
													</span>
													<p class="text-muted text-sm">{{ $comment->created_at }}</p>
												</div>
												<p>{{ $comment->text }}</p>
												<hr style="margin-bottom: 0">
											 </div>
										</div>
									</div>
								</div>
							@endforeach
						@endif
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection






@section('script_js')
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/styles/bootstrap4/popper.js"></script>
<script src="/styles/bootstrap4/bootstrap.min.js"></script>
<script src="/plugins/greensock/TweenMax.min.js"></script>
<script src="/plugins/greensock/TimelineMax.min.js"></script>
<script src="/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="/plugins/greensock/animation.gsap.min.js"></script>
<script src="/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="/plugins/easing/easing.js"></script>
<script src="/plugins/parallax-js-master/parallax.min.js"></script>
<script src="/js/product.js"></script>

<script type="text/javascript">
	$(function(){

		
		$('#form_comments').submit((e)=>{
			e.preventDefault();

			

			
	        let comment = $(this).find('textarea[name="text"]');
	        let comment_text = $(comment).val();



	        
	        




			$.ajax({
				url: "{{ Route('comment', ['slug' => $product->slug]) }}",
				type: 'POST',
				
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					text : comment_text,
				}, 
				
				success:(data)=>{
					console.log(data)
					
					
					comment.val('');

					
					$('form #errors').css({'display':'block','background-color':'#c3ffc5','color':'black','border-color':'#c3ffc5'}).text('Коментарий успешно добавлен !');

					
					$('#check_add_html_ajax').html(data); 
					

					
					setTimeout(function() {
						$('form #errors').css('display','none').text('');
					}, 5000);

				},

				
				error: function(data) {
  					console.log(data)
  					

  					
				   	if( data.status === 422 ) {
			            let message_errors = data.responseJSON.errors.text;
			            
			            $('form #errors').css({'display':'block','background-color':'#f8d7da','border-color':'#f8d7da'}).text(message_errors);   
			        }

			        
			        if (data.status === 401) {
			        	$('form #errors').css({'display':'block','background-color':'#f8d7da','border-color':'#f8d7da'}).text('Коментарии могут оставлять только аутентифицированные пользователи');  
			        }


			        
			        if (data.status === 500) {
			        	let message_errors = data.responseJSON.msg;
			            
			            $('form #errors').css({'display':'block','background-color':'#f8d7da','border-color':'#f8d7da'}).text(message_errors); 
			        }
  				}
			});
		})








		
		$('.button.cart_button').click(function(e){
			e.preventDefault();

			let count_product = $('#quantity_input').val();
			let id_product = "{{$product->id}}";


			let data_order = {
				'count' : count_product ,
				'id'    : id_product ,
				
			};
			

			$.ajax({
				url: "{{ Route('cart.addInCart') }}",
				type: 'POST',

				
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },

			    dataType: "json",

				contentType: "application/json",


			    
			    
			    
				data: JSON.stringify({ 
					count : data_order.count ,
					id    : data_order.id ,
				}),

				success:(data) => {
					console.log(data)

					if (data['status'] == 'succes'){

						
					
						
						let count_products_in_cart = $('#count_products_in_cart').text();
						count_products_in_cart = parseInt(count_products_in_cart);

						
						let quantity_input = $('#quantity_input').val();
						quantity_input = parseInt(quantity_input);

						$('#count_products_in_cart').html(count_products_in_cart + quantity_input);

						
						$(`.product_quantity.clearfix[data-response="${id_product}"]`).css('border','2px solid #d0d0d0');
						$(`.response_${id_product}`).removeClass( "alert alert-danger" ).text(''); 
					}

				},

				
				error: function(data) {
  					

			        
			        if (data.status === 403) {

			        	
						if (confirm("Для совершения покупок вы должны войти на сайт\nПерейти к странице входа ?")){
							window.location.href = "{{ Route('auth.login') }}"; 
						}
			        }

			        
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
  				}

			})
			
		})

	})
</script>


@endsection