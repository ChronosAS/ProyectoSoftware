<?php

namespace App\Models;

use App\Concerns\HasCode;
use App\Enum\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected static string $codePrefix = 'SIS';

    protected $casts = [
        'status' => TransactionStatus::class
    ];

    protected $fillable = [
        'user_id',
        'code',
        'total_price',
        'payment_ref',
        'status',
    ];

    public function scopeSearch($query, $term) : void
    {
        if($term){
            $query->where('status','like','%'.$term.'%')
                  ->orWhere('total_price','like','%'.$term.'%')
                  ->orWhere('payment_ref','like','%'.$term.'%')
                  ->orWhereRelation('articles','name','like','%'.$term.'%')
                  ->orWhereRelation('user','name','like','%'.$term.'%')
                  ->orWhereRelation('user','email','like','%'.$term.'%');
        }
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function articles() : BelongsToMany
    {
        return $this->belongsToMany(Article::class,'transaction_articles')->withPivot('quantity','total_price');
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->code = static::$codePrefix . Str::padLeft($model->id, 5, 0);
            $model->saveQuietly();
        });
    }
}
