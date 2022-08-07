<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSeo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProductUpdateRequest extends ProductRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:products,uuid,' . $this->uuid,
            'price' => 'required|integer',
            'discount' => 'integer',
            'unit_qty' => 'required',
        ];
    }


    public function update()
    {
        
      
        
        $product = Product::findOrFail($this->id);
        
        
        $product->name = $this->name;
        $product->slug = Str::slug($this->name);
        $product->category_id = $this->category;
        $product->price = $this->price;
        $product->discount = $this->discount();
        $product->discount_type = $this->dType;
        $product->unit_qty = $this->unit_qty;
        $product->out_of_stock = $this->out_of_stock;
        $product->unit = $this->unit;

        if ($this->hasFile('thumbnail')) {
            $product->thumbnail = $this->thumbnail();
           
        }

        $product->thumbnail_alt = $this->thumb_alt;
        $product->description = $this->details;
        $product->featured = $this->featured == 'on' ? 1 : 0;
        $product->publish = $this->publish == 'on' ? 1 : 0 ;
        

       
        $this->gallaryImages($product);

        $this->destroyGalleryImages();
        
      
        
       $product->save() ;
        
      
       

     

    }


    public function updateSeo(ProductSeo $productSeo)
    {
        $productSeo->keywords = $this->meta_keywords;
        $productSeo->tags = $this->meta_tags;
        $productSeo->descriptions = $this->meta_des;

        $productSeo->save();
    }

    public function destroyGalleryImages()
    {
        $image_names = json_decode($this->removed_gallery_images);

        foreach ($image_names as $image_name) {
            Storage::delete('public/products/' . $image_name);
        }
        
        ProductImage::whereIn('filename', $image_names)->delete();
    }

    public function destroyThumbnailImage(Product $product)
    {
        $image_name = $this->removed_thumbnail;

        Storage::delete('public/products/' . $image_name);

        $product->update([
            'thumbnail' => ''
        ]);
        return $product;
    }
}
