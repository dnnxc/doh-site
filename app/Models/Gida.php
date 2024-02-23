<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gida extends Model
{
    protected $table = 'gida_table';
    public $timestamps = false;
    use HasFactory;
}
