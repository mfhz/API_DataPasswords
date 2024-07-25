<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'computer_path',
        'server_path',
        'id_hostname',
        'created_by',
		'updated_by'
    ];

    public function getHostname()
    {
        return $this->belongsTo(Hostname::class, 'id_hostname');
    }
}
