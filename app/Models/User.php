<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->email_verified_at = now();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeSearch(Builder $query, string $terms)
    {
        collect(explode(' ', $terms))->filter()->each(function($term) use($query){
            $term = '%'.$term.'%';
            $query->where(function($query) use($term){
                $query->where('name', 'like', $term)
                    ->orWhere('email', 'like', $term);
            });
        });
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
