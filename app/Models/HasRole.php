<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasRole extends Model
{
    use HasFactory;
    protected $table = "has_roles";
}
