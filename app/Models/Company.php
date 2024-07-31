<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'headquater_id',
        'companyType_id'
    ];

    public function users()
    {
        return $this->morphMany(User::class, 'userable');
    }

    public function company_type()
    {
        return $this->belongsTo(CompanyType::class, 'companyType_id');
    }

    public function headquater()
    {
        return $this->belongsTo(Headquater::class);
    }

    public function pizzaOrders()
    {
        return $this->hasMany(PizzaOrder::class);
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
