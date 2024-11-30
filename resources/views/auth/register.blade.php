@extends('layouts.app')

@section('title', 'Register')

@section('header')

<div class=" pt-10 sm:mx-auto sm:w-full sm:max-w-sm">
  <a
    href="{{ '/' }}"
    class="text-center text-6xl font-bold text-gray-900">
    <h1>Barta</h1>
  </a>
  <h1
    class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
    Create a new account
  </h1>
</div>

@endsection


@section('content')
<div class="flex min-h-full flex-col justify-center pb-10 px-6 lg:px-8">
  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <x-form :action="route('register')" buttonText="Register" enctype="multipart/form-data" class="grid grid-cols- gap-x-6 gap-y-2 sm:grid-cols-6">
      <div class="sm:col-span-3">
        <x-input name="fname" type="text" label="First Name" placeholder="Alp" required />
      </div>
      <div class="sm:col-span-3">
        <x-input name="lname" type="text" label="Last Name" placeholder="Arslan" required />
      </div>
      <div class="col-span-full">
        <x-input name="email" type="email" label="Email Address" placeholder="alp.arslan@mail.com" required />
      </div>
      <div class="col-span-full">
        <x-input name="phone" type="text" label="Phone Number" placeholder="+8801234567890, 01234567890" />
      </div>
      <div class="col-span-full">
        <x-input name="pro_pic" type="file" label="Profile Picture" />
      </div>
      <div class="sm:col-span-3">
        <x-input name="password" type="password" label="Password" placeholder="••••••••" required />
      </div>
      <div class="sm:col-span-3">
        <x-input name="password_confirmation" type="password" label="Confirm Password" placeholder="••••••••" required />
      </div>
    </x-form>

    <p class="mt-10 text-center text-sm text-gray-500">
        Already a member?
        <a href="{{ route('login') }}" class="font-semibold leading-6 text-black hover:text-black">Sign In</a>
    </p>
  </div>
</div>
@endsection
