<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $with = ['images'];
    protected $primaryKey = 'id';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = uniqid() . "_" . Str::random(4);
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }


    /**
     * set category name upper case first letter
     */
    public function setProductNameAttribute($value)
    {
        $this->attributes['product_name'] = ucfirst($value);
    }


    /**
     * GEt Created At Attribute
     */
    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }


    /**
     *
     */
    public function getDiscountAttribute($value)
    {
        if ($this->discount_type == "%") {
            return $value * 100;
        }

        return $value;
    }


    /**
     *
     */
    public function getDiscountTypeAttribute($value)
    {
        if ($value == 'percent') {
            return "%";
        }

        return "Tk";
    }


    /**
     * Get Product Gallary images
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    /**
     *
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function productCategory()
    {
        if (is_null($this->category_id)) {
            return 'Uncategorized';
        } else {
            return $this->category->category;
        }
    }


    /**
     *
     */
    public function seo()
    {
        return $this->hasOne(ProductSeo::class);
    }

    public function getThumbnailPathAttribute()
    {
        return $this->thumbnail ? Storage::url('public/products/' . $this->thumbnail)
            : "https://via.placeholder.com/300x300";
    }
}
