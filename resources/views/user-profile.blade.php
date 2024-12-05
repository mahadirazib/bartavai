@extends('layouts.app')

@section('title', 'Profile Page')

@section('content')
<main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
    <section class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
        <div class="flex gap-4 justify-center flex-col text-center items-center">
            <div class="relative">
                <img
                    class="w-32 h-32 rounded-full border-2 border-gray-800"
                    src="{{ $user->pro_pic ? asset('storage/' . $user->pro_pic) : 'https://via.placeholder.com/150' }}"
                    alt="Profile Picture" />
                <span class="bottom-2 right-4 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
            </div>
            
            <div>
                <h1 class="font-bold text-2xl">{{ $user->name }}</h1>
                <p class="text-gray-700" data-fullBio="{{ $user->bio }}">{{ Str::limit($user->bio, 150) ?? 'No bio available.' }}</p>
                @if (strlen($user->bio)>150)
                    <span class="cursor-pointer font-bold" onclick="null">See More</span>
                @endif
            </div>
        </div>
    </section>



    <section class="space-y-8">
        @foreach ($posts as $post)
            <x-card-alternative :post='$post'  />
        @endforeach
    </section>


</main>

@endsection
