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

    public function scopeFilter ($query, $filters){
        $query->when($filters['flow_name'] ?? false, function($query, $search){

            $query->where('flow_name', 'like', "%$search%");
        });
        
        $query->when($filters['flow_owner'] ?? false, function($query, $search){

            $query->where('user_id_owner', 'like', "%$search%");
        });

    }
}
