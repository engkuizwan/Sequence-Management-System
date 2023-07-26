<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flow extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'flow';
    protected $primaryKey = 'flow_id';
    protected $fillable = [
        'flow_name','modul_id'
    ];

     public function user()
     {
         return $this->belongsTo(User::class, 'user_id_owner', 'userID');
     }
        public function scopeFilter($query, $filters)
{
    if (isset($filters['flow_name']) && !empty($filters['flow_name'])) {
        $query->where('flow.flow_name', 'LIKE', '%' . $filters['flow_name'] . '%');
    }

    if (isset($filters['flow_owner']) && !empty($filters['flow_owner'])) {
        $query->whereHas('user', function ($userQuery) use ($filters) {
            $userQuery->where('flow.user_id_owner', 'LIKE', '%' . $filters['flow_owner'] . '%');
        });
    }

    return $query;
}
    
    
}
