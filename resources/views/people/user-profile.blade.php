@extends('layouts.app')

@section('title', 'Profile Page')

@section('content')
<main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">

    <x-card-profile :user='$user' />


    <section class="space-y-8">
        @foreach ($posts as $post)
            <x-card-post :post='$post'  />
        @endforeach
    </section>
    {{ $posts->links() }}


</main>

@endsection
