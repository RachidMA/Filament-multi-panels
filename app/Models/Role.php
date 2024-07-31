<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable =
    [
        'name',
        'headquater_id'
    ];

    public function headquater()
    {
        return $this->belongsTo(Headquater::class);
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected static function booted()
    {
        parent::boot();

        //scope orders based on user->userable_id
        static::addGlobalScope('user', function ($builder) {
            $builder->where('headquater_id', auth()->user()->userable_id);
        });

        static::creating(function ($role) {
            //dd($role);
            //save pizzao company_id from user->userable_id
            $role['headquater_id'] = auth()->user()->userable_id;
        });
    }
}
