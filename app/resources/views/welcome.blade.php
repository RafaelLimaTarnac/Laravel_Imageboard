@extends('subviews.placeholder')

@section('head')
    <title>Cool Ass Forum</title>
@endsection

@section('body')
    @if(!Auth::check())
        <a href='login'><button>Log in</button></a>
        <a href='register'><button>Register</button></a>
    @else
        @include('templates.form_error_check')
        <a href='dashboard'><button>Dashboard</button></a>
        <br><br>
		@can('isAdmin')
			@include('templates.create_topic_form')
		@endcan
        <br><br>
        @include('templates.create_post_form', ['topics'=>$topics])
    @endif
@endsection
