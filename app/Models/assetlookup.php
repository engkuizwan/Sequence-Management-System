<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assetlookup extends Model
{
    use HasFactory;
    protected $table = 'assetlookup';
    protected $primaryKey = 'assetlookup_id';
}
