<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 追加
use Illuminate\Notifications\Notifiable; // 追加　通知可能
use Laravel\Sanctum\HasApiTokens; // 追加
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable //継承 Model/ Userから変更
{
    use HasApiTokens, HasFactory, Notifiable; // 追記

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
