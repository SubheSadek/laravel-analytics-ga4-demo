<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Utilities\Utility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'phone',
        'profile_pic',
        'user_type',
        'status',
    ];

    public function scopeFilterBy(Builder $query, string $searchTxt): Builder
    {
        return $query->when($searchTxt, function (Builder $query, string $searchTxt) {
            $query->where(function ($query) use ($searchTxt) {
                $query->where('name', 'like', '%'.$searchTxt.'%');
                $query->orWhere('email', 'like', '%'.$searchTxt.'%');
            });
        });
    }

    public function scopeWithoutAdminUser(Builder $query): Builder
    {
        return $query->where('user_type', Utility::USER);
    }

    public function scopeWithAdminUser(Builder $query): Builder
    {
        return $query->where('user_type', Utility::ADMIN);
    }

    public function scopeNotSuperAdmin(Builder $query): Builder
    {
        return $query->where('user_type', '!=', Utility::SUPER_ADMIN);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
