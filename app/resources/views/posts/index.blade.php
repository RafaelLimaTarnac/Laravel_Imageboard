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

@section('header_buttons')
	@can('isAdmin')
		<button><a href='{{URL("topic/" . $topic->name . "/queue")}}' class='admin_link'>({{$queue}})Queue</a></button>
	@endcan
@endsection

@section('body')
	<span class='topic_title'>
	<h2 class='title_topic' style='text-align: center;'>/ {{$topic->name}} / - {{$topic->category}}</h2>
    @if(isset($motd))
    <p id='motd' style="text-align: center">{{$motd}}</p>
	</span>
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
				@include('templates.post', ['post'=>$post, 'limit'=>5, 'limit_content'=>500])
			@endforeach
			<div>
				{{$posts->links('pagination::semantic-ui')}}
			</div>
		@else
			<h2>No posts</h2>
		@endif
	@endif
@endsection