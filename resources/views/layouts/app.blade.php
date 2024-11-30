<!DOCTYPE html>
<html class="html h-full bg-white">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      * {
        font-family: 'Inter', sans-serif;
      }
    </style>

    <title>@yield('title', 'Barta vai')</title>
  </head>
  <body class="min-h-full bg-gray-100">

    @if(Auth::check())
      <x-navigation />
    @endif


    <header>
      @yield('header')
    </header>


    <main>
      @yield('content')
    </main>

    @if(Auth::check())
      <x-footer />
    @endif

  </body>
</html>
