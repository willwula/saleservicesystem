<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Manager extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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
        'service_center_id',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => 'integer',
        'status' => 'integer',
        'email_verified_at' => 'datetime',
    ];

    public function serviceCenter()
    {
        return $this->belongsTo(Manager::class);
    }

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

    public function isDisabled(): bool //停用
    {
        return $this->status === self::STATUS_DISABLED;
    }

    public function isEnable(): bool  //啟用
    {
    return $this->status === self::STATUS_ENABLE;
    }

    public function isPending(): bool  //待審核
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isEmailVerified(): bool //待驗證
    {
        return $this->status === self::STATUS_EMAILVERIFIED;
    }

    public function hasPermissionToViewOwnDealer()
    {
        //...登入角色符合權限
        return $this->isServiceCenter() ;
    }

    public function hasPermissionToViewDealer(Manager $managerModel)
    {
        //...登入角色符合權限
        return $this->isAdmin() || $this->id === $managerModel->service_center_id;
    }
    public function hasPermissionToViewAnyManagers()
    {
        //...登入角色符合權限
        return $this->isAdmin() ;
    }

    public function hasPermissionToViewManager(Manager $managerModel)
    {
        //...登入角色符合權限
        return $this->isAdmin() || $this->id === $managerModel->id;
    }

    public function hasPermissionToEditManager(Manager $managerModel)
    {
        //...登入角色符合權限
        return $this->isAdmin() || $this->id === $managerModel->id;
    }

    public function hasPermissionToEditDealer(Manager $managerModel)
    {
        //...登入角色符合權限
        return $this->isAdmin() || $this->id === $managerModel->service_center_id;
    }

    public function hasPermissionToDeleteManager()
    {
        //...登入角色符合權限
        return $this->isAdmin() ;
    }
}
