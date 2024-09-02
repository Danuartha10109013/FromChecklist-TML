<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormsModel extends Model
{
    protected $table = 'forms';
    protected $fillable = [
        'nama',
        'kategori',
        'active',
    ];

}
