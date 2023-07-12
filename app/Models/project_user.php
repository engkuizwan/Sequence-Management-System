<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class project_user extends Model
{
    use HasFactory;
    protected $table = 'project_user';
    protected $primaryKey = 'project_user_id';
    protected $fillable = [
        'projectID','userID'
    ];
}
