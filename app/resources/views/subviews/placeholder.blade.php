@php
use App\Models\Topic;

$topics = Topic::all();
@endphp
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		@yield('head')
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel='stylesheet' href='{{asset("css/style.css")}}'>
		<style>
			@yield('style')
		</style>
	</head>
	<body>
		<header>
		    @if(!Auth::check())
		        <a href='/login'><button>Log in</button></a>
		        <a href='/register'><button>Register</button></a>
		    @endif
			<a href='/'><button>Home</button></a>
			<a href='/dashboard'><button>Dashboard</button></a>
		</header>
		@include('templates.topics_header', ['topics'=>$topics])
		@yield('body')
	</body>
</html>