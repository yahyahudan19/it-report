<?php

namespace App\Http\Controllers;

use App\Models\WorkCategory;
use App\Models\WorkMainCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = WorkCategory::all();
        $categories_main = WorkMainCategory::all();
        return view('apps.category.index', compact('categories', 'categories_main'));
    }

    public function store(Request $request)
    {
        try {
            $existingCategory = WorkMainCategory::where('name', $request->name)->first();

            if ($existingCategory) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Category ' . $request->name . ' already exists',
                ]);
            }
            WorkMainCategory::create([
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

    public function substore(Request $request)
    {
        try {
            $existingCategory = WorkCategory::where('name', $request->name)
                ->where('main_category_id', $request->main_category_id)
                ->first();

            if ($existingCategory) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Category ' . $request->name . ' already exists',
                ]);
            }
            WorkCategory::create([
                'name' => $request->name,
                'main_category_id' => $request->main_category_id,
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
        $category = WorkMainCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function show_sub($id)
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
            $category = WorkMainCategory::find($id);

            if (!$category) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Category not found',
                ]);
            }

            // Check if name is being changed to an existing category
            $existingCategory = WorkMainCategory::where('name', $request->name)
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
                'main_category_id' => $request->main_category_id,
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

    public function update_sub(Request $request, $id)
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
                ->where('main_category_id', $request->main_category_id)
                ->first();

            if ($existingCategory) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Sub Category ' . $request->name . ' already exists',
                ]);
            }

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Sub Category updated successfully',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Failed to update sub category: ' . $e->getMessage(),
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

            // Cek relasi ke tabel lain, misal contoh: relasi ke tabel 'works'
            if ($category->workTasks()->count() > 0) {
                return response()->json(['message' => 'Category is still in use and cannot be deleted'], 400);
            }

            $category->delete();

            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete category: ' . $e->getMessage()], 500);
        }
    }

    public function destroy_main($id)
    {
        try {
            $category = WorkMainCategory::find($id);

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
