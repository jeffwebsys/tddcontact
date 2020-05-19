@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
<div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
<h1 class="font-bold text-white text-center text-3xl shadow-xs bg-gray-900 rounded-lg cursor-not-allowed"> JefDev.IO </h1>

<div class="text-center">
<h1 class="text-white text-3xl pt-8">Join Us</h1>
<h2 class="text-blue-300">Enter your Information Below</h2>
</div>
<form method="POST" action="{{ route('register') }}">
@csrf

<div class="relative pt-8">
<label for="name" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">Name</label>

<div>  
<input id="name" type="text" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="name" value="{{ old('name') }}" placeholder="Your Name" autofocus>

@error('name')
<span class="text-white text-sm" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="relative pt-2">
<label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">Email</label>

<div>
<input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="email" value="{{ old('email') }}" placeholder="Your Email">

@error('email')
<span class="text-white text-sm" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="relative pt-2">
<label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">Password</label>

<div class="col-md-6">
<input id="password" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="password" placeholder="Password">

@error('password')
<span class="text-white text-sm" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="relative pt-2">
<label for="password-confirm" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('Confirm Password') }}</label>

<div>
<input id="password-confirm" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="password_confirmation" placeholder="Confirm">
</div>
</div>

<div class="pt-3">
    <div>
        <button type="submit" class="w-full bg-gray-400 hover:bg-gray-800 hover:text-white py-2 px-3 text-left uppercase rounded text-blue-800 font-bold text-center">
            Register
        </button>
    </div>
</div>


<div class="flex justify-between pt-8 text-white text-sm font-bold">
<a class="" href=" {{ route('password.request') }}">
Forgot Your Password? 
</a>
<a class="" href=" {{ route('login') }}">
Login
</a>

</div>

</form>

</div>
</div>
@endsection
