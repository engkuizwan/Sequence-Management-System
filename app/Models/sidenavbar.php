<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sidenavbar extends Model
{
    use HasFactory;
    protected $table = 'sidenavbar';
    protected $primaryKey = 'sidenavbar_id';
    protected $fillable = [
        'name','class_icon','route'
    ];
}
