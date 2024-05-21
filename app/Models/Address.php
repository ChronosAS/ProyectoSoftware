<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address'
    ];

    public function scopeSearch($query,$term) : void
    {
        if($term){
            $query->where('id','like','%'.$term.'%')
                  ->orWhere('address','like','%'.$term.'%')
                  ->orWhere('user_id','like','%'.$term.'%')
                  ->orWhereRelation('user','name','like','%'.$term.'%');
        }
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
