<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Categories')


<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_categories','active')

<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="/styles/bootstrap4/bootstrap.min.css">
<link href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/styles/categories.css">
<link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
<link rel="stylesheet" type="text/css" href="/styles/product.css">
<link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
@endsection

@section('content')

<!-- Home -->

<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url('{{$category->img_label??null}}')"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">{{$category->title??null}}<span>.</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="products" style="padding: 89px 0 0">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="products_title">{{$category->title??null}}</div>
			</div>
		</div>
	</div>
</div>



<!-- Category -->
<div class="products" style="padding-top: 0;">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="product_grid" style="display: flex;width: 100%;justify-content: center;">


					<!-- если поле img имеет не пустое значение то мы в пременную name_img запишем картинку а если поле img пустое то запишем путь к картинке заглушке -->

					@if(!empty($category->img))
						@php $name_img = $category->img; @endphp						
					@else
						@php $name_img = '/images/not_file.png'; @endphp
					@endif
							
					<!-- Category -->
					<style>
						#product_id{
							position: static!important;
						}
					</style>
					<div id="product_id" class="product">
						<div class="product_image" style="height: 250px;
														  overflow: hidden;
														  display: flex;
														  flex-direction: column;
														  justify-content: center;
														  ">
							<img src="{{$name_img}}" alt="" style=" object-fit: fill;
														            width: 100%;
														            max-height: 100%;">
						</div>						
					</div>
					<div class="product_content" style="padding-top: 0;
														text-indent: 30px;
														padding-left: 10px">
						<span>{{$category->description??null}}</span>
					</div>




				</div>
				
					
			</div>
		</div>
	</div>
</div>




<!-- Products -->

<div class="products">
	<div class="container">

		<div class="row">
			<div class="col text-center">
				<div class="products_title">Products</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				

				<!-- Product Sorting -->
				<div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">

					

					<div class="count_products" style="display: flex;flex-direction: column;">
						<div class="results">Total products <span>{{$products_from_category_count ?? 0}}</span></div>
						<div class="results">Showing <span>{{$products_from_category ? $products_from_category->count() : 0}}</span> results</div>
					</div>
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
									<span class="sorting_text">{{ $name_sort }}</span>
									<i class="fa fa-chevron-down" aria-hidden="true"></i>
									<ul>
										<!-- в названии дата атрибута недолжно быть заглавных букв -->
										<li  class="product_sorting_btn" data-sort='Default'>
											<span class="product_sorting_span">Default</span>
										</li>
										<li  class="product_sorting_btn" data-sort='Price-min'>
											<span class="product_sorting_span">Price min</span>
										</li>
										<li  class="product_sorting_btn" data-sort='Price-max'>
											<span class="product_sorting_span">Price max</span>
										</li>
										<li  class="product_sorting_btn" data-sort='A-z'>
											<span class="product_sorting_span">Name A-z</span>
										</li>
										<li class="product_sorting_btn" data-sort='Z-a'>
											<span class="product_sorting_span">Name Z-a</span>
										</li>
									</ul>									
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

					@if(is_object($products_from_category))
					<!-- вытаскиваем те продукты которые принадлежат выбранной категории -->
					@foreach($products_from_category as $product)

					<!-- наполняем переменную которую будем подставлять в тег img в атрибут src -->
					<?php  
						$name_img = '';
						if(count($product->images) > 0){
							
							$name_img = $product->images[0]->img;
						}else{
							
							$name_img = '/images/not_file.png';
						}
					?>

					<!-- Product -->
					<div class="product" style="height: 394px;">
						<div class="product_image" style="height: 250px;overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
							<img style="object-fit: fill;width: 100%;max-height: 100%;" src="{{$name_img}}" alt="">
						</div>
						<div class="product_extra product_new" style="width: 100px;">
							<a href="{{Route('showCategory',['slug'=>$product->categories->slug])}}">{{$category->title}}</a>
						</div>
						<div class="product_content">
							<div class="product_title" 
								 style="display: flex;
								 		justify-content: space-between;
								 		width: 100%;">
								<a href="{{Route('showProduct', ['slug' => $product->slug])}}">{{$product->title}}</a>
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

				<!-- проверяем является ли переменная products_from_category массивом или объектом если да то показываем пагинацию -->
				@if(is_object($products_from_category))

				<div id="pagination_link" style="display: flex;justify-content: center;width: 100%;">
					{{ $products_from_category->appends(request()->query())->links("pagination::bootstrap-4") }}
				</div>

				@endif

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
					<div class="icon_box_image"><img src="/images/icon_1.svg" alt=""></div>
					<div class="icon_box_title">Free Shipping Worldwide</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="/images/icon_2.svg" alt=""></div>
					<div class="icon_box_title">Free Returns</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="/images/icon_3.svg" alt=""></div>
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
<script src="/js/categories.js"></script>

<!-- cdn isotope -->
<script src="https:
<!-- cdn imageLoaded -->
<script src="https:

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
				id    : data_order.id ,
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

<!-- если переменная с продуктами от выбранной категории является объектом то даем возможность отправлять запросы на сервер -->
@if(is_object($products_from_category))

	<!-- СКРИПТ ДЛЯ ПАГИНАЦИИ AJAX -->
	<script type="text/javascript">
		$(function(){
			
			$(document).on('click', '.page-item a', function(e){
				e.preventDefault();

				
				let number_page = $(this).attr('href').split('page=')[1];
				

				
				let sortBy = $('.sorting_text').text();
				

				
				sortBy = $.trim(sortBy);

				
				if (sortBy == 'Sort by') {
					sortBy = 'Default';
				}
				
				
				
				
				
				
				
				
				

				
				
				sortBy = sortBy.replace(/^(Name )/, "");

				
				
				
				sortBy = sortBy.replace(/[\s]/g, "-");	
				

				$.ajax({
					
					url: "{{Route('showCategory',$category->slug)}}",

					
					type: "GET",

					
					data: {
						

						

						sortBy : sortBy,
						page   : number_page,
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
						

										
						
						
						newUrl += `sortBy=${sortBy}` + `&page=${number_page}`;

						
						
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






	<!-- СКРИПТ ДЛЯ СОРТИРОВКИ AJAX -->
	<script type="text/javascript">
		$(function(){

			
			$('.product_sorting_btn').click(function(){

				
				let sortBy = $(this).data('sort');
				

				
				let number_page = $('.page-item.active span').text();
				

				$.ajax({
					
					url: "{{Route('showCategory',$category->slug)}}",

					
					type: "GET",

					data: {
						

						

						sortBy: sortBy,
						page: number_page,
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
						
					

						
						
						newUrl += `sortBy=${sortBy}` + `&page=${number_page}`;
						
						
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
@endif
@endsection