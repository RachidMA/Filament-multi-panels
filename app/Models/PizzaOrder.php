<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaOrder extends Model
{
    use HasFactory;



    protected $fillable =
    [
        'name',
        'price',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getNameAttribute(): string
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Get the company name associated with the user
        $company = Company::withoutGlobalScope('user')
            ->with('company_type')
            ->find($user->userable_id);
        $userCompany = $company->name ?? 'Unknown Company';
        // dd($user->userable_id);
        // Construct and return the formatted name
        return "{$this->attributes['name']} Created By \"{$user->name}\" from \"{$userCompany}\"";
    }

    protected static function booted()
    {
        parent::boot();

        //scope orders based on user->userable_id
        static::addGlobalScope('user', function ($builder) {
            $builder->where('company_id', auth()->user()->userable_id);
        });

        static::creating(function ($order) {
            //dd($order);
            //save pizzaOrder company_id from user->userable_id
            $order['company_id'] = auth()->user()->userable_id;
        });
    }
}
