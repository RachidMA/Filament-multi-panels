<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Providers\Filament\HeadquaterPanelProvider;
use App\Providers\Filament\PizzaPanelProvider;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'headquater_id',
        'userable_id',
        'userable_type'
    ];

    //USER IS POLYMORPHIC RELATIONSHIP WITH HEADQUATER AND COMPANY
    public function userable()
    {
        return $this->morphTo();
    }

    public function company()
    {
        if ($this->isSuperAdmin()) {
            return $this->belongsTo(Headquater::class);
        }

        return $this->belongsTo(Company::class);
    }

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
        'password' => 'hashed',
    ];

    //REDIRECT USER BASED ON COMPANY ID
    //TODO:ADD ROLES AND USER COMPANY TYPE TO REDIRECT HIM TO HIS PROPER PANEL
    public function usersPanel()
    {
        //dd('FROM INSIDE THE USERSPANEL METHOD ', request()->getSession());
        if ($this->isSuperAdmin() && $this->email == config('mail.from.address') && $this->userable instanceof \App\Models\Headquater) {
            //dd(Company::findOrFail($this->userable_id));

            return Filament::getPanel('headquater')->getPath();
        }
        if (!$this->isSuperAdmin()) {


            //dd('FROM USER NOT SUPER ADMIN STATEMENT ', CompanyType::findOrFail($this->userable_id));
            //dd('====== ', config('session.cookie'));
            // $company_type = CompanyType::findOrFail(13) ?? 1;
            return Filament::getPanel('pizza')->getPath();
            return match ($company_type->name) {

                'pizza' => Filament::getPanel('pizza')->getPath(),
                'real-estate' => Filament::getPanel('real-estate')->getPath(),
                'event-management' => Filament::getPanel('event-management')->getPath(),
                default => dd('NO DASHBOARD AVAILABLE'),
            };
        }
        dd('CAN NOT FIND THE USER PANEL');
    }

    public function isSuperAdmin()
    {
        return $this->is_admin && $this->email == config('mail.from.address');
    }

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {

        if (($this->isSuperAdmin() && $this->email == config('mail.from.address'))) {

            return true;
        }

        if ((!$this->isSuperAdmin())) {
            //dd('THIS USER CAN ACCESS PANEL ');
            //dd($this);
            return true;
        }

        return false;
    }

    protected static function booted()
    {

        parent::boot();

        // //scope orders based on user->userable_id
        // static::addGlobalScope('user', function ($builder) {
        //     $builder->where('headquater_id', auth()->user()->userable_id);
        // });

        static::creating(function ($user) {

            $user['headquater_id'] = auth()->user()->userable_id;
        });
    }
}
