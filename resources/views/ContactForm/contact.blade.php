<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Contact')

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_contact','active')


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
@endsection

@section('content')

<!-- Home -->

<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url(images/contact.jpg)"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{Route('index')}}">Home</a></li>
									<li>Contact</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Contact -->

<div class="contact">
	<div class="container">
		<div class="row">

			<!-- Get in touch -->
			<div class="col-lg-8 contact_col">
				<div class="get_in_touch">
					<div class="section_title">Get in Touch</div>
					<div class="section_subtitle">Say hello</div>
					<div class="contact_form_container">

						<!-- ContactForm -->
						<form action="{{ Route('contactForm') }}" method="POST" id="contact_form" class="contact_form">

							@csrf

							<div class="row">

								<!-- Name -->
								<div class="col-xl-6">								
									<label for="contact_name">Your Name</label>
									<input name="name" type="text" value="{{ old('name') }}" id="contact_name" class="contact_input" style="@error('name')border:3px solid #f8d7da;@enderror">

									@error('name')
										<div class="alert alert-danger" style="margin-top: -2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
									@enderror
								</div>

								<!-- Surname -->
								<div class="col-xl-6 last_name_col">								
									<label for="contact_last_name">Your Surname</label>
									<input name="surname" type="text" value="{{ old('surname') }}" id="contact_last_name" class="contact_input" style="@error('surname')border:3px solid #f8d7da;@enderror">

									@error('surname')
										<div class="alert alert-danger" style="margin-top: -2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
									@enderror
								</div>

							</div>

							<!-- email -->
							<div>		
								<label for="contact_company">Your email</label>
								<input name="email" type="text" value="{{ old('email') }}" id="contact_company" class="contact_input" style="@error('email')border:3px solid #f8d7da;@enderror">

								@error('email')
									<div class="alert alert-danger" style="margin-top: -2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
								@enderror
							</div>

							<!-- text -->
							<div>
								<label for="contact_textarea">Message</label>
								<textarea name="text" id="contact_textarea" class="contact_input contact_textarea" style="margin-bottom: -7px;text-align: left;@error('email')border:3px solid #f8d7da;@enderror">
									{{ old('text') }}
								</textarea>

								@error('text')
									<div class="alert alert-danger" style="margin-top: -2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
								@enderror
							</div>

							<button class="button contact_button"><span>Send Message</span></button>

							@error('status_error')
								<div class="alert alert-danger" style="margin-top: 15px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
							@enderror

							@error('status_succes')
								<div class="alert alert-danger" style="background: #d7f8db;color: black;border: none;margin-top: 15px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
							@enderror

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
<script src="plugins/easing/easing.js"></script>
<script src="js/contact.js"></script>
@endsection

