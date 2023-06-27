<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return response()->json([
            'success' => true,
            'message' => 'Posts List',
            'data' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = Post::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Create Post',
            'data' => $post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (!empty($post)) {
            return Response()->json([
                'success' => true,
                'message' => 'Post Retrived successfully!',
                'data'    => $post
            ]);
        } else {
            return response()->json(['Result' => 'no Data found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->title = $validated['title'];
        $post->content = $validated['content'];

        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Update post successfully!',
            'data'    => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Deleted successfully!',
            'data'    => $post
        ]);
    }

    public function search(Request $request)
    {

        foreach ($request->toArray() as $key => $value) {
            $result = Post::where($key, 'LIKE', '%' . $value . '%')->get();
        }

        if (count($result)) {
            return Response()->json([
                'success' => true,
                'message' => 'Post Founded successfully!',
                'data'    => $result
            ]);
        } else {
            return response()->json(['Result' => 'Data No found'], 404);
        }
    }

    public function addCategories(Request $request)
    {

        $post = post::find($request->post_id);
        $post->categories()->attach($request->categories);

        $relations = $post->categories();
        return Response()->json([
            'success' => true,
            'message' => 'catigories relations added successfully!',
            'data'    => $relations
        ]);
    }

    public function removeCategories(Request $request)
    {

        $post = post::find($request->post_id);
        $post->categories()->detach($request->categories);

        return Response()->json([
            'success' => true,
            'message' => 'catigories relations deleted successfully!',
        ]);
    }
}
