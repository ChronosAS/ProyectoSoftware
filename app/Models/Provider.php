<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email'
    ];

    public function scopeSearch($query, $term) : void
    {
        if($term){
            $query->where('name','like','%'.$term.'%')
                  ->orWhere('email','like','%'.$term.'%')
                  ->orWhereRelation('addresses','address','like','%'.$term.'%')
                  ->orWhereRelation('addresses','phone_1','like','%'.$term.'%')
                  ->orWhereRelation('addresses','phone_2','like','%'.$term.'%')
                  ->orWhereRelation('articles','price','like','%'.$term.'%')
                  ->orWhereRelation('articles','name','like','%'.$term.'%');
        }
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class)->withPivot('article_price');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class,'entity');
    }

}
