<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisInventaris extends Model
{
    use HasFactory;

    protected $table = 'jenis_inventaris';

    protected $guarded = ['id'];
}
