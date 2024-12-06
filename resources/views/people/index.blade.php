@extends('layouts.app')

@section('title', 'Profile Page')

@section('content')
<main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">

  <div class="">
    <form class="flex flex-row flex-wrap content-end">
      <div class="grow">
        <x-input class="" name="query" type="text" value="{{ $query }}" label="Search Users" placeholder="Search by Nickname/Full name/Email" required />
      </div>
      <input name="submit" value="Submit" type="submit" class="self-end ml-3 rounded-md bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600" >
    </form>

  </div>

  <section class="space-y-8">
    @foreach ($users as $user)
      <x-card-profile-sm :user='$user' />
    @endforeach
  </section>
  {{ $users->links() }}


</main>

@endsection
