<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KateFormsModel extends Model
{
    protected $table = 'kategoriforms';
    protected $fillable = [
        'kategori',
        'active',
    ];
}
