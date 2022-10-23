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
  
    
    public function trades()
    {
        return $this->hasMany(Trade::class);
    }      

    public function enhances()
    {
        return $this->hasMany(Enhance::class);
    }     
       
    public function introducer()
    {
        return $this->belongsTo(User::class, 'introducer_id');
    }   

    public function downlines()
    {
        return $this->hasMany(User::class, 'introducer_id');
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
