@extends('layouts.app')

@section('content')

@php
  $user_name = $post->user_name;
  $user_pic = $post->user_pic;
  $content = $post->content;
  $post_id = $post->id;

  $current_time = now();
  $post_time = Carbon\Carbon::parse($post->created_at)->format('Y-m-d H:i:s');
  
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


  $post_owner = $post->user_id;

@endphp


<section id="newsfeed" class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
  

  <div class="mt-1">
    <a href="{{ route('home') }}">
      ⬅ Home
    </a>
  </div>


  <x-card-post :post="$post" :full="true" />


</section>
@endsection
