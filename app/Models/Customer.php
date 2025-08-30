<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $with = ['wallet']; // override $with eager loading
    public $incrementing = false;
    public $timestamps = false;

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, 'customer_id', 'id');
    }

    // has one through
    public function virtualAccount(): HasOneThrough
    {
        return $this->hasOneThrough(VirtualAccount::class, Wallet::class, 
        'customer_id', 
        'wallet_id',
        'id',
        'id');
    }

    // has many through
    public function review(): HasMany
    {
        return $this->hasMany(Review::class, 'customer_id', 'id');
    }

    //many to many, intermediate table & pivot model
    public function likesProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'customers_likes_products', 'customer_id', 'product_id')->withPivot('created_at')
        ->using(Like::class);
    }
    
    // filtering pivot & pivot model
    public function likesProductsLastWeek(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'customers_likes_products', 'customer_id', 'product_id')->withPivot('created_at')
        ->wherePivot('created_at', '>=', Date::now()->addDays(-7))
        ->using(Like::class);
    }

    // one to one polymorphic
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
