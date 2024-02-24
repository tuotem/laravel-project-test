<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("authCheck2")->only(["create", "show"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Cache::rememberForever('posts-page-'.request('page', 1), function () {
            return Post::with('category')->paginate(5);
        });

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create", Post::class);
        
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize("create", Post::class);
        
        $request->validate([
            'image' => ['required', 'max:2028', 'image'],
            'title' => ['required', 'max:191'],
            'category_id' => ['required', 'integer'],
            'description' => ['required']
        ]);

        $file_name = time().'_'.$request->file('image')->getClientOriginalName();
        $file_path = $request->file('image')->storeAs('uploads', $file_name);
        
        $post = new Post();
        $post->image = 'storage/'.$file_path;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize("update", $post);

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {  
        $this->authorize("update", $post);

        $request->validate([
            'title' => ['required', 'max:191'],
            'category_id' => ['required', 'integer'],
            'description' => ['required']
        ]);

        if ($request->hasFile('image')) 
        {  
            $request->validate([
                'image' => ['required', 'max:2028', 'image'],
            ]);

            $file_name = time().'_'.$request->file('image')->getClientOriginalName();
            $file_path = $request->file('image')->storeAs('uploads', $file_name);

            File::delete(public_path($post->image));

            $post->image = 'storage/'.$file_path;
        }

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize("delete", $post);

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function trash() 
    {
        $posts = Post::onlyTrashed()->get();

        return view('posts.trashed', compact('posts'));
    }

    public function restore($id) 
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        $post->restore();

        return back();
    }

    public function forceDelete($id) 
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        
        File::delete(public_path($post->image));

        $post->forceDelete();

        return back();
    }
}
