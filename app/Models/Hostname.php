<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostname extends Model
{
    use HasFactory;
    protected $table = 'Hostname';

    protected $fillable = [
        'name',
        'progress',
        'count_file',
        'created_by',
		'updated_by'
    ];
}
