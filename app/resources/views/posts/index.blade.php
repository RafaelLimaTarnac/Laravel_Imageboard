@php
use App\Models\User;
@endphp

@extends('subviews.placeholder')

@section('head')
	<title>Posts Page</title>
@endsection

@section('style')
	td,tr,th{border: black solid 1px}
@endsection

@section('body')

    @if(Auth::check())
    @include('templates.create_post_form')
    <br>
    @endif

    <a href='{{URL(url()->current() . "/catalog")}}'>Catalog</a>
    @if(count($pinned) > 0)
		@foreach($pinned as $post)
			@include('templates.post', ['post'=>$post, 'limit'=>5])
		@endforeach
    @endif

	@if(count($posts) > 0)
		@foreach($posts as $post)
			@include('templates.post', ['post'=>$post, 'limit'=>5])
		@endforeach
	@else
		<h2>No posts</h2>
	@endif
@endsection