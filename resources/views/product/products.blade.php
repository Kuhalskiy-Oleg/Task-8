<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Products')

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_home','active')


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/categories.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">

@endsection

@section('content')
	
	<!-- Home -->

	<!-- если переменная $categories является объектом то покажем слайдер если переменная массив то не покажем ничего
	массивом эта переменная может быть если будет отсутствовать таблица в бд под названием categories то тогда в провайдере
	запишется в эту переменную ассоциативный массив с ошибкой -->
	@if(is_object($categories))
		@if($categories->count() > 0)
		<div class="home" style="height: 655px;padding: 0;">
			<div class="home_slider_container">
			
				<!-- Home Slider -->
				<div class="owl-carousel owl-theme home_slider">

					@foreach($categories as $category)
					
					<!-- Slider Item -->
					<div class="owl-item home_slider_item">
						<div class="home_slider_background" style="background-image:url('{{$category->img_label}}')"></div>
						<div class="home_slider_content_container" style="top: 10%;">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
											<div class="home_slider_title">{{$category->title}}</div>
											<div class="home_slider_subtitle">{{$category->announcement}}</div>
											<div class="button button_light home_button"><a href="{{Route('showCategory',['slug'=>$category->slug])}}">Show category</a></div>
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

										@foreach($categories as $category)
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
	<div class="products" style="padding-top: 122px;">
		<div class="container">

			<div class="row">
				<div class="col text-center">
					<div class="products_title">Products</div>
				</div>
			</div>

			<!-- если переменная $products является объектом то покажем слайдер если переменная массив то не покажем ничего массивом эта переменная может быть если будет отсутствовать таблица в бд под названием products  -->
			@if(is_object($products))

				<div class="row">
					<div class="col">
						
						<!-- Product Sorting -->
						<div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">

							<div class="count_products" style="display: flex;flex-direction: column;">
								<div class="results">Total products <span>{{$products_count_all}}</span></div>
								<div class="results">Showing <span>{{$products->count()}}</span> results</div>
							</div>

							<!-- sortBy -->
							<div class="sorting_container ml-md-auto">
								<div class="sorting">
									<ul class="item_sorting">
										<li>

											<!-- делаем переименовывание значение sortBy для красивого отображения в панели с выбором сортировки -->
											<?php  
												$name_sort = $_GET['sortBy'] ?? 'Sort by';
												
												switch ($name_sort) {

													case 'Price-min':
														$name_sort = 'Price min';
														break;

													case 'Price-max':
														$name_sort = 'Price max';
														break;

													case 'A-z':
														$name_sort = 'Name A-z';
														break;

													case 'Z-a':
														$name_sort = 'Name Z-a';
														break;	
												}
		 
											?> 
											<!-- хоть в поисковой строке и не показывается параметра sortBy и page но они там есть просто скрыты методом appends(request()->query()) -->
											<span data-span_sort="sortBy" class="sorting_text">{{ $name_sort }}</span>
											<i class="fa fa-chevron-down" aria-hidden="true"></i>
											<ul id="sortBy">
												<!-- в названии дата атрибута недолжно быть заглавных букв -->
												<li  class="product_sorting_btn" data-sort='Default'>
													<span  class="product_sorting_span">Default</span>
												</li>
												<li  class="product_sorting_btn" data-sort='Price-min'>
													<span  class="product_sorting_span">Price min</span>
												</li>
												<li  class="product_sorting_btn" data-sort='Price-max'>
													<span  class="product_sorting_span">Price max</span>
												</li>
												<li  class="product_sorting_btn" data-sort='A-z'>
													<span  class="product_sorting_span">Name A-z</span>
												</li>
												<li class="product_sorting_btn" data-sort='Z-a'>
													<span  class="product_sorting_span">Name Z-a</span>
												</li>
											</ul>
											<!-- скрипт для выведения текста в фильтрующий блок при клике на сорт.элемент -->
											<script type="text/javascript">
												$(function(){
													$('#sortBy .product_sorting_span').click(function(){
														
														let value_span = $(this).text();
														$("span[data-span_sort='sortBy']").html(value_span);
													});
												});
											</script>
										</li>
									</ul>
								</div>
							</div>

							<!-- filterBy -->
							<div class="sorting_container ml-md-auto">
								<div class="sorting">
									<ul class="item_sorting">
										<li>

											<!-- делаем переименовывание значение sortBy для красивого отображения в панели с выбором сортировки , чтобы при перезагрузки страницы туда парсилось значение из переменной $name_filtr -->
											<?php  
												$name_filtr = $_GET['filterBy'] ?? 'Filter by';
												
												switch ($name_filtr) {

													case 'somputer':
														$name_filtr = 'Computer';
														break;

													case 'telephone':
														$name_filtr = 'Telephone';
														break;

													case 'laptop':
														$name_filtr = 'Laptop';
														break;
	
												}
		 
											?> 
											<!-- в атрибут value при перезагрузки страницы будет парсится значение slug от выбранной категории чтобы при использовании пагинации или сортировки они могли взять значение из этого атрибута и фильтрация не собъется -->
											<span data-span_sort="filterBy" value="{{$_GET['filterBy'] ?? 'Default'}}" class="sorting_text">{{ $name_filtr }}</span>

											<i class="fa fa-chevron-down" aria-hidden="true"></i>

											<ul id="filterBy">

												<!-- в названии дата атрибута недолжно быть заглавных букв -->
												<li  class="product_sorting_btn" data-sort='Default'>
													<span class="product_sorting_span">Default</span>
												</li>

												@foreach($categories as $category)
													<li  class="product_sorting_btn" data-sort='{{ $category->slug }}'>
														<span class="product_sorting_span">{{ $category->title }}</span>
													</li>
												@endforeach
												
											</ul>

											<!-- скрипт для выведения текста в фильтрующий блок при клике на фильтр.элемент -->
											<script type="text/javascript">
												$(function(){
													
													$('#filterBy .product_sorting_span').click(function(){
														
														let value_span = $(this).text();
														$("span[data-span_sort='filterBy']").html(value_span);
													});

													
													$('#filterBy .product_sorting_btn').click(function(){
														
														let value_span = $(this).data('sort');
														$("span[data-span_sort='filterBy']").attr('value' , value_span);
													});
												});
											</script>

										</li>
									</ul>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="row">

					

					<div id="products_and_pagination" class="col">

						
						
						<div class="product_grid">

							<!-- проверяем является ли переменная products массивом или объектом если да то запускаем цикл -->
							@if(is_object($products))
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
											<!-- когда данные подгружаются ajaxom нужно в элементе который нужно отследить прописать атрибут onclick и поместить в него функцию которая будет добавлять нужный продукт в корзину -->
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
										
										@if(!isset($product->new_price))
											<div class="product_price">${{$product->price}}</div>
										@else
											<div class="details_discount">${{$product->price}}</div>
											<div class="product_price">${{$product->new_price}}</div>
										@endif

									</div>
								</div>

								@endforeach
							@endif

						</div>

						<!-- проверяем является ли переменная products массивом или объектом если да то показываем пагинацию -->
						@if($products->count() > 0)

							{{ $products->appends(request()->query())->links("pagination.pagination_products") }}

						@endif
						<script type="text/javascript">
							$(function(){
								$('a[data-paginate]').click(function(){
									
									
									
									
								})
							})
						</script>

					</div>
				</div>

			@else
			<h2 style="display: block;margin-top: 50px;margin-bottom: 60px;width: 100%;text-align: center;">
				{{ $products }}
			</h2>
			@endif <!-- is_object($products) -->
			
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
<script src="js/product.js"></script>
<script src="js/custom.js"></script>
<!-- <script src="js/categories.js"></script> -->

