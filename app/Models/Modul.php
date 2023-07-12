<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modul extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'modul';
    protected $primaryKey = 'modul_id';
    protected $fillable = [
        'modul_name','project_id'
    ];

    // public function scopeFilter($query, $filters) {
    //     $query->when($filters['student_name'] ?? false, function($query, $search){
    //         $query->where('student_name', 'like', "%$search%");
    //     });
    // }

    public function scopeFilter($query, $projectid){

        return $query->where('project_id',$projectid)->latest();

    }




}
