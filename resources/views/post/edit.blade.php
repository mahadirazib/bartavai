@extends('layouts.app')

@section('content')

@php
  $content = $post->content;
  $post_id = $post->id;
  $post_image = $post->image;

@endphp


<section id="newsfeed" class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
  

  <div class="mt-1">
    <a href="{{ route('home') }}">
      ⬅ Home
    </a>
  </div>

  <form method="POST" 
    enctype="multipart/form-data"
    class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 md:py-5 sm:py-4"
    action="{{ route('post.update', $post_id) }}">
    @csrf
    @method('PUT')

    <div>
      <div class="flex items-start ">

        <!-- Content -->
        <div class="text-gray-700 font-normal w-full">
          
          @if (isset($post_image) && file_exists(public_path('storage/' . $post_image)))
          <div class="w-full relative group">
            <!-- Image with hover effect -->
            <img src="{{ asset('storage/' . $post_image) }}"
              class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72 mb-6 hover:brightness-75 group-hover:brightness-75 cursor-pointer"
              alt="Post Image" id="postImage" />
          </div>
          @else
            <img src=""
            class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72 mb-6 hover:brightness-75 group-hover:brightness-75 cursor-pointer hidden"
            alt="Post Image" id="postImage" />
          @endif

          <script>
            function previewImage(event) {
              const file = event.target.files[0];
              if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                  document.getElementById('postImage').src = e.target.result; // Update the profile picture
                };
                reader.readAsDataURL(file);

                document.getElementById('postImage').classList.remove('hidden');
              }
            }

          </script>

          <textarea required
            class="block w-full min-h-60 p-2 pt-2 text-gray-900 bg-gray-100 ms-2 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
            name="content"
            rows="2"
            placeholder="What's going on, {{ auth()->user()->lname }}?"
            >{{ $content }}</textarea>
        </div>
      </div>
    </div>

    <div>
      <!-- Card Bottom Action Buttons -->
      <div class="flex items-center justify-end">

      <div class="flex gap-4 text-gray-600">
          <!-- Upload Picture Button -->
        <div id="pictureInput">
          <input type="file"
            name="image" id="picture" class="hidden" onchange="previewImage(event)" />

          <label
            for="picture"
            class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
            <span class="sr-only">Picture</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
          </label>
        </div>
          <!-- /Upload Picture Button -->

          <!-- GIF Button  -->
        <button
          type="button"
          class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
          <span class="sr-only">GIF</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12.75 8.25v7.5m6-7.5h-3V12m0 0v3.75m0-3.75H18M9.75 9.348c-1.03-1.464-2.698-1.464-3.728 0-1.03 1.465-1.03 3.84 0 5.304 1.03 1.464 2.699 1.464 3.728 0V12h-1.5M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
          </svg>
        </button>
        <!-- /GIF Button -->

          <!-- Emoji Button -->
        <button
          type="button"
          class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
          <span class="sr-only">Emoji</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
          </svg>
        </button>
        <!-- /Emoji Button -->
      </div>

        <div>
          <!-- Post Button -->
          <button type="submit" name="post_status" value="draft"
            class="m-2 mr-0 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-emerald-800 hover:bg-black text-white">
            Draft
          </button>
          <!-- /Post Button -->
        </div>

        <div>
          <!-- Post Button -->
          <button type="submit" name="post_status" value="post"
            class="m-2 mr-0 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
            Post
          </button>
          <!-- /Post Button -->
        </div>
      </div>
      <!-- /Card Bottom Action Buttons -->
    </div>
    
  </form>


</section>
@endsection
