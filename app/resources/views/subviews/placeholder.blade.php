@php
use App\Models\Topic;
use App\Models\Report;
use Illuminate\Support\Facades\Gate;

$topics = Topic::all();

if(Gate::allows('isAdmin')){
	$reports = Report::count();
}
@endphp
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		@yield('head')
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel='stylesheet' href='{{asset("css/style.css")}}'>
		<style>
			body{
				background-image: url({{asset('images/bg.jpg')}});
			}
			@yield('style')
		</style>
	</head>
	<body>
		@include('templates.topics_header', ['topics'=>$topics])
		<header>
			<a href='/'><button>Home</button></a>
			<a href='/dashboard'><button>Dashboard</button></a>
		    @if(!Auth::check())
		        <a href='/login'><button>Log in</button></a>
		        <a href='/register'><button>Register</button></a>
		    @endif
		    @can('isAdmin')
		    	<a href='/post_configs'><button style='color: green'>Configure</button></a>
		    	<a href='/report_list'><button style='color: green'>({{$reports}})Reports</button></a>
		    @endcan
		    @yield('header_buttons')
		</header>
		@yield('body')
	</body>
	<script src="{{asset('js/ReportForm.js')}}"></script>
	<script src="{{asset('js/ImageResize.js')}}"></script>
	@yield('scripts')
</html>