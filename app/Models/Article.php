<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory,HasUuids,InteractsWithMedia,SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'price'
    ];

    public function scopeSearch($query,$term) : void
    {
        if($term){
            $query->where('name','like','%'.$term.'%')
                ->orWhere('stock','like','%'.$term.'%')
                ->orWhere('price','like','%'.$term.'%')
                ->orWhereHas('providers', function($query) use ($term){
                    $query->where('article_price','like','%'.$term.'%')
                        ->orWhere('name','like','%'.$term.'%')
                        ->orWhere('email','like','%'.$term.'%');
                });
        }
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class)->withPivot('article_price');
    }
}
