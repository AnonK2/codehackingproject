<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use App\Post;
use App\User;
use App\Photo;
use App\Category;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();

        if ($file = $request['photo_id']) {

            $time = str_replace([' ', ':', '-'], '_', Carbon::now());
            $name = $time . "_" . $file->getClientOriginalName();

            $file->move(public_path()."/images/", $name);

            $photo = Photo::create(['path' => $name]);

            $input['photo_id'] = $photo->id;
            $user->posts()->create($input);

            Session::flash('created_post_msg', 'Post successfully created!');

            return redirect()->route('admin.posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $category = Category::pluck('name', 'id')->toArray();

        return view('admin.posts.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        $user = Auth::user();
        $input = $request->all();

        if($file = $request['photo_id']) {
            $time = str_replace([' ', ':', '-'], '_', Carbon::now());
            $name = $time . '_' . $file->getClientOriginalName();

            $file->move(public_path() . "/images/", $name);
            $input['photo_id'] = Photo::create(['path' => $name])->id;
            $user->posts()->whereId($id)->first()->update($input);

            Session::flash('update_post_msg', 'Post successfully updated!');

            return redirect()->route('admin.posts.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . $post->photo->path);//REMOVE POST'S PHOTO FROM public/images/
        $photo = Photo::findOrFail($post->photo->id)->delete();
        $post->delete();

        Session::flash('delete_post_msg', 'Post successfully deleted!');

        return redirect()->route('admin.posts.index');
    }
}
