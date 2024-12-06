

<section class="bg-white border-2 p-8 border-gray-800 rounded-xl space-y-8 flex items-start flex-col justify-start">
  <div class="flex gap-4 justify-center flex-row text-center items-center">
      <div class="relative">
          <img
              class="w-20 object-cover aspect-square rounded-full border-2 border-gray-800"
              src="{{ $user->pro_pic ? asset('storage/' . $user->pro_pic) : 'https://via.placeholder.com/150' }}"
              alt="Profile Picture" />
          <span class="bottom-1 right-2 absolute w-3.5 h-3.5 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></span>
      </div>
      
      <div>

      </div>
      <div class="flex flex-col items-start justify-start">
          <a href="{{ route('user.public.profile', $user->id) }}">
            <h1 class="font-bold text-2xl hover:underline cursor-pointer underline-offset-3">{{ $user->fname . " " . $user->lname }}</h1>
          </a>
          <a href="{{ route('user.public.profile', $user->id) }}">
            <p class="text-gray-700 text-sm hover:underline cursor-pointer underline-offset-3">&#64;{{ $user->name }}</p>
          </a>
          <p class="text-gray-700">{{ Str::limit($user->bio, 50) ?? 'No bio available.' }}</p>
      </div>
  </div>
</section>