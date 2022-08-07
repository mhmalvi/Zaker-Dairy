<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Models\ProductImage;
use App\Models\ProductSeo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Get['admin/products']
     */
    public function index()
    {
        $per_page = request()->per_page ? request()->per_page : 10;

        $products = Product::with('category')->latest();
        if (request()->filled('product_name')) {
            $products = $products->where('name', 'like', '%' . request()->product_name . '%');
        }
        if (request()->filled('status')) {
            $products = $products->where('publish', request()->status == 'published');
        }
        $products = $products->paginate($per_page);

        $old_data = request();

        return view('admin.products.index', compact('products', 'old_data'));
    }


    /**
     * Get['products/get']
     */
    public function get()
    {
        return new ProductCollection(Product::all());
    }


    /**
     * Get['admin/products/add']
     */
    public function create()
    {
        $categories = ProductCategory::all();
     
    
        return view('admin.products.create', compact('categories'));
    }



    /**
     * Post['admin/products/store']
     */
    public function store(ProductCreateRequest $request)
    {

        try {
            $product = $request->save();

            if ($product) {
                $request->productSEO($product);

                if ($request->hasFile('images')) {
                    $request->gallaryImages($product);
                }
            }
            
            
            Session::flash('alert_type','success');
            Session::flash('message','Product saved successfully');
            

            return back();
        } catch (\Throwable $th) {
            
            Session::flash('alert_type','warning');
            Session::flash('message',$th->getMessage());
          

            return back();
        }
    }
    
    //show a specific product
    public function show($uuid){
        
        $product = Product::where('uuid', $uuid)->first();
       
        return view('admin.products.view', compact('product'));
    }


    /**
     * Put['admin/products/attributes']
     */
    public function attribute(Request $request)
    {
        if ($request->expectsJson() && $request->id) {
            $col = $request->col;
            $product = Product::findOrFail($request->id);

            switch ($col) {
                case 'f_prod':
                    $product->featured = ($request->status == 'true') ? 1 : 0;;
                    break;

                case 'b_prod':
                    $product->best = ($request->status == 'true') ? 1 : 0;;
                    break;

                default:
                    break;
            }

            $product->save();

            return response()->json([
                'msg' => 'Data saved successfully',
                'status' => 200
            ]);
        }
    }


    /**
     *
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }



    /**
     *
     */
    public function update(ProductUpdateRequest $request)
    {
          $product = Product::where('id', $request->id)->first();
          

        try {
            if ($request->filled('removed_thumbnail')) {
                $product = $request->destroyThumbnailImage($product);
            }

            $request->update();

            $seo = ProductSeo::where('product_id', $product->id)->first();
            if ($seo) {
                $request->updateSeo($seo);
            }

           Session::flash('alert_type','success');
            Session::flash('message', 'Product has been updated...');

            return back();
        } catch (\Throwable $th) {
         
            
             Session::flash('alert_type','warning');
            Session::flash('message', $th->getMessage());

            return back();
        }
    }


    /**
     *
     */
    public function trash($uuid)
    {
        try {
            
            
            $product = Product::where('uuid',$uuid)->first();
            
            $product->delete();

            Session::flash('alert_type','success');
            Session::flash('message', 'Product has been deleted...');

            return back();
        } catch (\Throwable $th) {
            
            Session::flash('alert_type','warning');
            Session::flash('message', $th->getMessage());

            return back();
        }
    }


    /**
     *
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $gallaryImages = ProductImage::where('product_id', $id)->get();

            Storage::delete('public/products/' . $product->thumbnail);

            foreach ($gallaryImages as $value) {
                Storage::delete('public/products/' . $value->filename);
            }

            $product->delete();

            $notification = [
                'message'   =>  "Product successfully deleted",
                'alert-type'    =>  'success'
            ];

            return back()->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'   =>  $th->getMessage(),
                'alert-type'    =>  'warning'
            ];

            return back()->with($notification);
        }
    }
}
