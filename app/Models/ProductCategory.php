<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Sluggable;

class ProductCategory extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];


    /**
     * set category name upper case first letter
     */
    public function setCategoryNameAttribute($value)
    {
        $this->attributes['category_name'] = ucfirst($value);
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }

    /**
     * GEt Created At Attribute
     */
    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }


    /**
     * Products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * parent category
     */
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    /**
     * children categories
     */
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    /**
     * returns thumbnail with full url
     */
    public function getThumbnail()
    {
        return $this->thumbnail ? asset('storage/app/public/categories/' . $this->thumbnail) :
            "https://via.placeholder.com/100x100";
    }
}
