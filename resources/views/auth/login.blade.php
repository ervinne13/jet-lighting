@extends('layouts.base')

@section('css')

<link href="font-awesome/css/font-awesome.css" rel="stylesheet">

<!-- <link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet"> -->

@endsection

@section('bodyClass', 'gray-bg')

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">Jet</h1>
        </div>
        <h3>Jet Lighting Operations</h3>
        </p>
        <p>Login in to your account.</p>
        <form method="POST" action="{{ route('login') }}" class="m-t" role="form">
            @csrf
            <div class="form-group">
                <input name="username" value="{{old('username')}}"
                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                    type="text" placeholder="Username" required=""
                >

                @if ($errors->has('username'))
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input name="password"                    
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    type="password" placeholder="Password" required=""
                >
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="#"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">Request Admin for an account</a>
        </form>        
    </div>
</div>

@endsection