<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Home')

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_home','active')

<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">


 <!-- подключаем jquery -->
<!-- <script type="text/javascript" src="https:
@endsection

@section('content')

<!-- если переменная $products является объектом то покажем слайдер если переменная массив то не покажем ничего
массивом эта переменная может быть если будет отсутствовать таблица в бд под названием products  -->
@if(is_object($products))
	@if($products->count() > 0)
	<div class="home">
		<div class="home_slider_container">
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				@foreach($products as $product)

				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url('{{$product->img_label}}')"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title">{{$product->title}}</div>
										<div class="home_slider_subtitle">{{$product->announcement}}</div>
										<div class="button button_light home_button"><a href="{{Route('showProduct',['slug'=>$product->slug])}}">Show product</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				@endforeach
				
			</div>

			<!-- Home Slider Dots -->
			
			<div class="home_slider_dots_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_slider_dots">
								<ul id="home_slider_custom_dots" class="home_slider_custom_dots">
									@php 
										$i = 1;
									@endphp
									@foreach($products as $product)
									<li class="home_slider_custom_dot">0{{$i++}}.</li>
									@endforeach
									<script type="text/javascript">
										$(function(){
											
										    let number_slider = $('.home_slider_custom_dot'); 
										    $(number_slider[0]).attr('class','home_slider_custom_dot active');		
										})
									</script>
								</ul>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	@endif
@endif

<!-- Products -->

<div class="products">
	<div class="container">
		<div class="row">
			<div class="col">
				<style>
					li#lii{
						margin-left: 30px;
					}
				</style>

				<!-- если переменная $products является объектом то покажем слайдер если переменная массив то не покажем ничего массивом эта переменная может быть если будет отсутствовать таблица в бд под названием products  -->
				@if(is_object($products))

					<!-- выводим те картинки которые принадлежат определенному продукту -->
					@foreach($products as $value)
					
						<!-- если картинки есть то мы их выведем если нет то выведем сообщение -->
						@php 
							if (count($value->images) > 0) {
								echo"<ul>".($value->images[0]->id).') '."<br>";					
							}else{
								echo "Нет картинок";	
							}						
						@endphp
						 
						@foreach($value->images as $value)
							<?php echo"<li id='lii'>".($value->img)."</li>" ?>
						@endforeach

						<?php echo "</ul><hr>"; ?>
					@endforeach

					<br><br><br>

					<!-- так мы вывели первую картинку из всех для определенного товара -->
					@foreach($products as $value)
						<?php 
							
							if (count($value->images) > 0) {
								echo($value->images[0]->id).') '.($value->images[0]->img)."<br>";					
							}else{
								echo "Нет картинок"."<br>";		
							}						
						?>
					@endforeach


					<br><br><br>

					@if($products_count > 0)

					<div class="product_grid">

						<!-- СКРИПТ ДЛЯ ДОБАВЛЕНИЕ ПРОДУКТА В КОРЗИНУ -->
						<script type="text/javascript">
							function addItemInCart(id) {
								

			            		let count_product = '1';
								let id_product = id;


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
										id : data_order.id ,
									}),

									success:(data) => {
										console.log(data)

										if (data['status'] == 'succes'){

											
											
											let count_products_in_cart = $('#count_products_in_cart').text();
											count_products_in_cart = parseInt(count_products_in_cart);

											
											let quantity_input = 1;
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
								});
			
							}
						</script>

						@foreach($products as $product)

							<!-- наполняем переменную которую будем подставлять в тег img в атрибут src -->
							<?php  
								$name_img = '';
								if(count($product->images) > 0){
									
									$name_img = $product->images[0]->img;
								}else{
									
									$name_img = 'images/not_file.png';
								}
							?>


							<!-- Product -->
							<div class="product" style="height: 394px;">
								<div class="product_image" style="height: 250px;overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
									<img style="object-fit: fill;width: 100%;max-height: 100%;" src="{{$name_img}}" alt="">
								</div>
								<div class="product_extra product_new" style="width: 100px;">
									<a href="{{Route('showCategory',['slug'=>$product->categories->slug])}}">{{$product->categories->title}}</a>
								</div>
								<div class="product_content">
									<div class="product_title" 
										 style="display: flex;
										 		justify-content: space-between;
										 		width: 100%;">
										<a href="{{Route('showProduct', ['slug' => $product->slug])}}">{{$product->title}}</a>
										<!-- когда данные подгружаются ajax нужно в элементе который нужно отследить прописать атрибут onclick и поместить в него функцию которая будет добавлять нужный продукт в корзину -->
										<div class="addCart" onclick="addItemInCart('{{$product->id}}')">
											<i class="far fa-plus-square" 
											   style="display: block;
											   		  font-size: 20px;
											   		  color: green;
											   		  cursor: pointer; ">		  	
											</i>
										</div>
										<!-- для вывода ошибок -->
										<div data-error class="response_{{ $product->id }}" style="position: absolute;width: 100%;left: 0;border-radius: 0;top: 230%;"></div>
									</div>

									<!-- для отображения скидок и стандартной цены -->
									@if(!isset($product->new_price))
										<div class="product_price">${{$product->price}}</div>
									@else
										<style>
											.details_discount{
												display: inline-block;
											    font-size: 16px;
											    font-weight: 500;
											    color: #e95a5a;
											    margin-right: 20px;
											    text-decoration: line-through;
											}
										</style>	
										<div class="details_discount">${{$product->price}}</div>
										<div class="product_price">${{$product->new_price}}</div>
									@endif

								</div>
							</div>
				
						@endforeach

					</div> <!-- end product_grid -->

					@else

					<h2 style="display: block;margin-top: 50px;margin-bottom: 80px;width: 100%;text-align: center;">
	    				В магазине пока что нет продуктов !
	    			</h2>

					@endif <!-- $products_count > 0 -->

				@else
				<h2 style="display: block;margin-top: 100px;width: 100%;text-align: center;">
    				{{ $products }}
    			</h2>
				@endif <!-- is_object($products) -->
	
			</div>
		</div>
	</div>
</div>

<!-- Icon Boxes -->

<div class="icon_boxes">
	<div class="container">
		<div class="row icon_box_row">
			
			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
					<div class="icon_box_title">Free Shipping Worldwide</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
					<div class="icon_box_title">Free Returns</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
					<div class="icon_box_title">24h Fast Support</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Newsletter -->

<div class="newsletter">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="newsletter_border"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="newsletter_content text-center">
					<div class="newsletter_title">Subscribe to our newsletter</div>
					<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
					<div class="newsletter_form_container">
						<form action="#" id="newsletter_form" class="newsletter_form">
							<input type="email" class="newsletter_input" required="required">
							<button class="newsletter_button trans_200"><span>Subscribe</span></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
@endsection