<!-- cdn isotope -->
<script src="https:
<!-- cdn imageLoaded -->
<script src="https:





<!-- СКРИПТ ДЛЯ ПАГИНАЦИИ AJAX -->
<script type="text/javascript">

	$(function(){

		
		$(document).on('click', '.pagination li a', function(e){
			e.preventDefault();

			
			let number_page = $(this).attr('href').split('page=')[1];
			

			
			let filterBy = $("span[data-span_sort='filterBy']").attr('value');
			

			
			let sortBy = $("span[data-span_sort='sortBy']").text();
			

			
			filterBy = $.trim(filterBy);
			sortBy = $.trim(sortBy);

			
			if (filterBy == ''){
				filterBy = 'Default';
			}
			


			
			if (sortBy == 'Sort by') {
				sortBy = 'Default';
			}
			
			
			
			
			
			
			
			
			

			
			
			sortBy = sortBy.replace(/^(Name )/, "");

			
			
			
			sortBy = sortBy.replace(/[\s]/g, "-");	
			

			$.ajax({
				
				url: "{{Route('products')}}",

				
				type: "GET",

				
				data: {
					

					
					filterBy : filterBy,
					sortBy   : sortBy,
					page     : number_page,
				},

				dataType: "html",

				contentType: "text",

				
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },

			    
				success: function(data){
					
					


					


	
					

					
					let positionParametersUrl = location.pathname.indexOf('?');
					
					let url = location.pathname.substring(positionParametersUrl,location.pathname.length);
					
					let newUrl = url + '?' ;
					

									
					
					
					newUrl += `filterBy=${filterBy}` + `&sortBy=${sortBy}` + `&page=${number_page}`;

					
					
					history.pushState({}, '', newUrl);
	


					
					$('#products_and_pagination').html(data);

					
					$('.product_grid').isotope({
						itemSelector: '.product',
					});

					
					$('.product_grid').imagesLoaded( function(){
						var grid = $('.product_grid').isotope({
							itemSelector: '.product',
							layoutMode: 'fitRows',
							fitRows:{
								gutter: 30
							}
						});
						
					});
				}
			});
		});
	});
