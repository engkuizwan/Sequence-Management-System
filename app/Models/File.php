<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'file';
    protected $primaryKey = 'file_ID';
    protected $fillable = [
        'file_name','file_type','projectID'
    ];

    
    public function scopeFilter($query, $projectid){

       return $query->where('projectID',$projectid)->orderBy('created_at', 'asc');
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        
        // // Output the SQL query and bindings for debugging
        dd($sql, $bindings);
    }

   
}
