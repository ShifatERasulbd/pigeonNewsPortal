<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $categories = Category::all();
         $subcategories = SubCategory::all();
         return view('backend.subcategories.index', compact('subcategories','categories'));
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
    public function store(Request $request)
    {
        //

         // Validate the request
    $request->validate([
        'name' => 'required|string|max:255|unique:sub_categories,SubCategoryName',
        'category_id' => 'required|exists:categories,id',
    ]);
// dd($request->all());
    // Create the subcategory
    SubCategory::create([
        'SubCategoryName' => $request->name,
        'categoryId' => $request->category_id,
        'slug' => Str::slug($request->name),
    ]);

    // Redirect back with a success message
    return redirect()->route('subcategories.index')->with('success', 'Sub Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
        $request->validate([
        'name' => 'required|string|max:255|unique:sub_categories,SubCategoryName,' . $subCategory->id,
        'category_id' => 'required|exists:categories,id',
    ]);
    $subCategory=SubCategory::find($request->id);
    $subCategory->update([
        'SubCategoryName' => $request->name,
        'categoryId' => $request->category_id,
        'slug' => Str::slug($request->name),
    ]);

    return redirect()->route('subcategories.index')->with('success', 'Sub Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SubCategory $subCategory)
    {
        //
    $subCategory=SubCategory::find($request->id)->delete();

    return redirect()->route('subcategories.index')->with('success', 'Sub Category deleted successfully!');
    }
}