</script>




<!-- CКРИПТ ДЛЯ СОРТИРОВКИ AJAX -->
<script type="text/javascript">
	$(function(){

		
		$('#sortBy .product_sorting_btn').click(function(){

			
			let number_page = $('.pagination li.active span').text();
			

			
			let sortBy = $(this).data('sort');
			

			
			
			let filterBy = $("span[data-span_sort='filterBy']").attr('value');
			

			
			sortBy = $.trim(sortBy);
			filterBy = $.trim(filterBy);

			
			if (filterBy == ''){
				filterBy = 'Default';
			}
			
			


			$.ajax({
				
				url: "{{Route('products')}}",

				
				type: "GET",

				
				data: {
					

					
					filterBy : filterBy,
					sortBy   : sortBy,
					page     : number_page,
				},

				dataType: "html",

				contentType: "text",

				
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },

			    
				success: function(data){
					



					


					

					
					let positionParametersUrl = location.pathname.indexOf('?');
					
					let url = location.pathname.substring(positionParametersUrl,location.pathname.length);
					
					let newUrl = url + '?' ;
					

					
					
					newUrl += `filterBy=${filterBy}` + `&sortBy=${sortBy}` + `&page=${number_page}`;
					
					
					history.pushState({}, '', newUrl);



					

					
					let link_paginate_custom = $('a[data-paginate]');
					
				    if (link_paginate_custom.length > 0) {

				        
				        for (let index = 0; link_paginate_custom.length > index; index++ ){

				        	
				            
				            let link_paginate_custom_element = link_paginate_custom[index];
				            

				            
				            let href_paginate_custom = $(link_paginate_custom_element).attr('href');
				            
				   			
				   			
	
				            
				            
							let last_href_paginate_custom = href_paginate_custom.split(/[$?&]/).pop();
							

							
							let url_plus = url + '?' ;
							

							
							
							
							let new_href_link_paginate_custom = url_plus    +
																'filterBy=' + 
																filterBy    +  
																'&sortBy='  +
																sortBy      + 
																'&'         +
																last_href_paginate_custom;
							


							
							new_href_link_paginate_custom = Array.from(new Set(new_href_link_paginate_custom.split(/[&?=]/)));
							

							
							let oneWord   = new_href_link_paginate_custom[0] + '?' ; 
							let twoWord   = new_href_link_paginate_custom[1] + '=' ; 
							let threeWord = new_href_link_paginate_custom[2] + '&' ; 
							let fourWord  = new_href_link_paginate_custom[3] + '=' ; 
							let fiveWord  = new_href_link_paginate_custom[4] + '&' ; 
							let sixWord   = new_href_link_paginate_custom[5] + '=' ; 
							let sevenWord = new_href_link_paginate_custom[6]; 
							
							
							
							
							
							
							


							let list = [];
							
							list.push(oneWord, twoWord, threeWord, fourWord, fiveWord, sixWord, sevenWord );   
							

							
							new_href_link_paginate_custom = list.join('');											
							


							
							$(link_paginate_custom_element).attr('href',new_href_link_paginate_custom);
							
				        }
 
				    }
					


					


					
					$('#products_and_pagination').html(data);

					
					$('.product_grid').isotope({
						itemSelector: '.product',
					});

					
					$('.product_grid').imagesLoaded( function(){
						var grid = $('.product_grid').isotope({
							itemSelector: '.product',
							layoutMode: 'fitRows',
							fitRows:{
								gutter: 30
							}
						});						
					});
				}
			});			
		});	
	});
