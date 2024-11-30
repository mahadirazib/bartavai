@extends('layouts.app')

@section('title', 'Profile Page')

@section('content')
<main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
    <section class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
        <div class="flex gap-4 justify-center flex-col text-center items-center">
            <div class="relative">
                <img
                    class="w-32 h-32 rounded-full border-2 border-gray-800"
                    src="{{ auth()->user()->pro_pic ? asset('storage/' . auth()->user()->pro_pic) : 'https://via.placeholder.com/150' }}"
                    alt="Profile Picture" />
                <span class="bottom-2 right-4 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
            </div>
            
            <div>
                <h1 class="font-bold text-2xl">{{ auth()->user()->name }}</h1>
                <p class="text-gray-700" data-fullBio="{{ auth()->user()->bio }}">{{ Str::limit(auth()->user()->bio, 150) ?? 'No bio available.' }}</p>
                @if (strlen(auth()->user()->bio)>150)
                    <span class="cursor-pointer font-bold" onclick="null">See More</span>
                @endif
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
            </svg>
            Edit Profile
        </a>
    </section>
</main>

@endsection
