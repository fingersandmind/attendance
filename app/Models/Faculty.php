<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
