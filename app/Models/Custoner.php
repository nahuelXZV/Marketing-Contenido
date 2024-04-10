<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custoner extends Model
{
    use HasFactory;
    protected $table = 'custoner';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
