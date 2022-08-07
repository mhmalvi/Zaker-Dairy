<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductsCollection;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getOtherProducts()
    {
        try {
            $sweets = ProductCategory::where('category', 'LIKE', 'Sweets')->first();
            $bakery = ProductCategory::where('category', 'LIKE', 'Bakery')->first();
            $dairy = ProductCategory::where('category', 'LIKE', 'Dairy')->first();

            $ignored_ids = [];
            if ($sweets) $ignored_ids[] = $sweets->id;
            if ($bakery) $ignored_ids[] = $bakery->id;
            if ($dairy) $ignored_ids[] = $dairy->id;

            $other_products = Product::where('publish', 1)
                ->whereNotIn('category_id', $ignored_ids)
                ->orWhere('category_id', null)
                ->paginate(8);

            if (count($other_products) == 0) {
                return response()->json([
                    'view' => null,
                ]);
            }

            $uid = uniqid();

            return response()->json([
                'uid' => $uid,
                'view' => view("components.home.other_category_products_page_row", [
                    'unique_id' => $uid,
                    'products' => $other_products
                ])->render(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
