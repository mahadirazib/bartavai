<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserPost;

class UserController extends Controller
{
    public function publicProfile(Request $request){
        // $users = User::select('*')->orderByDesc('created_at');

        $searchQuery = $request->input('query');

        // Query the users table
        $users = User::when($searchQuery, function ($query, $searchQuery) {
            return $query->where('name', 'like', "%{$searchQuery}%")
            ->orWhere('email', 'like', "%{$searchQuery}%")
            ->orWhere('fname', 'like', "%{$searchQuery}%")
            ->orWhere('lname', 'like', "%{$searchQuery}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate();

        return view('people.index', ['users' => $users, 'query' => $searchQuery]);
    }

    


    public function publicProfileSingle($id){
        $user = User::find($id);
        $posts = UserPost::where('user_posts.user_id', $id)
        ->leftJoin('users', 'users.id', '=', 'user_posts.user_id')
        ->orderBy('created_at', 'desc')
        ->select('user_posts.*', 'users.name as user_name', 'users.pro_pic as user_pic', 'users.fname as user_fname', 'users.lname as user_lname')
        ->paginate();

        return view('people.user-profile', ['user'=>$user, 'posts' => $posts]);
    }
}
