<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
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

    public function advances()
    {
        return $this->hasMany(Advance::class);
    }    

    public function bank_accounts()
    {
        return $this->hasMany(BankAccount::class);
    }     
    
    public function blockchain_mints()
    {
        return $this->hasMany(BlockchainMint::class);
    }   
    
    public function blockchain_transactions()
    {
        return $this->hasMany(BlockchainTransaction::class);
    }    
    
    public function blockchain_wallets()
    {
        return $this->hasMany(BlockchainWallet::class);
    }    
    
    public function boughts()
    {
        return $this->hasMany(Bought::class);
    }      

    public function enhances()
    {
        return $this->hasMany(Enhance::class);
    }     
    
    public function identity_documents()
    {
        return $this->hasMany(IdentityDocument::class);
    }      

    public function physical_mints()
    {
        return $this->hasMany(PhysicalMint::class);
    }      
    
    public function promoted_users()
    {
        return $this->hasMany(RewardProfile::class, 'promoter_id');
    }    
    
    public function solds()
    {
        return $this->hasMany(Sold::class);
    }  
    
    public function support_tickets()
    {
        return $this->hasMany(Support::class);
    }

    public function support_messages()
    {
        return $this->hasMany(SupportTicket::class, 'sender_id');
    }    
}
