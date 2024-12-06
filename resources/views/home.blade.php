@extends('layouts.app')

@section('content')
  <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">

    <x-post-form :action="route('post.store')" />

      
    @foreach ($user_posts as $post)
      <x-card-post :post="$post" />
      {{-- <x-card-alternative :post="$post" /> --}}
    @endforeach
      
    {{ $user_posts->links() }}
    

  </main>
@endsection
