
@php
  $post_owner = $post->user_id;

  if ($post_owner == auth()->user()->id) {
    $user_name = auth()->user()->name;
    $user_full_name = auth()->user()->fname . " " . auth()->user()->lname;
    $user_pic = auth()->user()->pro_pic;
  }else {
    $user_name = $post->user_name;
    $user_full_name = $post->user_fname . " " . $post->user_lname;
    $user_pic = $post->user_pic;
  }

  $post_content = $post->content;
  $post_image = $post->image;
  $post_id = $post->id;
  $view_count = $post->view_count;
  $timeDiffs = "---";

  $current_time = now();
  $post_time = Carbon\Carbon::parse($post->created_at)->format('Y-m-d H:i:s');

  $year_difference = (int)(Carbon\Carbon::parse($post->created_at))->diffInYears(now());
  if($year_difference>0){
    $timeDiffs = $year_difference == 1 ? $year_difference." year ago": $year_difference . " years ago";
  }else {
    $month_difference = (int)(Carbon\Carbon::parse($post->created_at))->diffInMonths(now());
    if($month_difference>0){
      $timeDiffs = $month_difference == 1 ? $month_difference. " month ago" : $month_difference . " months ago";
    }else{
      $day_difference = (int)(Carbon\Carbon::parse($post->created_at))->diffInDays(now());
      if($day_difference>0){
        $timeDiffs = $day_difference == 1 ? $day_difference . " day ago" : $day_difference . " days ago";
      }else {
        $hour_difference = (int)(Carbon\Carbon::parse($post->created_at))->diffInHours(now()); 
        if($hour_difference>0){
          $timeDiffs = $hour_difference == 1 ? $hour_difference . " houre ago": $hour_difference . " hours ago";
        }else {
          $timeDiffs = (int)(Carbon\Carbon::parse($post->created_at))->diffInMinutes(now()) . " minutes ago";
        }
      }
    }
  }

@endphp



<!-- Barta Card With Image -->
<article
  class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
  <!-- Barta Card Top -->
  <header>
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <!-- User Avatar -->
        <div class="flex-shrink-0">
          <img
            class="h-10 w-10 rounded-full object-cover"
            src="{{ asset("storage/". $user_pic) }}"
            alt="{{ $user_name }}" />
        </div>
        <!-- /User Avatar -->

        <!-- User Info -->
        <div class="text-gray-900 flex flex-col min-w-0 flex-1">
          <a
            href="{{ route('user.public.profile', $post_owner) }}"
            class="hover:underline font-semibold line-clamp-1">
            {{ $user_full_name }}
          </a>

          <a
            href="{{ route('user.public.profile', $post_owner) }}"
            class="hover:underline text-sm text-gray-500 line-clamp-1">
            &#64;{{ $user_name }}
          </a>
        </div>
        <!-- /User Info -->
      </div>

      <!-- Card Action Dropdown -->
      @if (auth()->user()->id == $post_owner)
        <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
          <div class="relative inline-block text-left">
            <div>
              <button
                @click="open = !open"
                type="button"
                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                id="menu-0-button">
                <span class="sr-only">Open options</span>
                <svg
                  class="h-5 w-5"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true">
                  <path
                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                </svg>
              </button>
            </div>
            <!-- Dropdown menu -->
            <div x-show="open"
              @click.away="open = false"
              class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu-button"
              tabindex="-1">
              <a href="{{ route('post.edit', $post_id) }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                tabindex="-1"
                id="user-menu-item-0">
                Edit
              </a>
              <form action="{{ route('post.destroy', $post_id) }}" method="POST"
                role="menuitem"
                tabindex="-1"
                id="user-menu-item-1">
                @method("DELETE")
                @csrf
                <input type="submit" value="Delete"
                class="block w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                  
              </form>
            </div>
          </div>
        </div>
      @endif


    </div>
  </header>

  <!-- Content and Image -->
  <div class="py-4 text-gray-700 font-normal space-y-2">
    <a href="{{ route('post.show', $post_id) }}">
      @if (isset($post_image) && file_exists(public_path('storage/' . $post_image)))
        <img
          src="{{ asset('storage/' . $post_image) }}"
          class="min-h-auto w-full rounded-lg object-cover @if (isset($full) && $full == true) max-h-fit @else max-h-64 md:max-h-72 @endif mb-6"
          alt="" />
        <div>
          @if (isset($full) && $full == true)
            <p>{!! nl2br(e($post_content)) !!}</p>
          @else
            <p>{!! Str::limit(nl2br(e($post_content)), 80) !!}</p>
          @endif
        </div>
      @else
        <div>
          @if (isset($full) && $full == true)
            <p>{!! nl2br(e($post_content)) !!}</p>
          @else
            <p> {!! Str::limit(nl2br(e($post_content)), 150) !!} </p>
          @endif
        </div>
        
      @endif
    </a>
  </div>

  <!-- Date Created & View Stat -->
  <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
    <span class="">{{ $timeDiffs }}</span>
    <span class="">•</span>
    <span>{{ $view_count < 2 ? $view_count . " view" : $view_count . " views" }}</span>
  </div>

  <!-- Barta Card Bottom -->
  <footer class="border-t border-gray-200 pt-2">
    <!-- Card Bottom Action Buttons -->
    <div class="flex items-center justify-between">
      <div class="flex gap-8 text-gray-600">
        <!-- Heart Button -->
        <button
          type="button"
          class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
          <span class="sr-only">Like</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="w-5 h-5">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>

          <p>24</p>
        </button>
        <!-- /Heart Button -->

        <!-- Comment Button -->
        <button
          type="button"
          class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
          <span class="sr-only">Comment</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="w-5 h-5">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
          </svg>

          <p>8</p>
        </button>
        <!-- /Comment Button -->
      </div>

      <div>
        <!-- Share Button -->
        <button
          type="button"
          class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
          <span class="sr-only">Share</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
          </svg>
        </button>
        <!-- /Share Button -->
      </div>
    </div>
    <!-- /Card Bottom Action Buttons -->
  </footer>
  <!-- /Barta Card Bottom -->
</article>
<!-- /Barta Card With Image -->
