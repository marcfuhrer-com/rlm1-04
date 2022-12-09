<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublisherData extends Model
{
    use HasFactory;
    protected $table = "publisher_data";
    protected $primaryKey = "name";
    protected $keyType = 'string';
    public $incrementing = false;
}
