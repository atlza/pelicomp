<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function product():hasMany
    {
        return $this->hasMany(Product::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->morphMany('App\Models\Log', 'logable');
    }
}
