@extends('layouts.app')

@section('content')
  <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">

    <x-post-form :action="route('post.store', auth()->user()->id )" />

    @foreach ($user_posts as $post)
      <x-card-alternative :post="$post" />
    @endforeach

  </main>
@endsection
