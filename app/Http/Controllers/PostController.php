<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\UserPostRequest;

use App\Models\UserPost;

class PostController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        return view('post.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);

        if($request['post_status'] == 'draft'){
            $data['is_public'] = false;
        }else{
            $data['is_public'] = true;
        }

        UserPost::create([
            'user_id' => auth()->user()->id,
            'content' => $data['content'],
            'is_public' => $data['is_public'],
        ]);

        flash()->success('Post Created successfully!');
        return redirect()->route('home');
    }


    public function show(string $id)
    {
        $post = DB::table('user_posts')
        ->where('is_public', true)
        ->where('user_posts.id', $id)
        ->leftJoin('users', 'users.id', '=', 'user_posts.user_id')
        ->select('user_posts.*', 'users.name as user_name', 'users.pro_pic as user_pic')
        ->first();

        if(!isset($post) || $post == null){
            flash()->error('No Post Found');
            return back();
        }

        UserPost::where('id', $id)->increment('view_count');
        
        return view('post.view', ['post' => $post]);
    }


    public function edit(string $id)
    {
        $post = UserPost::find($id);
        
        return view('post.edit', ['post'=> $post]);
    }


    public function update(UserPostRequest $request, string $id)
    {
        $post = UserPost::find($id);
        $post->content = $request->content;
        if($request['post_status'] == 'draft'){
            $post->is_public = false;
        }else{
            $post->is_public = true;
        }

        $post->save();

        flash()->success('Post Updated successfully!');
        return redirect()->route('home');
    }


    public function destroy(string $id)
    {
        $post = UserPost::find($id);
        if($post->user_id == auth()->user()->id){
            flash()->info('Post Deleted successfully!');
            $post->delete();

            return back();
        }

        flash()->error('You are not the owner');
        return redirect()->route('home');
    }
}
