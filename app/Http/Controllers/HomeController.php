<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserPost;


class HomeController extends Controller
{
    public function home()
    {
        $user_posts = DB::table('user_posts')
        ->where('is_public', true)
        ->leftJoin('users', 'users.id', '=', 'user_posts.user_id')
        ->orderBy('created_at', 'desc')
        ->select('user_posts.*', 'users.name as user_name', 'users.pro_pic as user_pic', 'users.fname as user_fname', 'users.lname as user_lname')
        ->paginate();

        // dd($user_posts);
        return view('home', ['user_posts' => $user_posts]);
    }


}
