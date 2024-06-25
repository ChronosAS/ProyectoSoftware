<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'address',
        'phone_1',
        'phone_2'
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

    public function entity() : MorphTo
    {
        return $this->morphTo();
    }
}
