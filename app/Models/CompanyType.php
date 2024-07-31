<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'headquater_id'
    ];

    public  function headquater()
    {
        return $this->belongsTo(Headquater::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'companyType_id');
    }

    protected static function booted()
    {
        parent::boot();

        //scope orders based on user->userable_id
        static::addGlobalScope('user', function ($builder) {
            $builder->where('headquater_id', auth()->user()->userable_id);
        });

        static::creating(function ($order) {
            //dd($order);
            //save pizzaOrder company_id from user->userable_id
            $order['headquater_id'] = auth()->user()->userable_id;
        });
    }
}
