@extends('subviews.placeholder')

@section('head')
    <title>Cool Ass Forum</title>
@endsection

@section('body')
    @if(!Auth::check())
        <a href='login'><button>Log in</button></a>
        <a href='register'><button>Register</button></a>
    @else
        <a href='dashboard'><button>Dashboard</button></a>
    @endif
@endsection
