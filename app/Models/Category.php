<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes,HasUuids;

    protected $fillable = [
        'name',
        'description'
    ];

    public function scopeSearch($query,$term): void
    {
        if($term){
            $query->where('name','like','%'.$term.'%')
                ->orWhere('description','like','%'.$term.'%');
        }
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
