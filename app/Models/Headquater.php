<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquater extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'email',
    ];

    public function users()
    {
        return $this->morphMany(User::class, 'userable');
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
