<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductSeo;

class ProductRequest extends FormRequest
{
    /**
     * Product SEO
     */
    public function productSEO($product)
    {
        ProductSeo::create([
            'product_id' => $product->id,
            'keywords' => $this->meta_keywords,
            'tags' => $this->meta_tags,
            'descriptions' => $this->meta_des
        ]);
    }

    /**
     * Save thumbnail
     */
    protected function thumbnail()
    {

        $file = $this->file('thumbnail');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $destination = ('public/products');

        $file->storeAs($destination, $filename);

        //Image::make($file->path())->fit(600, 600)->storeAs(storage_path('app/public/products/' . $filename));
        

        return $filename;
    }

    /**
     * Gallary Images
     */
    public function gallaryImages(Product $product)
    {
        $files = $this->file('images');
        if (is_null($files)) {
            return;
        }

        foreach ($files as $file) {
            $filename = Str::slug($product->name) . "_" . Str::random(8);
            $extension = $file->getClientOriginalExtension();

            $filename = "{$filename}.{$extension}";

            if (!Storage::exists("public/products")) {
                Storage::makeDirectory("public/products");
            }

            Image::make($file->path())->fit(1000, 1000)->save(storage_path('app/public/products/' . $filename));

            ProductImage::create([
                'product_id' => $product->id,
                'filename' => $filename,
            ]);
        }
    }


    /**
     *
     */
    protected function discount()
    {
        $discount = $this->discount;

        if ($this->dType == 'percent') {
            $discount = $discount / 100;
        }

        return $discount;
    }
}
