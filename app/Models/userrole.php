<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userrole extends Model
{
    use HasFactory;
    protected $table = 'user_role';
    protected $primaryKey = 'user_role_id';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
