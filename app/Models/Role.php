<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeFilterBy(Builder $query, string $searchTxt): Builder
    {
        return $query->when($searchTxt, function (Builder $query, string $searchTxt) {
            $query->where(function ($query) use ($searchTxt) {
                $query->where('name', 'like', '%'.$searchTxt.'%');
            });
        });
    }
}
