@php
use App\Models\Topic;

$topics = Topic::all();
@endphp
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		@yield('head')
		<style>
			img{height:80px;}
			@yield('style')
		</style>
	</head>
	<body>
		<a href='/dashboard'><button>Dashboard</button></a>
		<a href='/'><button>Home</button></a>
		@include('templates.topics_header', ['topics'=>$topics])
		@yield('body')
	</body>
</html>