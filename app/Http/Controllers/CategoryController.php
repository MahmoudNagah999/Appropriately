<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true, 
            'message' => 'Categories Retrived Successfully !',
            'data' => $categories
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
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return response()->json([
            'success' => true, 
            'message' => 'Category created Successfully !',
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id); 

        if(!empty($category)){
            return Response()->json([
                'success' => true,
                'message' => 'Category Retrived successfully!',
                'data'    => $category
            ]);
           }
           else
           {
           return response()->json(['Result' => 'No Data found'], 404);
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->name = $validated['name'];
        
        $category->save();

        return response()->json([
            'success' => true, 
            'message' => 'category updated Successfully !',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true, 
            'message' => 'category deleted Successfully !',
            'data' => $category
        ]);
    }
}
