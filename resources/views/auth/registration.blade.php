<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Sign up')

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_Sign_up','active')


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">



<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<style>
	


	.form-group{
	 	margin-bottom: 15px;
	}
	label{
	 	margin-bottom: 15px;
	}
	input,
	input::-webkit-input-placeholder {
	 	font-size: 11px;
	 	padding-top: 3px;
	}
	.form-control {
	 	height: auto!important;
		padding: 8px 12px !important;
	}
	.input-group {
	 	box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.21)!important;
	}
	#button {
		 border: 1px solid #ccc;
		 margin-top: 28px;
		 padding: 6px 12px;
		 color: #666;
		 text-shadow: 0 1px #fff;
		 cursor: pointer;
		 border-radius: 3px 3px;
		 box-shadow: 0 1px #fff inset, 0 1px #ddd;
		 background: #f5f5f5;
		 background: -moz-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f5f5f5), color-stop(100%, #eeeeee));
		 background: -webkit-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: -o-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: -ms-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5f5f5', endColorstr='#eeeeee', GradientType=0);
	}
	.main-form{
		margin-top: 30px;
		margin: 0 auto;
		max-width: 400px;
		padding: 10px 40px;
		background:#009edf;
		color: #FFF;
		text-shadow: none;
		box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
	}
	span.input-group-addon i {
	 	color: #009edf;
	 	font-size: 17px;
	}
	.login-button{
	 	margin-top: 5px;
	}
</style>
@endsection


@section('content')
<div class="cart_info" style="margin-top: 130px;padding-bottom: 50px;padding-top: 50px;z-index: 2;background: white;">

	<div class="container boot">
		<div class="row main-form">
			<!-- action - адрес куда отправляются данные ( в контроллер ) -->
			<form style="width: 100%;" method="post" action="{{ Route('auth.registration') }}">

				@csrf

				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">Your Name</label>
					<div class="cols-sm-10">
						<div class="input-group"  style="@error('name')border: 2px solid red;border-radius: 7px;box-shadow: 0px 0px 10px 3px red!important;@enderror">
							<!-- aria-hidden означает что элемент показывать необязательно. -->
							<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Enter your Name"/>
						</div>
						@error('name')
							<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">Your Surname</label>
					<div class="cols-sm-10">
						<div class="input-group" style="@error('surname')border: 2px solid red;border-radius: 7px;box-shadow: 0px 0px 10px 3px red!important;@enderror">
							<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" value="{{ old('surname') }}" name="surname" id="surname" placeholder="Enter your Surname"/>
						</div>
						@error('surname')
							<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label for="username" class="cols-sm-2 control-label">Login</label>
					<div class="cols-sm-10">
						<div class="input-group" style="@error('login')border: 2px solid red;border-radius: 7px;box-shadow: 0px 0px 10px 3px red!important;@enderror">
							<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" value="{{ old('login') }}" name="login" id="login" placeholder="Enter your Login"/>			
						</div>
						@error('login')
							<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="cols-sm-2 control-label">Your Email</label>
					<div class="cols-sm-10">
						<div class="input-group" style="@error('email')border: 2px solid red;border-radius: 7px;box-shadow: 0px 0px 10px 3px red!important;@enderror">
							<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" value="{{ old('email') }}" name="email" id="email" placeholder="Enter your Email"/>
						</div>
						@error('email')
							<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="cols-sm-2 control-label">Password</label>
					<div class="cols-sm-10">
						<div class="input-group" style="@error('password')border: 2px solid red;border-radius: 7px;box-shadow: 0px 0px 10px 3px red!important;@enderror">
							<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
							<input type="password" class="form-control" value="{{ old('password') }}" name="password" id="password" placeholder="Enter your Password"/>
						</div>
						@error('password')
							<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
							<!-- password_confirmation - сравниваемый пароль всегда должен быть прописан так -->
							<input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation" placeholder="Confirm your Password"/>
						</div>
					</div>
				</div>

				<div class="form-group ">
					<button type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button">Register</button>
					@error('formError')
						<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;">{{ $message }}</div>
					@enderror
				</div>

			</form>
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
<script src="js/custom.js"></script>
@endsection