</script>




<!-- CКРИПТ ДЛЯ ФИЛЬТРАЦИИ AJAX по категориям -->
<script type="text/javascript">
	$(function(){

		
		$('#filterBy .product_sorting_btn').click(function(){


			
			let number_page = $('.pagination li.active span').text();
			

			
			let filterBy = $(this).data('sort');
			

			
			let sortBy = $("span[data-span_sort='sortBy']").text();
			

			
			sortBy = $.trim(sortBy);
			filterBy = $.trim(filterBy);

			
			if (filterBy == 'Filter by') {
				filterBy = 'Default';
			}

			
			if (sortBy == 'Sort by') {
				sortBy = 'Default';
			}
			
			
			
			
			
			
			
			
			

			
			
			sortBy = sortBy.replace(/^(Name )/, "");

			
			
			
			sortBy = sortBy.replace(/[\s]/g, "-");	
			


			$.ajax({
				
				url: "{{Route('products')}}",

				
				type: "GET",

				
				data: {
					

					
					sortBy   : sortBy,
					filterBy : filterBy,
					page     : number_page,
				},

				dataType: "html",

				contentType: "text",

				
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },

			    
				success: function(data){
					



					


					

					
					let positionParametersUrl = location.pathname.indexOf('?');
					
					let url = location.pathname.substring(positionParametersUrl,location.pathname.length);
					
					let newUrl = url + '?' ;
					

					
					
					newUrl += `filterBy=${filterBy}` + `&sortBy=${sortBy}` + `&page=${number_page}`;
					
					
					history.pushState({}, '', newUrl);



					

					
					let link_paginate_custom = $('a[data-paginate]');

					
				    if (link_paginate_custom.length > 0) {

				        
				        for (let index = 0; link_paginate_custom.length > index; index++ ){

				        	
				            
				            let link_paginate_custom_element = link_paginate_custom[index];
				            

				            
				            let href_paginate_custom = $(link_paginate_custom_element).attr('href');
				            
	
				            
				            
							let last_href_paginate_custom = href_paginate_custom.split(/[$?&]/).pop();
							

							
							let url_plus = url + '?' ;
							

							
							let new_href_link_paginate_custom = url_plus    +
																'filterBy=' + 
																filterBy    +  
																'&sortBy='  +
																sortBy      + 
																'&'         +
																last_href_paginate_custom;
							


							
							new_href_link_paginate_custom = Array.from(new Set(new_href_link_paginate_custom.split(/[&?=]/)));
							

							
							let oneWord   = new_href_link_paginate_custom[0] + '?' ; 
							let twoWord   = new_href_link_paginate_custom[1] + '=' ; 
							let threeWord = new_href_link_paginate_custom[2] + '&' ; 
							let fourWord  = new_href_link_paginate_custom[3] + '=' ; 
							let fiveWord  = new_href_link_paginate_custom[4] + '&' ; 
							let sixWord   = new_href_link_paginate_custom[5] + '=' ; 
							let sevenWord = new_href_link_paginate_custom[6]; 
							
							
							
							
							
							
							


							let list = [];
							
							list.push(oneWord, twoWord, threeWord, fourWord, fiveWord, sixWord, sevenWord ); 
							

							
							new_href_link_paginate_custom = list.join('');											
							


							
							$(link_paginate_custom_element).attr('href',new_href_link_paginate_custom);
							
				        }
 
				    }
					


					


					
					$('#products_and_pagination').html(data);

					
					$('.product_grid').isotope({
						itemSelector: '.product',
					});

					
					$('.product_grid').imagesLoaded( function(){
						var grid = $('.product_grid').isotope({
							itemSelector: '.product',
							layoutMode: 'fitRows',
							fitRows:{
								gutter: 30
							}
						});						
					});
				}
			});			
		});	
	});
</script>



<!-- СКРИПТ ДЛЯ ДОБАВЛЕНИЯ ПРОДУКТА В КОРЗИНУ при клике на тег с атрибутом onclick -->
<script type="text/javascript">
	function addItemInCart(id) {
		
		let count_product = 1;
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
				id    : data_order.id    ,
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

		            	
		            	$.each(data, function(index, value) {
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


@endsection