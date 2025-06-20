<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_url', 'page_id','slug'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function offerProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')
                                ->whereColumn('last_price', '=', 'best_price')
                                ->whereColumn('last_price', '<', 'price_goal')
                                ->where ('status', '=', 1)
                                ->orderBy('likes', 'desc')
                                ->take(4);  
    }
    
    public function categoryProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')
                                ->where('status', '=', 1)
                                ->whereColumn('last_price', '<', 'price_goal');  
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public function allChildCategories()
    {
        return $this->childCategories()->with('allChildCategories');
    }

    public function getAllProductsRecursive()
    {
        $products = $this->categoryProducts;

        foreach ($this->allChildCategories as $childCategory) {
            $products = $products->concat($childCategory->getAllProductsRecursive());
        }

        return $products;
    }
}
