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
			@yield('style')
		</style>
	</head>
	<body>
		@include('templates.topics_header', ['topics'=>$topics])
		<header>
			<button><a href='/'>Home</a></button>
		    @if(!Auth::check())
		        <button><a href='/login'>Log in</a></button>
		        <button><a href='/register'>Register</a></button>
		    @else
		    	<button><a href='{{URL("logout")}}' onclick='return confirm("Log Out\nAre you sure?")'>Log Out</a></button>
		    @endif
		    @can('isAdmin')
		    	<button><a href='/post_configs' class='admin_link'>Configure</a></button>
		    	<button><a href='/report_list' class='admin_link'>({{$reports}})Reports</a></button>
		    @endcan
		    @yield('header_buttons')
		</header>
		@yield('body')
	</body>
	<script src="{{asset('js/ReportForm.js')}}"></script>
	<script src="{{asset('js/ImageResize.js')}}"></script>
	@yield('scripts')
</html>