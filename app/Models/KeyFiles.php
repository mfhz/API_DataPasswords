<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyFiles extends Model
{
    use HasFactory;
    protected $table = 'key_files';

    protected $fillable = [
        'name_key',
        'line',
        'id_file',
        'created_by',
		'updated_by'
    ];

    public function getFiles()
    {
        return $this->belongsTo(Files::class, 'id_file');
    }
}
