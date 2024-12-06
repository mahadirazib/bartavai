
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

  $content = $post->content;
  $post_id = $post->id;

  $current_time = now();
  $post_time = Carbon\Carbon::parse($post->created_at)->format('Y-m-d H:i:s');
  // $post_time = $post->created_at->format('y-m-d H:i:s');
  
  $view_count = $post->view_count;
  $timeDiffs = "---";

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


<section id="newsfeed"
class="space-y-6">
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
          <a href="{{ route('user.public.profile', $post_owner) }}"
            class="hover:underline font-semibold line-clamp-1">
            {{ $user_name }}
          </a>

          {{-- <a href="profile.html"
            class="hover:underline text-sm text-gray-500 line-clamp-1">
            @alnahian2003
          </a> --}}
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
      <!-- /Card Action Dropdown -->

    </div>
  </header>

  <!-- Content -->
  <div class="py-4 text-gray-700 font-normal">
    <a href="{{ route('post.show', $post_id) }}">
      <p>
        {!! Str::limit(nl2br(e($content)), 150) !!}
      </p>
    </a>
  </div>

  <!-- Date Created & View Stat -->
  <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
    <span class="">{{ $timeDiffs }}</span>
    <span class="">•</span>
    <span>{{ $view_count < 2 ? $view_count . " view" : $view_count . " views" }}</span>
  </div>

</article>
</section>