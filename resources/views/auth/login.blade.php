@extends('layouts.app')

@section('title', 'Login')


@section('header')

<div class="pt-10 sm:mx-auto sm:w-full sm:max-w-sm">
  <a
    href="{{ '/' }}"
    class="text-center text-6xl font-bold text-gray-900">
    <h1>Barta</h1>
  </a>
  <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
    Sign in to your account
  </h1>
</div>

@endsection


@section('content')
<div class="flex min-h-full flex-col justify-center px-6 lg:px-8">

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <x-form :action="route('login')" buttonText="Sign in">
            <x-input name="email" type="email" label="Email address" placeholder="bruce@wayne.com" required />
            <x-input name="password" type="password" label="Password" placeholder="••••••••" required />
        </x-form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Don't have an account yet?
            <a href="{{ route('register') }}" class="font-semibold leading-6 text-black hover:text-black">Sign Up</a>
        </p>
    </div>
</div>
@endsection
