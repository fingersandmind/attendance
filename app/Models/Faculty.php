<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Faculty extends Model
{
    use HasFactory;
    protected $guarded  = [];
    protected $appends = ['fullname'];

    public function getFullnameAttribute(): string
    {
        return $this->title . ' ' . $this->firstname . ' ' . $this->lastname;
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function scopeSearch(Builder $query, string $terms)
    {
        collect(explode(' ', $terms))->filter()->each(function($term) use($query){
           $term = '%'.$term.'%';
           $query->where(function($query) use($term){
              $query->where('firstname', 'like', $term)
                ->orWhere('lastname', 'like', $term)
                ->orWhere('middlename', 'like', $term)
                ->orWhere('email', 'like', $term);
           });
        });
    }

    public function detail(): HasOne
    {
        return $this->hasOne(Detail::class);
    }
}
