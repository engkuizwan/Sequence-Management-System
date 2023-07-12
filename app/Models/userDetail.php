<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class userDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name','user_role','user_email','user_name','user_password'];

    public function scopeFilter($query, $filters) {
        $query->when($filters['name'] ?? false, function($query, $search){
            $query->where('name', 'like', "%$search%");
        });
        $query->when($filters['user_email'] ?? false, function($query, $search){
            $query->where('user_email', 'like', "%$search%");
        });
    }
}


