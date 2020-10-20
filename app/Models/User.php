<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;
// use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{

    use LaratrustUserTrait;
    use Notifiable ;
    use HasApiTokens ;
    // use SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    protected $with = ['area'];

    protected $fillable = [
        'name', 'email', 'password', 'phone' , 'image'
        ,'user_code'
        ,'location_id'
        ,'address'
        ,'arear_id'
        ,'type'
        ,'active'
        ,'created_by'
        ,'pos_id'
        ,'card_number'
        ,'area_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pos_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = \Hash::make($pass);
    }

    public function pos(){

        return $this->hasMany('\App\Models\Pos' , 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function area()
    {
        return $this->belongsTo('\App\Models\Area' , 'area_id');
    }


    public function balances()
    {
        return $this->hasMany(AgentBalance::class, 'agent_id');
    }

    public function revenues()
    {
        return $this->hasMany(Revenue::class, 'agent_id');
    }

    public function posCharges()
    {
        return $this->hasMany(PosCharge::class, 'agent_id');
    }

    //======================== Start Mohamed Mohsen ====================================//
    public function AauthAcessToken()
    {
        return $this->hasMany('App\Models\OauthAccessToken');
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }


    public function scopeRoles($query)
    {
        return $query->whereIn('type', [3,5]);
    }
    public function scopeRoleClient($query)
    {
        return $query->whereIn('type', [6]);
    }
    public function MyPos(){

        return $this->belongsTo(Pos::class, 'pos_id');
    }
    public function PosCustomer(){

        return $this->hasMany(Pos::class , 'customer_id');
    }

    public function balance()
    {
        return $this->hasMany('\App\Models\AgentBalance' , 'agent_id' )->where('type',1);
    }
     
    public function TransferCreditToCustomer()
    {
        return $this->hasMany(SendFromDelegateToBanks::class, 'created_by');
    }


    public function TransferCreditFromDelegateToCustomers()
    {
        return $this->hasMany(TransferCreditFromDelegateToCustomers::class, 'created_by');
    }


    public function RefundMoneyFromClientToDelegates()
    {
        return $this->hasMany(RefundMoneyFromClientToDelegates::class, 'delegate_id');
    }

    public $appends = [
        'available_money',
        //'Transfer money',
        //new

    ];

    public function getAvailableMoneyAttribute()
    {
        $delegateCredit = AgentBalance::where('agent_id',$this->user_id)->sum('balance');
        
        $money = TransferCreditFromDelegateToCustomers::where('pos_id',$this->id)
            ->Active()->sum('money'); 
        
        $total = ($money);
        return $total;
    }

    public function financialCustoday(){

        return $this->hasMany('\App\Models\FinancialCustoday' , 'agent_id');
    }
}
