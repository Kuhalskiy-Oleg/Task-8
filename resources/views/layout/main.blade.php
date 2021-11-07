<!DOCTYPE html>
<html lang="en">
<head>
<!-- в title у нас будет подгружаться значение section котрая будет называться title а второй параметр и будет значение т.е название страницы section('title','Home') -->
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('head_link')



 <!-- подключаем jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

</head>
<body>

<div class="super_container">

	<!-- Header -->
	<!-- include - встроенная функция в larawel с помощью нее можно подгрузить в файл другие файлы -->
	@include('layout.header')
	
	<!-- Menu -->
	@include('layout.menu')
	
	<!-- Content -->
	@yield('content')

	<!-- Footer -->
	@include('layout.footer')
	
</div>

<!-- cюда будут подключатся теги со скриптами js -->
@yield('script_js')

<!-- подключаем иконски с сайта font awesom -->
<script type="text/javascript" src="https://kit.fontawesome.com/441e03a245.js" crossorigin="anonymous"></script>



</body>
</html>