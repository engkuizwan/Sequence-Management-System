<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class userprofile extends Authenticatable
{
    use HasFactory, Notifiable;

    // protected $table = 'user';
    // protected $primaryKey = 'userID';
    // protected $fillable = ['name','user_name','user_role','user_email','user_password'];

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name','user_role','user_email','user_name','user_password'];
}
