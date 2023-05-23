<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Manager extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    const ROLE_ADMIN= 0;
    const ROLE_SERVICECENTER= 1;
    const ROLE_DEALER= 2;
    const STATUS_DISABLED= 0;
    const STATUS_ENABLE= 1;
    const STATUS_PENDING= 2;
    const STATUS_EMAILVERIFIED= 3;
    protected $fillable = [
        'name',
        'role',
        'status',
        'email',
        'phone',
        'address',
        'serviceCenter_id',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isServiceCenter(): bool
    {
        return $this->role === self::ROLE_SERVICECENTER;
    }

    public function isDealer(): bool
    {
        return $this->role === self::ROLE_DEALER;
    }

    public function isDisabled(): bool
    {
        return $this->status === self::STATUS_DISABLED;
    }

    public function isEnable(): bool
    {
    return $this->status === self::STATUS_ENABLE;
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isEmailVerified(): bool
    {
        return $this->status === self::STATUS_EMAILVERIFIED;
    }

    public function hasPermissionToCreateServiceCenter()
    {
        //...登入角色符合權限
        return $this->isAdmin() ;

    }   public function hasPermissionToCreateAdmin()
    {
        //...登入角色符合權限
        return $this->isAdmin() ;
    }
    public function hasPermissionToCreatrDealer()

    {
        //...登入角色符合權限
        return $this->isAdmin() || $this->isServiceCenter();
    }
    public function hasPermissionToViewAnyManagers()
    {
        //...登入角色符合權限
        return $this->isAdmin() ;
    }
}
