<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Home')

<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
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
									<li><a href="{{Route('cart.view')}}">Shopping Cart</a></li>
									<li>Checkout</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Checkout -->

<div class="checkout">
	<div class="container">
		<div class="row">

			<!-- Billing Info -->
			<div class="col-lg-6">
				<div class="billing checkout_section">
					<div class="section_title">Billing Address</div>
					<div class="section_subtitle">Enter your address info</div>
					<div class="checkout_form_container">
						<form action="#" id="checkout_form" class="checkout_form">
							<div class="row">
								<div class="col-xl-6">
									<!-- Name -->
									<label for="checkout_name">First Name*</label>
									<input type="text" id="checkout_name" class="checkout_input" required="required">
								</div>
								<div class="col-xl-6 last_name_col">
									<!-- Last Name -->
									<label for="checkout_last_name">Last Name*</label>
									<input type="text" id="checkout_last_name" class="checkout_input" required="required">
								</div>
							</div>
							<div>
								<!-- Company -->
								<label for="checkout_company">Company</label>
								<input type="text" id="checkout_company" class="checkout_input">
							</div>
							<div>
								<!-- Country -->
								<label for="checkout_country">Country*</label>
								<select name="checkout_country" id="checkout_country" class="dropdown_item_select checkout_input" require="required">
									<option></option>
									<option>Lithuania</option>
									<option>Sweden</option>
									<option>UK</option>
									<option>Italy</option>
								</select>
							</div>
							<div>
								<!-- Address -->
								<label for="checkout_address">Address*</label>
								<input type="text" id="checkout_address" class="checkout_input" required="required">
								<input type="text" id="checkout_address_2" class="checkout_input checkout_address_2" required="required">
							</div>
							<div>
								<!-- Zipcode -->
								<label for="checkout_zipcode">Zipcode*</label>
								<input type="text" id="checkout_zipcode" class="checkout_input" required="required">
							</div>
							<div>
								<!-- City / Town -->
								<label for="checkout_city">City/Town*</label>
								<select name="checkout_city" id="checkout_city" class="dropdown_item_select checkout_input" require="required">
									<option></option>
									<option>City</option>
									<option>City</option>
									<option>City</option>
									<option>City</option>
								</select>
							</div>
							<div>
								<!-- Province -->
								<label for="checkout_province">Province*</label>
								<select name="checkout_province" id="checkout_province" class="dropdown_item_select checkout_input" require="required">
									<option></option>
									<option>Province</option>
									<option>Province</option>
									<option>Province</option>
									<option>Province</option>
								</select>
							</div>
							<div>
								<!-- Phone no -->
								<label for="checkout_phone">Phone no*</label>
								<input type="phone" id="checkout_phone" class="checkout_input" required="required">
							</div>
							<div>
								<!-- Email -->
								<label for="checkout_email">Email Address*</label>
								<input type="phone" id="checkout_email" class="checkout_input" required="required">
							</div>
							<div class="checkout_extra">
								<div>
									<input type="checkbox" id="checkbox_terms" name="regular_checkbox" class="regular_checkbox" checked="checked">
									<label for="checkbox_terms"><img src="images/check.png" alt=""></label>
									<span class="checkbox_title">Terms and conditions</span>
								</div>
								<div>
									<input type="checkbox" id="checkbox_account" name="regular_checkbox" class="regular_checkbox">
									<label for="checkbox_account"><img src="images/check.png" alt=""></label>
									<span class="checkbox_title">Create an account</span>
								</div>
								<div>
									<input type="checkbox" id="checkbox_newsletter" name="regular_checkbox" class="regular_checkbox">
									<label for="checkbox_newsletter"><img src="images/check.png" alt=""></label>
									<span class="checkbox_title">Subscribe to our newsletter</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Order Info -->

			<div class="col-lg-6">
				<div class="order checkout_section">
					<div class="section_title">Your order</div>
					<div class="section_subtitle">Order details</div>

					<!-- Order details -->
					<div class="order_list_container">
						<div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
							<div class="order_list_title">Product</div>
							<div class="order_list_value ml-auto">Total</div>
						</div>
						<ul class="order_list">
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="order_list_title">Cocktail Yellow dress</div>
								<div class="order_list_value ml-auto">$59.90</div>
							</li>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="order_list_title">Subtotal</div>
								<div class="order_list_value ml-auto">$59.90</div>
							</li>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="order_list_title">Shipping</div>
								<div class="order_list_value ml-auto">Free</div>
							</li>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="order_list_title">Total</div>
								<div class="order_list_value ml-auto">$59.90</div>
							</li>
						</ul>
					</div>

					<!-- Payment Options -->
					<div class="payment">
						<div class="payment_options">
							<label class="payment_option clearfix">Paypal
								<input type="radio" name="radio">
								<span class="checkmark"></span>
							</label>
							<label class="payment_option clearfix">Cach on delivery
								<input type="radio" name="radio">
								<span class="checkmark"></span>
							</label>
							<label class="payment_option clearfix">Credit card
								<input type="radio" name="radio">
								<span class="checkmark"></span>
							</label>
							<label class="payment_option clearfix">Direct bank transfer
								<input type="radio" checked="checked" name="radio">
								<span class="checkmark"></span>
							</label>
						</div>
					</div>

					<!-- Order Text -->
					<div class="order_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra temp or so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</div>
					<div class="button order_button"><a href="#">Place Order</a></div>
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
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/checkout.js"></script>
@endsection


