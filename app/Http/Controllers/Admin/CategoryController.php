<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    /**
     * Get['admin/categories']
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Get['admin/categories/list']
     * returns paginated list of categories
     */
    public function paginatedList()
    {
        try {
            $perPage = request('per_page') ?? 5;
            $search = request('search');
            $categories = ProductCategory::where('category', 'LIKE', "%$search%")->latest()->paginate($perPage);

            return new CategoriesCollection($categories);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong",
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Get['admin/categories/raw']
     * returns list of categories in json format
     */
    public function rawList()
    {
        try {
            if (request()->filled('only_parent') && request()->get('only_parent') == 'true') {
                $categories = ProductCategory::whereNull('parent_id')->get();
            } else {
                $categories = ProductCategory::all();
            }
            return new CategoriesCollection($categories);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong",
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Get['admin/categories/add']
     */
    public function create()
    {
        return view('admin.category.create');
    }


    /**
     * Post['admin/categories/store']
     */
    public function store(CategoryCreateRequest $request)
    {
        try {
            $request->save();

            return response()->json([
                'message' => "Successfully created the category!"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong!",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Get['admin/categories/{category}/edit']
     */
    public function edit(ProductCategory $productCategory)
    {
        $productCategory = new CategoryResource($productCategory);
        return view('admin.category.edit', compact('productCategory'));
    }

    /**
     * Patch['admin/categories/{category}/update']
     */
    public function update(CategoryUpdateRequest $request, ProductCategory $productCategory)
    {
        try {
            $old_slug = $productCategory->slug;
            $productCategory = $request->update($productCategory);

            return response()->json([
                'message' => "Successfully updated the category!",
                'refresh' => $old_slug != $productCategory->slug,
                'refresh_link' => route('admin.category.edit', ['product_category' => $productCategory->slug]),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong!",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete['admin/categories/{category}/delete']
     */
    public function delete(CategoryDeleteRequest $request, ProductCategory $productCategory)
    {
        try {
            $request->delete($productCategory);

            return response()->json([
                'success' => true,
                'message' => "Successfully deleted the category!",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong while deleting the category!",
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
