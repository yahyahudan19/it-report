<?php

namespace App\Http\Controllers;

use App\Models\WorkCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = WorkCategory::all();
        return view('apps.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $existingCategory = WorkCategory::where('name', $request->name)->first();

            if ($existingCategory) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Category ' . $request->name . ' already exists',
                ]);
            }
            WorkCategory::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Category created successfully',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Failed to create category: ' . $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $category = WorkCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }
    
    public function update(Request $request, $id)
    {
        try {
            $category = WorkCategory::find($id);

            if (!$category) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Category not found',
                ]);
            }

            // Check if name is being changed to an existing category
            $existingCategory = WorkCategory::where('name', $request->name)
                ->where('id', '!=', $id)
                ->first();

            if ($existingCategory) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Category ' . $request->name . ' already exists',
                ]);
            }

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Category updated successfully',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Failed to update category: ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = WorkCategory::find($id);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $category->delete();

            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete category: ' . $e->getMessage()], 500);
        }
    }

}
