@php
use App\Models\User;
use App\Models\Topic;
use Illuminate\Support\Facades\Gate;

if(Gate::allows('isAdmin')){
	$queue = Topic::with("queued_posts")->where('name', $topic->name)->first();
	$queue = sizeof($queue->queued_posts);
}
@endphp

@extends('subviews.placeholder')

@section('head')
	<title>Posts Page</title>
@endsection

@section('style')
	td,tr,th{border: black solid 1px}
@endsection

@section('header_buttons')
	@can('isAdmin')
		<a href='{{URL("topic/" . $topic->name . "/queue")}}'><button style='color: green'>({{$queue}})Queue</button></a>
	@endcan
@endsection

@section('body')
	<h2 class='title_topic' style='text-align: center;'>/ {{$topic->name}} /</h2>
    @if(isset($motd))
    <h3 id='motd' style="text-align: center">{{$motd}}</h3>
    @endif

    @if(Auth::check())
    @include('templates.create_post_form')
    <br>
    @endif

    <a href='{{URL(url()->current() . "/catalog")}}'>Catalog</a>
    <a href='{{URL(url()->current() . "/archive")}}'>Archive</a>

    @if(isset($posts))
		@if(count($posts) > 0)
			@foreach($posts as $post)
				@include('templates.post', ['post'=>$post, 'limit'=>5])
			@endforeach
			<div>
				{{$posts->links('pagination::semantic-ui')}}
			</div>
		@else
			<h2>No posts</h2>
		@endif
	@endif
@endsection